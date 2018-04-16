<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Class DriverLicenseNumberValidatorExtension.
 *
 * Правило валидации номеров водительских удостоверений (ВУ).
 *
 * "Все записи в удостоверении должны выполняться буквами латинского алфавита или транслитерированы латиницей" (с) Вики
 *
 * Используемый для номера ВУ код на удостоверении - 5.
 *
 * Для ВУ РФ:
 * Первые четыре цифры последовательности — это серия документа. Две первые из них совпадают с номером региона, где
 * была выдана карточка. А последнее шесть цифр являются номером водительского удостоверения.
 *
 * Примеры номеров ВУ:
 *  - 74 14 292010 (РФ)
 *  - 77 16 235662 (РФ)
 *  - 190195-0000 (ЕС)
 *  - 23506/04/2469 (ЕС)
 *
 * @see <https://ru.wikipedia.org/wiki/Водительское_удостоверение>
 * @see <https://goo.gl/LL2tLB> Фотография ВУ РФ
 */
class DriverLicenseNumberValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'driver_license_number';
    }

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        // Статический стек для хранения результатов валидации (для быстродействия)
        static $stack = [];

        // Если значение в стеке уже есть - то просто возвращаем его
        if (! isset($stack[$value])) {
            // Разрешенные альфа-символы (латиница)
            static $allowed_alpha = 'A-Z';

            // Разрешенные разделители групп номера
            static $allowed_separators = ' \\-\\/\\\\';

            // Разрешенные символы (для использования в регулярном выражении)
            $allowed_chars = "{$allowed_alpha}0-9{$allowed_separators}";

            // Значение в верхнем регистре
            $uppercase = Str::upper($value);

            // Удаляем все символы, кроме разрешенных + делаем trim строки
            $cleared = preg_replace("~[^{$allowed_chars}]~", '', trim($uppercase));

            // Удаляем дублирующиеся разделители
            $cleared = preg_replace('~\\s+~', ' ', $cleared);
            $cleared = preg_replace('~\\-+~', '-', $cleared);
            $cleared = preg_replace('~\\/+~', '/', $cleared);
            $cleared = preg_replace('~\\\\+~', '\\', $cleared);

            // Вычисляем длину получившейся строки
            $length = Str::length($cleared);

            $stack[$value] = (
                $length >= 10 && $length <= 25 // Проверяем соответствие минимальной и максимальной длине
                && $uppercase === $cleared // После удаления запрещенных символов - значение не изменилось
                && ( // Соответствует ли одному из шаблонов
                    // https://regex101.com/r/6PhPAL/2
                    preg_match(
                        "~[{$allowed_alpha}\d]{2,4}[{$allowed_alpha}\d{$allowed_separators}]+[{$allowed_alpha}\d]{2,8}~",
                        $cleared
                    ) === 1
                )
            );
        }

        return $stack[$value];
    }
}

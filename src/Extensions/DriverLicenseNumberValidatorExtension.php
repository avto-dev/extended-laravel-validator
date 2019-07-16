<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
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
 *  - 77 АВ 235662 (РФ)
 *  - 77 CY 235662 (РФ)
 *
 * @see <https://ru.wikipedia.org/wiki/Водительское_удостоверение>
 * @see <https://goo.gl/LL2tLB> Фотография ВУ РФ
 */
class DriverLicenseNumberValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'driver_license_number';
    }

    /**
     * {@inheritDoc}
     */
    public function passes(string $attribute, $value): bool
    {
        // Статический стек для хранения результатов валидации (для быстродействия)
        static $stack = [];

        // Если значение в стеке уже есть - то просто возвращаем его
        if (! isset($stack[$value])) {
            // Разрешенные символы
            static $alpha = 'АВЕКМНОРСТУХABEKMHOPCTYX';

            // Разрешенные разделители групп номера
            static $separators = '\\s';

            // Переводим значение в верхний регистр
            $uppercase = Str::upper($value);

            // Удаляем все символы, кроме разрешенных
            $cleared = (string) \preg_replace("~[^{$alpha}{$separators}\\d]~u", '', $uppercase);

            // Вычисляем длину получившейся строки
            $length = Str::length($cleared);

            $stack[$value] = (
                $length >= 10 && $length <= 12 // Проверяем соответствие минимальной и максимальной длине
                && $uppercase === $cleared // После удаления запрещенных символов - значение не изменилось
                && ( // Соответствует ли одному из шаблонов
                    \preg_match(
                        "~^[\\d]{2}[{$separators}]?([{$alpha}]{2}|\\d{2})[{$separators}]?[\\d]{6}$~iu",
                        $cleared
                    ) === 1
                )
            );
        }

        return $stack[$value];
    }
}

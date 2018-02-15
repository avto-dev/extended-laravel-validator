<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Class VinCodeValidatorExtension.
 *
 * Правило валидации VIN-кодов.
 *
 * Структура кода основана на стандартах ISO 3779-1983 и ISO 3780.
 * В VIN разрешено использовать только следующие символы латинского алфавита и арабские цифры:
 * 0 1 2 3 4 5 6 7 8 9 A B C D E F G H J K L M N P R S T U V W X Y Z
 *
 * Использовать буквы I, O, Q запрещено, так как они сходны по начертанию с цифрами 1, 0, а также между
 * собой.
 *
 * @see <http://goo.gl/xlDFCk>
 */
class VinCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'vin_code';
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
            // Значение в верхнем регистре
            $uppercase = Str::upper($value);

            // Удаляем все символы, кроме разрешенных
            $cleared = preg_replace('~[^0-9ABCDEFGHJKLMNPRSTUVWXYZ]~', '', $uppercase);

            $stack[$value] = (
                Str::length($value) === 17 // Длинна соответствует
                && $uppercase === $cleared // После удаления запрещенных символов - значение не изменилось
                && preg_match('~[A-Z]~', $uppercase) === 1 // Содержит символы
                && preg_match('~\d~', $value) === 1 // Содержит числа
                && ! Str::contains($uppercase, ['I', 'O', 'Q']) // Не содержит запрещенные символы
                && is_numeric(Str::substr($uppercase, -4, 4)) // Последние четыре символа обязательно числа
            );
        }

        return $stack[$value];
    }
}

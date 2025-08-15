<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Длина должна составлять 17 символов.
 * Допускаются только латинские буквы (за исключением I, O, Q) и цифры.
 * Последние четыре символа должны быть цифрами.
 * Должна присутствовать хотя бы одна буква и одна цифра, отличная от нуля.
 *
 * @see <https://gitlab.spectrumdata.tech/shared/ids/-/blob/dev/doc/format_control/rules/vehicle/VIN.md>
 */
class VinCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'vin_code';
    }

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        // Статический стек для хранения результатов валидации (для быстродействия)
        static $stack = [];

        // Если значение в стеке уже есть - то просто возвращаем его
        if (! isset($stack[$value])) {
            // Значение в верхнем регистре
            $uppercase = Str::upper($value);

            // Удаляем все символы, кроме разрешенных
            $cleared = \preg_replace('~[^0-9ABCDEFGHJKLMNPRSTUVWXYZ]~', '', $uppercase);

            $stack[$value] = (
                Str::length($value) === 17 // Длинна соответствует
                && $uppercase === $cleared // После удаления запрещенных символов - значение не изменилось
                && \preg_match('~[A-Z]~', $uppercase) === 1 // Содержит символы
                && \preg_match('~\d~', $value) === 1 // Содержит числа
                && ! Str::contains($uppercase, ['I', 'O', 'Q']) // Не содержит запрещенные символы
                && \is_numeric(Str::substr($uppercase, -4, 4)) // Последние четыре символа обязательно числа
                && preg_match('/^(?=.*[a-zA-Z])(?=.*[1-9]).*$/', $uppercase)  // Строка содержит хотя бы одну букву и одну цифру, отличную от нуля
            );
        }

        return $stack[$value];
    }
}

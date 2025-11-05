<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правила валидации VIN транспортного средства.
 *
 * 1. Длина 17 символов
 * 2. Верхний регистр
 * 3. Набор символов — цифры и латиница за исключением символов `Q`, `I`, `O`
 * 4. Последние четыре символа — цифры
 * 5. Хотя бы одна буква
 * 6. Хотя бы одна цифра != 0
 *
 * @see <https://gitlab.spectrumdata.tech/shared/ids/-/blob/dev/doc/README.md>
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
            // Удаляем все символы, кроме разрешенных
            $cleared = \preg_replace('~[^0-9ABCDEFGHJKLMNPRSTUVWXYZ]~', '', $value);

            $stack[$value] = (
                Str::length($value) === 17 // Длинна соответствует
                && $value === $cleared // После удаления запрещенных символов - значение не изменилось
                && \preg_match('~[A-Z]~', $value) === 1 // Содержит символы
                && \preg_match('~\d~', $value) === 1 // Содержит числа
                && ! Str::contains($value, ['I', 'O', 'Q']) // Не содержит запрещенные символы
                && \is_numeric(Str::substr($value, -4, 4)) // Последние четыре символа обязательно числа
                && preg_match('/^(?=.*[A-Z])(?=.*[1-9]).*$/', $value)  // Строка содержит хотя бы одну букву и одну цифру, отличную от нуля
            );
        }

        return $stack[$value];
    }
}

<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use AvtoDev\ExtendedLaravelValidator\Helpers\Strings;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правило валидации Номера Кузова (Body) транспортного средства.
 *
 * 1. Длина от 7 до 15 символов
 * 2. Верхний регистр
 * 3. Набор символов — латиница, кириллица, цифры
 * 4. Хотя бы одна цифра != 0
 * 5. Все буквы из одного алфавита
 */
class BodyCodeValidatorExtension extends AbstractValidatorExtension
{
    private const LENGTH_MIN = 7;
    private const LENGTH_MAX = 15;

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'body_code';
    }

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        if (!\is_string($value)) {
            return false;
        }

        $length = \mb_strlen($value, 'UTF-8');

        return $length >= self::LENGTH_MIN && $length <= self::LENGTH_MAX
            && Strings::hasOnlyUppercaseLetters($value)
            && Strings::hasOnlyUpperLettersAndDigits($value)
            && Strings::hasAtLeastOneNotZeroDigit($value)
            && !$this->hasBothAlphabets($value);
    }

    /**
     * Определяет содержание в строке символов из латинского и кириллического Алфавитов.
     *
     * @param string $value
     * @return bool
     */
    private function hasBothAlphabets(string $value): bool
    {
        return Strings::hasAtLeastOneLatinUpperLetter($value) && Strings::hasAtLeastOneCyrUpperLetter($value);
    }
}

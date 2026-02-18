<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use AvtoDev\ExtendedLaravelValidator\Helpers\Strings;
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
        return \is_string($value)
            && $this->hasVinCodeFormat($value)
            && Strings::hasAtLeastOneLatinUpperLetter($value)
            && Strings::hasAtLeastOneNotZeroDigit($value);
    }

    /**
     * Определяет соответствие общему формату VIN транспортного средства.
     *
     * @param string $value
     * @return bool
     */
    private function hasVinCodeFormat(string $value): bool
    {
        return preg_match('/^[A-HJ-NPR-Z0-9]{13}[0-9]{4}$/', $value) === 1;
    }
}

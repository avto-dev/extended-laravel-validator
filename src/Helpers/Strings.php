<?php
declare(strict_types=1);

namespace AvtoDev\ExtendedLaravelValidator\Helpers;

/**
 * @internal
 */
class Strings
{
    /**
     * @param string $value
     * @return bool
     */
    public static function hasAtLeastOneNotZeroDigit(string $value): bool
    {
        return \preg_match('/[1-9]/', $value) === 1;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function hasAtLeastOneLatinUpperLetter(string $value): bool
    {
        return \preg_match('/[A-Z]/', $value) === 1;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function hasAtLeastOneCyrUpperLetter(string $value): bool
    {
        return \preg_match('/[А-ЯЁ]/u', $value) === 1;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function hasOnlyUppercaseLetters(string $value): bool
    {
        return \preg_match('/[a-zа-яё]/u', $value) === 0;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function hasOnlyUpperLettersAndDigits(string $value): bool
    {
        return \preg_match('/^[A-ZА-ЯЁ0-9]+$/u', $value) === 1;
    }
}

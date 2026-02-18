<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правила валидации для номера электронного паспорта транспортного средства (ЭПТС).
 *
 * Номер представляет собой цифровой 15-тизначный код:
 * - может начинаться с 1, 2 и 3
 * - шестой символ должен быть 1, 2, 3 или 4
 */
class EptsCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'epts_code';
    }

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        return is_string($value) && $this->hasEptsCodeFormat($value);
    }

    /**
     * Определяет соответствие общему формату номеру ЭПТС.
     *
     * @param string $value
     *
     * @return bool
     */
    private function hasEptsCodeFormat(string $value): bool
    {
        return \preg_match('/^[1-3][0-9]{4}[1-4][0-9]{9}$/', $value) === 1;
    }
}

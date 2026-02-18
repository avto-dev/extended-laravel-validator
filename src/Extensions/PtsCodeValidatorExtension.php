<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правило валидации номера паспорта транспортного средства (ПТС).
 */
class PtsCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'pts_code';
    }

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        return \is_string($value) && $this->hasPtsCodeFormat($value);
    }

    /**
     * Определяет соответствие общему формату номеру ПТС.
     *
     * @param string $value
     *
     * @return bool
     */
    private function hasPtsCodeFormat(string $value): bool
    {
        return \preg_match('/^\d{2}\s?[А-ЯЁ]{2}\s?\d{6}$/u', $value) === 1;
    }
}

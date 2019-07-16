<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

/**
 * Правило валидации номера паспорта транспортного средства (ПТС).
 *
 * По всей видимости правило валидации аналогичное правилу валидации номера СТС.
 *
 * @see StsCodeValidatorExtension
 */
class PtsCodeValidatorExtension extends StsCodeValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'pts_code';
    }
}

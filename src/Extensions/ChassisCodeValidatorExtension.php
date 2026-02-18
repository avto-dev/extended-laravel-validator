<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

/**
 * Правило валидации номера Шасси (Chassis) транспортного средства.
 */
class ChassisCodeValidatorExtension extends BodyCodeValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chassis_code';
    }
}

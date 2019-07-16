<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\ChassisCodeValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\ChassisCodeValidatorExtension<extended>
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class ChassisCodeValidatorExtensionTest extends BodyCodeValidatorExtensionTest
{
    /**
     * {@inheritDoc}
     */
    protected function getExtensionClassName(): string
    {
        return ChassisCodeValidatorExtension::class;
    }

    /**
     * {@inheritDoc}
     */
    protected function getValidValues(): array
    {
        return array_merge(parent::getValidValues(), [
            'RN1350007371',
            'LH800023313',
            'TA01W863799',
            'LN130-0128818',
            'SE28M404312',
            'UZJ100-0140027',
            'K971009415',
        ]);
    }
}

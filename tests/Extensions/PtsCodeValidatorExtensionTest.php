<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\PtsCodeValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\PtsCodeValidatorExtension<extended>
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class PtsCodeValidatorExtensionTest extends StsCodeValidatorExtensionTest
{
    /**
     * {@inheritDoc}
     */
    protected function getExtensionClassName(): string
    {
        return PtsCodeValidatorExtension::class;
    }
}

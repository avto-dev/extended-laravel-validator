<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\PtsCodeValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\PtsCodeValidatorExtension
 * @covers \AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension::message
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class PtsCodeValidatorExtensionTest extends StsCodeValidatorExtensionTest
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName(): string
    {
        return PtsCodeValidatorExtension::class;
    }
}

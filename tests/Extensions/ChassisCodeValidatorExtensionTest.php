<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\ChassisCodeValidatorExtension;

class ChassisCodeValidatorExtensionTest extends BodyCodeValidatorExtensionTest
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName()
    {
        return ChassisCodeValidatorExtension::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidValues()
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

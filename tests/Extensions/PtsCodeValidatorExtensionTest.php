<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\PtsCodeValidatorExtension;

/**
 * Class PtsCodeValidatorExtensionTest.
 *
 * Так как метод валидации номера ПТС аналогичен методу валидации СТС - то наследуемся от его класса.
 */
class PtsCodeValidatorExtensionTest extends StsCodeValidatorExtensionTest
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName()
    {
        return PtsCodeValidatorExtension::class;
    }
}

<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions\Stubs;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

class ExtensionStub extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'foo';
    }

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        return true;
    }
}

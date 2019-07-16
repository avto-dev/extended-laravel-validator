<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions\Stubs;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

class ExtensionStub extends AbstractValidatorExtension
{
    /**
     * {@inheritDoc}
     */
    public function name()
    {
        return 'foo';
    }

    /**
     * {@inheritDoc}
     */
    public function passes($attribute, $value)
    {
        return true;
    }
}

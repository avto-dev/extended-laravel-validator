<?php

namespace AvtoDev\ExtendedLaravelValidator;

use Illuminate\Support\Str;

/**
 * Class AbstractValidatorExtension.
 */
abstract class AbstractValidatorExtension implements ValidationExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function name();

    /**
     * {@inheritdoc}
     */
    abstract public function passes($attribute, $value);

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return sprintf('This is not valid "%s"', Str::camel($this->name()));
    }
}

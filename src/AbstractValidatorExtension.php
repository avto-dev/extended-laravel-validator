<?php

namespace AvtoDev\ExtendedLaravelValidator;

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
        return "This is not valid [{$this->name()}]";
    }
}

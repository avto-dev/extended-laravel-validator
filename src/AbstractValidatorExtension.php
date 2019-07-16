<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator;

abstract class AbstractValidatorExtension implements ValidationExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function message(): string
    {
        return "This is not valid [{$this->name()}]";
    }
}

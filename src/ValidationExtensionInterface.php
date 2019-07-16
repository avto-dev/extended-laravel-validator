<?php

namespace AvtoDev\ExtendedLaravelValidator;

interface ValidationExtensionInterface
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @see \Illuminate\Contracts\Validation\Rule
     *
     * @return bool
     */
    public function passes(string $attribute, $value): bool;

    /**
     * Get the validation error message.
     *
     * @see \Illuminate\Contracts\Validation\Rule
     *
     * @return string
     */
    public function message(): string;

    /**
     * Get the validation rule name.
     *
     * @return string
     */
    public function name(): string;
}

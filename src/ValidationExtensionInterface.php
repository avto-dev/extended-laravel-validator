<?php

namespace AvtoDev\ExtendedLaravelValidator;

/**
 * Interface ValidationExtensionInterface.
 */
interface ValidationExtensionInterface
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @see \Illuminate\Contracts\Validation\Rule
     *
     * @return bool
     */
    public function passes($attribute, $value);

    /**
     * Get the validation error message.
     *
     * @see \Illuminate\Contracts\Validation\Rule
     *
     * @return string
     */
    public function message();

    /**
     * Возвращает имя правила валидатора.
     *
     * @return string
     */
    public function name();
}

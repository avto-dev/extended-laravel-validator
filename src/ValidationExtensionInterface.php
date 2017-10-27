<?php

namespace AvtoDev\ExtendedLaravelValidator;

use Illuminate\Contracts\Validation\Rule as ValidationRule;

/**
 * Interface ValidationExtensionInterface.
 */
interface ValidationExtensionInterface extends ValidationRule
{
    /**
     * Возвращает имя правила валидатора.
     *
     * @return string
     */
    public function name();
}

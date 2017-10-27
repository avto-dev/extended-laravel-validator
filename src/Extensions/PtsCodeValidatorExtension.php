<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

/**
 * Class PtsCodeValidatorExtension.
 *
 * Правило валидации номера паспорта транспортного средства (ПТС).
 *
 * По всей видимости правило валидации аналогичное правилу валидации номера СТС.
 *
 * @see StsCodeValidatorExtension
 */
class PtsCodeValidatorExtension extends StsCodeValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'pts_code';
    }
}

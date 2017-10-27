<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

/**
 * Class ChassisCodeValidatorExtension.
 *
 * Правило валидации номера шасси транспортного средства.
 *
 * Конкретные данные о стандарте номера не были найдены на момент написания данных строк.
 *
 * По всей видимости правило валидации аналогичное правилу валидации номера кузова.
 *
 * @see https://ru.wikipedia.org/wiki/Рама_(автомобиль)
 */
class ChassisCodeValidatorExtension extends BodyCodeValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'chassis_code';
    }
}

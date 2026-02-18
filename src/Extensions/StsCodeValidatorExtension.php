<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правило валидации номера свидетельства о регистрации транспортного средства (СТС).
 *
 * Серия представляет собой четыре знака: 2 цифры - пробел - 2 буквы. Например, «11 АА». Далее идет номер
 * свидетельства, состоящий из 6 цифр. То есть в итоге, мы сможем увидеть следующую запись: «11 АА 112233».
 *
 * Вместо букв так же могут быть и цифры.
 *
 * @see https://ru.wikipedia.org/wiki/Свидетельство_о_регистрации_транспортного_средства
 */
class StsCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'sts_code';
    }

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        return \is_string($value) && $this->hasStsCodeFormat($value);
    }

    /**
     * Определяет соответствие общему формату СТС.
     *
     * @param string $value
     *
     * @return bool
     */
    private function hasStsCodeFormat(string $value): bool
    {
        return \preg_match('/^\d{2}\s?([А-ЯЁ]{2}|\d{2})\s?\d{6}$/u', $value) === 1;
    }
}

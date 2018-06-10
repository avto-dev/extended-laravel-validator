<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
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
    public function name()
    {
        return 'sts_code';
    }

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        // Статический стек для хранения результатов валидации (для быстродействия)
        static $stack = [];

        // Если значение в стеке уже есть - то просто возвращаем его
        if (! isset($stack[$value])) {
            // Разрешенные кириллические символы
            static $kyr_chars = 'А-ЯЁ';

            // Значение в верхнем регистре
            $uppercase = Str::upper($value);

            // Вычисляем длину строки
            $length = Str::length($uppercase);

            $stack[$value] = (
                $length >= 10 && $length <= 12 // Проверяем соответствие минимальной и максимальной длине
                // Соответствует ли шаблону
                && \preg_match("~^\d{2}(\s|)([{$kyr_chars}]{2}|\d{2})(\s|)\d{6}$~u", $uppercase) === 1
            );
        }

        return $stack[$value];
    }
}

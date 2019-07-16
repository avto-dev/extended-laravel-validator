<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правило валидации номера кузова транспортного средства.
 *
 * Конкретные данные о стандарте номера не были найдены на момент написания данных строк.
 *
 * @see https://ru.wikipedia.org/wiki/Паспорт_транспортного_средства
 */
class BodyCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'body_code';
    }

    /**
     * {@inheritdoc}
     */
    public function passes(string $attribute, $value): bool
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
                $length >= 7 && $length <= 15 // Проверяем соответствие минимальной и максимальной длине
                && \preg_match('~\d~', $value) === 1 // Содержит числа
                // Соответствует ли шаблону
                && \preg_match("~^[{$kyr_chars}A-Z\d]{2,}(\-|\s|)[{$kyr_chars}A-Z\d]{2,9}$~iu", $uppercase) === 1
            );
        }

        return $stack[$value];
    }
}

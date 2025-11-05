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
     *
     * @param string $value
     */
    public function passes(string $attribute, $value): bool
    {
        // Статический стек для хранения результатов валидации (для быстродействия)
        static $stack = [];

        // Если значение в стеке уже есть - то просто возвращаем его
        if (! isset($stack[$value])) {
            // Вычисляем длину строки
            $length = Str::length($value);

            $stack[$value] = (
                $length >= 7 && $length <= 15 // Проверяем соответствие минимальной и максимальной длине
                && \preg_match('/[a-zа-яё]/u', $value) === 0 // Не содержит символов в нижнем регистре
                && \preg_match('/^[A-ZА-ЯЁ0-9]+$/u', $value) === 1 // Содержит только латиницу, кириллицу и цифры
                && \preg_match('/[1-9]/', $value) === 1 // Хотя бы одна цифра != 0
                && ! (\preg_match('/[A-Z]/', $value) && \preg_match('/[А-ЯЁ]/u', $value)) // Все буквы из одного алфавита
            );
        }

        return $stack[$value];
    }
}

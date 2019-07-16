<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Правило валидации кадастровый номер (КН).
 *
 * Кадастровый номер состоит из 4 групп цифр разделенных двоеточием ( например 61:58:0002046:11 )
 * другие символы [пробел|-|.|,|*|/|;] - не поддерживаются
 *
 * Длина кадастрового номера может быть от 14 до 20 символов (с учетом знака ":")
 *
 * Кадастровый номер земельного участка выглядит так: АА:ВВ:CCCCСCC:КК, где: *
 * - АА — кадастровый округ (2 цифры)
 * - ВВ — кадастровый район (2 цифры)
 * - CCCCCCС — кадастровый квартал (6 или 7 цифр)
 * - КК — номер земельного участка (от 1 до 6 цифр)
 *
 * Примеры кадастровых номеров:
 *  - 61:58:0002046:11
 *  - 77:01:0001000:229
 *  - 77:01:100500:1000
 *  - 54:19:164801:565
 *
 * @see <https://ru.wikipedia.org/wiki/Кадастровый_номер>
 * @see <https://images.app.goo.gl/ZkyiCXxvYAHMzjRU9> Изображение с кадастровым номером
 */
class CadastralNumberValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'cadastral_number';
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
            // Удаляем все символы, кроме разрешенных
            // Разрешены только цифры и знак ":"
            $cleared = (string) \preg_replace('~[^\\d:]~u', '', (string) $value);

            // Вычисляем длину получившейся строки
            $length = Str::length($cleared);

            $stack[$value] = (
                $length >= 14 && $length <= 20 // Проверяем соответствие минимальной и максимальной длине
                && $value === $cleared // После удаления запрещенных символов - значение не изменилось
                && ( // Соответствует ли одному из шаблонов
                    \preg_match(
                        '~^[\\d]{2}:[\\d]{2}:[\\d]{6,7}:[\\d]{1,6}$~iu',
                        $cleared
                    ) === 1
                )
            );
        }

        return $stack[$value];
    }
}

<?php

namespace AvtoDev\ExtendedLaravelValidator\Extensions;

use Illuminate\Support\Str;
use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;

/**
 * Class GrzCodeValidatorExtension.
 *
 * Правило валидации ГРЗ-номеров.
 *
 * "ГОСТ Р 50577-93" для использования на знаках разрешены 12 букв кириллицы, имеющие графические аналоги в
 * латинском алфавите — А, В, Е, К, М, Н, О, Р, С, Т, У и Х.
 *
 * Так же ГРЗ-номера бывают следующих видов:
 *  - А001АА177
 *  - АА0001177 (данный формат часто используются как номер прицепа)
 *  - 0001АА177 (--//--)
 *
 * @see <http://goo.gl/DS3wnD>
 */
class GrzCodeValidatorExtension extends AbstractValidatorExtension
{
    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'grz_code';
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
            static $kyr_chars = 'АВЕКМНОРСТУХ';

            // Значение в верхнем регистре
            $uppercase = Str::upper($value);

            // Удаляем все символы, кроме разрешенных
            $cleared = preg_replace("~[^0-9$kyr_chars]~u", '', $uppercase);

            // Вычисляем длину получившейся строки
            $length = Str::length($cleared);

            $stack[$value] = (
                $length >= 8 && $length <= 9 // Проверяем соответствие минимальной и максимальной длине
                && $uppercase === $cleared // После удаления запрещенных символов - значение не изменилось
                && ( // Соотв. ли шаблону
                    preg_match("~[$kyr_chars]{1}\d{3}[$kyr_chars]{2}\d{2,3}~u", $cleared) === 1 // А001АА177
                    || preg_match("~[$kyr_chars]{2}\d{4}\d{2,3}~u", $cleared) === 1 // АА0001177
                    || preg_match("~\d{4}[$kyr_chars]{2}\d{2,3}~u", $cleared) === 1 // 0001АА177
                )
            );
        }

        return $stack[$value];
    }
}

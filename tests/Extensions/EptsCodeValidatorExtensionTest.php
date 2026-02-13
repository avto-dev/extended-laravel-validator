<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\EptsCodeValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\EptsCodeValidatorExtension
 * @covers \AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension::message
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class EptsCodeValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName(): string
    {
        return EptsCodeValidatorExtension::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidValues(): array
    {
        return [
            '12345178901234',      // менее 15 символов
            '1234517890123456',    // более 15 символов
            '  123451789012345  ', // лишние символы пробелов в начале и в конце
            '12345178901234A',     // содержит латинскую букву
            '12345178901234А',     // содержит кириллическую букву
            '12345178901234.',     // содержит точку
            '123451789-12345',     // содержит дефис
            '123451789 12345',     // содержит пробел
            '000001100000000',     // не может начинаться с 0
            '400001100000000',     // не может начинаться с 4
            '500001100000000',     // не может начинаться с 5
            '600001100000000',     // не может начинаться с 6
            '700001100000000',     // не может начинаться с 7
            '800001100000000',     // не может начинаться с 8
            '900001100000000',     // не может начинаться с 9
            '100000100000000',     // шестой символ не может быть 0
            '100005100000000',     // шестой символ не может быть 5
            '100006100000000',     // шестой символ не может быть 6
            '100007100000000',     // шестой символ не может быть 7
            '100008100000000',     // шестой символ не может быть 8
            '100009100000000',     // шестой символ не может быть 9
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidValues(): array
    {
        return [
            '123451789012345', // просто валидный EPTS, состоящий из 15 цифр
            '100001100000000', // валидный EPTS начинающийся с 1
            '200001100000000', // валидный EPTS начинающийся с 2
            '300001100000000', // валидный EPTS начинающийся с 3
            '100001100000000', // валидный EPTS с шестым символом 1
            '100002100000000', // валидный EPTS с шестым символом 2
            '100003100000000', // валидный EPTS с шестым символом 3
            '100004100000000', // валидный EPTS с шестым символом 4
        ];
    }
}

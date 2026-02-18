<?php
declare(strict_types=1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Helpers;

use AvtoDev\ExtendedLaravelValidator\Helpers\Strings;
use AvtoDev\ExtendedLaravelValidator\Tests\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Helpers\Strings
 */
class StringsTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testHasAtLeastOneNotZeroNumber(): void
    {
        $cases = [
            'bar0' => false,
            '0000 ' => false,
            '00001 ' => true,
            'foobar' => false,
            '123456789 ' => true,
            '1234567890 ' => true,
            '0123456789 ' => true,
            '0123405678090 ' => true,
        ];

        foreach ($cases as $value => $expected) {
            $this->assertSame(
                $expected, Strings::hasAtLeastOneNotZeroDigit($value),
                'Case "' . $value . '" failed'
            );
        }
    }

    /**
     * @return void
     */
    public function testHasAtLeastOneLatinUpperLetter(): void
    {
        $cases = [
            'BAR0' => true,
            'bar0' => false,
            'FOOBAR' => true,
            '*F-*OO' => true,
            'ФD}}}}' => true,
            'foobar' => false,
            'BAR 0 FOO' => true,
            'BAR 0 FOO-' => true,
            '123456789 ' => false,
            '1234567890 ' => false,
            '0123456789 ' => false,
            '0123405678090 ' => false,
        ];

        foreach ($cases as $value => $expected) {
            $this->assertSame(
                $expected, Strings::hasAtLeastOneLatinUpperLetter($value),
                'Case "' . $value . '" failed'
            );
        }
    }

    /**
     * @return void
     */
    public function testHasAtLeastOneCyrUpperLetter(): void
    {
        $cases = [
            '2 ' => false,
            'BAR0' => false,
            'bar0' => false,
            '1111 ' => false,
            'ФD}}}}' => true,
            'FOOBAR' => false,
            '*F-*OO' => false,
            'FOOBARФ' => true,
            'foobarф' => false,
            'BAR Ф FOO' => true,
            'bar ф foo' => false,
            '123456789 ' => false,
            '167890ФФФФФФ' => true,
            '167890фффффф' => false,
        ];

        foreach ($cases as $value => $expected) {
            $this->assertSame(
                $expected, Strings::hasAtLeastOneCyrUpperLetter($value),
                'Case "' . $value . '" failed'
            );
        }
    }

    /**
     * @return void
     */
    public function testHasOnlyUppercaseLetters(): void
    {
        $cases = [
            '2 ' => true,
            'BAR0' => true,
            'bar0' => false,
            '1111 ' => true,
            'ФD}}}}' => true,
            'FOOBAR' => true,
            '*F-*OO' => true,
            'FOOBARФ' => true,
            'foobarф' => false,
            'BAR Ф FOO' => true,
            'bar ф foo' => false,
            '123456789 A' => true,
            '167890ФФФФФФ' => true,
            '167890ффффффЫ' => false,
        ];

        foreach ($cases as $value => $expected) {
            $this->assertSame(
                $expected, Strings::hasOnlyUppercaseLetters($value),
                'Case "' . $value . '" failed'
            );
        }
    }

    /**
     * @return void
     */
    public function testHasOnlyUpperLettersAndDigits(): void
    {
        $cases = [
            '2 ' => false,
            'BAR0' => true,
            '1111 ' => false,
            'FOOBAR' => true,
            '*F-*OO' => false,
            'FOOBARФ' => true,
            'ФD}}}1}' => false,
            'foobarф' => false,
            'BAR Ф FOO' => false,
            '123456789A' => true,
            '123456789a' => false,
            '167890ФФФФФФ' => true,
            '167890фффффф' => false,
        ];

        foreach ($cases as $value => $expected) {
            $this->assertSame(
                $expected, Strings::hasOnlyUpperLettersAndDigits($value),
                'Case "' . $value . '" failed'
            );
        }
    }
}

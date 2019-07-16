<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\DriverLicenseNumberValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\DriverLicenseNumberValidatorExtension<extended>
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class DriverLicenseNumberValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function getExtensionClassName(): string
    {
        return DriverLicenseNumberValidatorExtension::class;
    }

    /**
     * {@inheritDoc}
     */
    protected function getInvalidValues(): array
    {
        return [
            // Слишком длинные
            '74 14292010 00000000000000000000',
            '77 1000000000000000000006 235662',
            '190195-0000000000000000000000000',
            '23506/000000000000000000004/2469',

            // Слишком короткие
            '74 14 290',
            '77 2662',
            '190-00',
            '23/4/248',

            // Содержащие запрещенные альфа-символы
            '66 AQ 123456',
            '66 AW 123456',
            '66 AR 123456',
            '66 AU 123456',
            '66 AI 123456',
            '66 AS 123456',
            '66 AF 123456',
            '66 AG 123456',
            '66 AJ 123456',
            '66 AL 123456',
            '66 AZ 123456',
            '66 AV 123456',
            '66 AN 123456',
            '66 AЙ 123456',
            '66 AЦ 123456',
            '66 AГ 123456',
            '66 AШ 123456',
            '66 AЩ 123456',
            '66 AЗ 123456',
            '66 AЪ 123456',
            '66 AФ 123456',
            '66 AЫ 123456',
            '66 AП 123456',
            '66 AЛ 123456',
            '66 AД 123456',
            '66 AЖ 123456',
            '66 AЭ 123456',
            '66 AЯ 123456',
            '66 AЧ 123456',
            '66 AИ 123456',
            '66 AЬ 123456',
            '66 AБ 123456',
            '66 AЮ 123456',

            // Содержащие символы там, где их быть не должно
            '66 12 BA3456',
            'BA 12 123456',
            '66 12 12BA56',
            '66 12 123BA5',

            // Содержащие излишние пробелы и др. разделители
            '  74 14 292010',
            '77 16 235662 ',
            '77 16  235662',
            '77  16 235662',
            '190195--0000',
            '23506/04//2469',
            '23506/  04/2469',

            // Содержащие запрещенные символы
            '74 14 292%10',
            '77 1? 235662',
            '19;195-0000',
            '23506/04/246*',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getValidValues(): array
    {
        return [
            '74 14 292010',
            '7414292010',
            '7414 292010',
            '74 14292010',

            '77 16 235662',
            '7716235662',
            '7716 235662',
            '77 16235662',

            '66 02 123456',
            '6602123456',
            '66 02123456',
            '6602 123456',

            '66 АК 123456',
            '66АК123456',
            '66 АК123456',
            '66АК 123456',

            '66 BA 123456',
            '66BA123456',
            '66 BA123456',
            '66BA 123456',

            '66 CY 123456',
            '66CY123456',
            '66 CY123456',
            '66CY 123456',
        ];
    }
}

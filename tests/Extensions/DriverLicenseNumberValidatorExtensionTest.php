<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\DriverLicenseNumberValidatorExtension;

/**
 * Class DriverLicenseNumberValidatorExtensionTest.
 */
class DriverLicenseNumberValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName()
    {
        return DriverLicenseNumberValidatorExtension::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidValues()
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

            // Содержащие излишние пробелы и др. разделители
            '  74 14 292010',
            '77 16 235662 ',
            '77 16  235662',
            '77  16 235662',
            '190195--0000',
            '23506/04//2469',
            '23506/  04/2469',

            // Содержащие кириллицу
            '74 АВ 292010',
            '77 16 23Н662',
            '1АО195-0000',
            '235Н6/04/2469',

            // Содержащие запрещенные символы
            '74 14 292%10',
            '77 1? 235662',
            '19;195-0000',
            '23506/04/246*',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidValues()
    {
        return [
            '74 14 292010',
            '77 16 235662',
            '190195-0000',
            '23506/04/2469',
            '23abz6/04/2469',
            '23ABZ6/04/2469',
        ];
    }
}

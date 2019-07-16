<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\CadastralNumberValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\CadastralNumberValidatorExtension<extended>
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class CadastralNumberValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function getExtensionClassName(): string
    {
        return CadastralNumberValidatorExtension::class;
    }

    /**
     * {@inheritDoc}
     */
    protected function getInvalidValues(): array
    {
        return [
            '66:01:0000000:2013156',
            '66:1:0000000:2013',
            '66:1:0000000:201',
            '66:1:0000000:201',

            '66:01:0000000-201',
            '315 420 870 58 999',

            '6-01-0000000-201',
            '   6-01-0000000-201  ',
            '6-01-,S00-201  ',
            '6-01-,S00-2:ZZ1  ',
            'AB:DE:FGHIJKL:MN ',
            'AB:DE:FGHIJKL-16',
            '50-50-62/081/2014-139',
            '664102040432302',
            '66-66/001-66-66-01/822/2014-358/1',
            '66:01:000000:2 - 66-66/001-66-66-01/822/2014-358/1',
            '66/01/000000/2 - 66-66/001-66-66-01/822/2014-358/1',

            '66/41/0000000/38949',
            '66;41;0000000;38949',
            '66\'41\'0000000\'38949',
            '66"41"0000000"38949',
            '66.41.0000000.38949',
            '66,41,0000000,38949',
            '66-41-0000000-38949',
            '66=41=0000000=38949',
            '66*41*0000000*38949',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getValidValues(): array
    {
        return [
            '66:01:000000:2',
            '66:01:0000000:2013',
            '66:01:0000000:201',
            '66:01:0000000:20',

            '77:01:0001000:229',
            '77:01:0005001:1000',
            '77:01:100500:1000',
            '02:00:000000:736',

            '66:41:0000000:81545',
            '66:41:0000000:102360',

            '66:11:0000000:10062',
            '66:21:0000000:10097',
            '66:31:0000000:10145',
            '66:41:0000000:10180',
            '66:51:0000000:10232',
            '66:61:0000000:10289',
            '66:71:0000000:10293',
            '66:81:0000000:10297',
            '66:91:0000000:10371',
            '66:41:0105001:3',
            '66:41:0106033:23',
            '66:41:0106154:59',
            '02:57:040406:425',
            '50:45:0000000:20320',
            '54:19:164801:565',
            '66:41:0000000:26588',
            '66:41:0000000:38949',
        ];
    }
}

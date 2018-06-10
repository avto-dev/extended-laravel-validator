<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\BodyCodeValidatorExtension;

class BodyCodeValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName()
    {
        return BodyCodeValidatorExtension::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidValues()
    {
        return [
            // Слишком длинные
            'ZZT241123456-0007004',
            'ZZT24112345-0007004',
            'ZZT2411234-0007004',
            'ZZT241123-0007004',
            'ZZT24112-0007004',
            'ZZT241-0007004123456',
            'ZZT241-000700412345',
            'ZZT241-00070041234',
            'ZZT241-0007004123',
            'ZZT241-000700412',

            // Слишком короткие
            '068525',
            '06852',
            '0685',
            '068',
            '06',
            '0',

            // Содержащие пробелы там, где не надо
            ' SF5091230',
            'BJ5W117467 ',
            ' JZX90-0025950 ',
            '  HK30310303 ',
            ' NZE1243011784  ',
            'SV43  - 0008767',

            // Содержащие запрещенные символы
            'GA31035%90',
            'Z26A5#01387',
            'JCG:00044285',
            'SF50912?0',
            'BJ5%117467',
            'JZX90-00259**',
            'HK30%10303',
            'NZE1243011"84',
            'SV43-?*08767',

            // Состоящие только из букв
            'SVSVSVSVSVS',
            'KSPKSPKSPKSP',
            'GXGXGXGXGXGX',
            'ZNEZN-ZNEZNEZ',
            'CECEC-CECECEC',
            'GSGSGSGSGSGS',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidValues()
    {
        return [
            '0685251',
            'AT2113041080',
            'NZE141-9134919',
            'GD11231271',
            'GX115-0001807',
            'LS131701075',
            'FN15-002153',
            'S15-017137',
            'NT30305643',
            'AT2120020984',
            'JZX930012010',
            'AT2110076157',
            'EXZ10-0040809',
            'NU3030532899',
            'AE1015080276',
            'NZE1210079301',
            'AT190-4018171',
            'DC5R101807',
            'GA31035490',
            'Z26A5101387',
            'JCG100044285',
            'SF5091230',
            'BJ5W117467',
            'JZX90-0025950',
            'HK30310303',
            'NZE1243011784',
            'SV43-0008767',
            'Z27A0300360',
            'SV320027585',
            'KSP921001169',
            'GX1006108167',
            'ZNE10-0237030',
            'CE105-0005302',
            'GS1510019960',
            'P25W-0506755',
            'ST1900038890',
            'SXA100090135',
            'SGLW301293',
            'ZCT10-0020100',
            'GRX130-6026674',
            'JZX90-6562365',
            'E11012005',
            'KAБ 1601036', // ?
            'PE8W0115960',
            'SXE100010919',
            'LH1681001088',
            'ZNE10-0195718',
            'ST190-4020234',
            'NZE1210273553',
            'ZZT241-0007004',
            'SRF9W401273',
            'ST1830020258',
            'JZX90-6500314',
            'JZX90 6500314',
            'ZZT2410023674',
            'LS151-0002351',
            'SG5-050150',
            'NCP58-0025169',
            'Z10169738',
            'VEW11500278',
            'ZNE10-0126698',
            'ZNE10-012669853',
            'CR305023587',
            'HP11724818',
            'CF51100187',
        ];
    }
}

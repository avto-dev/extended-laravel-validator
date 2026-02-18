<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\Extensions\BodyCodeValidatorExtension;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\Extensions\BodyCodeValidatorExtension
 * @covers \AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension::message
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider::boot
 */
class BodyCodeValidatorExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @return void
     */
    public function testInvalidValueType(): void
    {
        $cases = [
            new \stdClass(),
            false,
            1.222,
            []
        ];

        $instance = new BodyCodeValidatorExtension;

        foreach ($cases as $case) {
            $this->assertFalse($instance->passes('foo', $case));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtensionClassName(): string
    {
        return BodyCodeValidatorExtension::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidValues(): array
    {
        return [
            // Слишком длинные
            'А123ВС456789012345',
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
            'А12ВС4',
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
            '  А123ВС45  ',
            // Содержащие строчные буквы
            'A123bC45',
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
            'А12.ВС45',
            'А12-ВС45',
            'А12 ВС45',
            'А12@ВС45',

            // Состоящие только из букв
            'SVSVSVSVSVS',
            'KSPKSPKSPKSP',
            'GXGXGXGXGXGX',
            'ZNEZN-ZNEZNEZ',
            'CECEC-CECECEC',
            'GSGSGSGSGSGS',

            // Хотя бы одна цифра, отличная от нуля
            'АБВГДЕЁ',
            'А000ВС00',

            // Смешанный алфавит
            'А123BC45',
            'A123ВС45',
            'NZE141-9134919',
            'GX115-0001807',
            'FN15-002153',
            'EXZ10-0040809',
            'AT190-4018171',
            'JZX90-0025950',
            'SV43-0008767',
            'ZNE10-0237030',
            'CE105-0005302',
            'P25W-0506755',
            'ZCT10-0020100',
            'GRX130-6026674',
            'JZX90-6562365',
            'KAБ 1601036',
            'ZNE10-0195718',
            'KAБИHA2253831',
            'HEYCTAH0BЛEH0',
            'ФYPГ0H597108',
            'KAБИHA30093',
            'CK0HИK0M',
            '2197777KAБИHA',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidValues(): array
    {
        return [
            '0000036',
            '0000460',
            '2019073',
            'U053459',
            'W078654',
            'ME89732',
            'B930128',
            'А123ВС45',
            'A123BC45',
            'А100000',
            '0100000',
            'ABCDEFG1',
            'АБВГДЕЁ1',
            'AT2113041080',
            'NZE1419134919',
            'GD11231271',
            'GX1150001807',
            'LS131701075',
            'FN15002153',
            'S15017137',
            'NT30305643',
            'AT2120020984',
            'JZX930012010',
            'AT2110076157',
            'EXZ100040809',
            'NU3030532899',
            'AE1015080276',
            'NZE1210079301',
            'AT1904018171',
            'DC5R101807',
            'GA31035490',
            'Z26A5101387',
            'JCG100044285',
            'SF5091230',
            'BJ5W117467',
            'JZX900025950',
            'HK30310303',
            'NZE1243011784',
            'SV430008767',
            'Z27A0300360',
            'SV320027585',
            'KSP921001169',
            'GX1006108167',
            'ZNE100237030',
            'CE1050005302',
            'GS1510019960',
            'P25W0506755',
            'ST1900038890',
            'SXA100090135',
            'SGLW301293',
            'ZCT100020100',
            'GRX1306026674',
            'JZX906562365',
            'E11012005',
            'КАБ1601036',
            'PE8W0115960',
            'SXE100010919',
            'LH1681001088',
            'ZNE100195718',
            'ST1904020234',
            'NZE1210273553',
            'ZZT2410007004',
            'SRF9W401273',
            'ST1830020258',
            'JZX906500314',
            'ZZT2410023674',
            'LS1510002351',
            'SG5050150',
            'NCP580025169',
            'Z10169738',
            'VEW11500278',
            'ZNE100126698',
            'ZNE10012669853',
            'CR305023587',
            'HP11724818',
            'CF51100187',
        ];
    }
}

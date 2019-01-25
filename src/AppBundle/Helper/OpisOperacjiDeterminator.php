<?php

namespace AppBundle\Helper;


class OpisOperacjiDeterminator
{

//    const BLIK_ZAKUP_ID = 1;
//    const PRZELEW_ZEWNETRZNY_WYCHODZACY_ID = 1;
//    const PRZELEW_WLASNY_ID = 1;
//    const PRZELEW_ZEWNETRZNY_PRZYCHODZACY_ID = 1;
//    const PRZELEW_MTRANSFER_WYCHODZACY_ID = 1;
//    const BLIK_WYPLATA_ATM_KRAJOWY_ID = 1;
//    const PRZELEW_EKSPRESOWY_ID = 1;
//    const PRZELEW_EKSPRESOWY_ID = 1;
//    const PRZELEW_EKSPRESOWY_ID = 1;
//    const PRZELEW_EKSPRESOWY_ID = 1;

    public function getIntegerValue($string)
    {
        $integerValue = 0;
        $tablica_operacji = [
            [
                'regex' => '/PRZELEW ZEWN.TRZNY WYCHODZ.CY/',
                'id'    => 1,
            ],
            [
                'regex' => '/PRZELEW_ZEWN.TRZNY_PRZYCHODZ.CY/',
                'id'    => 2,
            ],
            [
                'regex' => '/PRZELEW WEWN.TRZNY WYCHODZ.CY/',
                'id'    => 3,
            ],
            [
                'regex' => '/PRZELEW W.ASNY/',
                'id'    => 4,
            ],
            [
                'regex' => '/BLIK ZAKUP/',
                'id'    => 5,
            ],
            [
                'regex' => '/PRZELEW MTRANSFER WYCHODZACY/',
                'id'    => 6,
            ],
            [
                'regex' => '/BLIK WYP.ATA ATM KRAJOWY/',
                'id'    => 7,
            ],
            [
                'regex' => '/PRZELEW EKSPRESOWY/',
                'id'    => 8,
            ],
            [
                'regex' => '/OP.ATA-PRZELEW EKSPRESOWY/',
                'id'    => 9,
            ],
            [
                'regex' => '/PRZELEW W.ASNY/',
                'id'    => 10,
            ],
            [
                'regex' => '/ZAKUP PRZY U.YCIU KARTY/',
                'id'    => 11,
            ],
            [
                'regex' => '/WYP.ATA W BANKOMACIE/',
                'id'    => 12,
            ],
            [
                'regex' => '/PROWIZJA-WYP.ATA BANKOMAT KRAJOWY/',
                'id'    => 13,
            ],
            [
                'regex' => '/BLIK ZAKUP E-COMMERCE/',
                'id'    => 14,
            ],
            [
                'regex' => '/PRZELEW SORBNET WYCHODZ.CY/',
                'id'    => 15,
            ],
            [
                'regex' => '/OP.ATA PRZELEW SORBNET WYCHODZ.CY/',
                'id'    => 16,
            ],
        ];

        foreach ($tablica_operacji as $value){
            if (preg_match($value['regex'],$string)) {
                $integerValue = $value['id'];
            }
        }

        return $integerValue;

//        $string = mb_convert_encoding('PRZELEW ZEWN�TRZNY WYCHODZ�CY', 'UTF-8');
//        var_dump($string);
//        $zmienna = preg_match('/PRZELEW ZEWN.TRZNY WYCHODZ.CY/',$string, $matches);
//        print_r($matches);
//        var_dump($zmienna);
//        die();


    }
}
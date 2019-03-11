<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.03.2019
 * Time: 23:57
 */


/****************************************
 * @param string $text   input string
 * @return array of  [
 *                   'account'  => account in YM
 *                    'summa'   => sum of transfer
 *                    'code'    => security code
 *                   ]
 ***************************************/
 function parseAPI(string $text )
 {

     preg_match("/[0-9]{15}/", $text, $res);

     echo $text, PHP_EOL;

     if (isset($res[0])) {
         $acc = $res[0];
     }

     preg_match("/[0-9]+(.+)(?=р)/", $text, $res);

     $sum = 0;
     if (isset($res[0])) {
         $r = str_replace(',', '.', $res[0]);
         $sum = (float)$r;
     }

     preg_match("/[0-9]{4,6}/", $text, $res);

     $code = '';
     if (isset($res[0])) {
         $code = $res[0];
     }

     return [
         'account' => $acc,
         'summa' => $sum,
         'code' => $code,
     ];
 }

//-------------------------------------------
//             example of use
//-------------------------------------------

$text = "Пароль: 181254
Спишется 1001,51 руб
Перевод на счет 410012181094123";
 $res = parseAPI($text);
 print_r($res);


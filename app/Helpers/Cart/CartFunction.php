<?php
namespace App\Helpers\Cart;


class CartFunction
{
    /**
     * Склонение слова после числа.
     *
     * Примеры вызова:
     * num_decline( $num, 'книга,книги,книг' )
     * num_decline( $num, [ 'книга','книги','книг' ] )
     * num_decline( $num, 'книга', 'книги', 'книг' )
     * num_decline( $num, 'книга', 'книг' )
     *
     * @param  int|string    $number  Число после которого будет слово. Можно указать число в HTML тегах.
     * @param  string|array  $titles  Варианты склонения или первое слово для кратного 1.
     * @param  string        $param2  Второе слово, если не указано в параметре $titles.
     * @param  string        $param3  Третье слово, если не указано в параметре $titles.
     *
     * @return string 1 книга, 2 книги, 10 книг.
     *
     * @version 2.0
     */
    public static function num_decline( $number, $titles, $param2 = '', $param3 = '' ){

        if( $param2 )
            $titles = [ $titles, $param2, $param3 ];

        if( is_string($titles) )
            $titles = preg_split( '/, */', $titles );

        if( empty($titles[2]) )
            $titles[2] = $titles[1]; // когда указано 2 элемента

        $cases = [ 2, 0, 1, 1, 1, 2 ];

        $intnum = abs( intval( strip_tags( $number ) ) );

        return "$number ". $titles[ ($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)] ];
    }
}

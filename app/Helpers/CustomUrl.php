<?php 

namespace App\Helpers;


class CustomUrl {
  
    public static function convertAccentedCharacters($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    public static function urlTitle($str, $separator = '-', $lowercase = false)
{
    if ($separator === 'dash') {
        $separator = '-';
    } elseif ($separator === 'underscore') {
        $separator = '_';
    }

    $q_separator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;' => '',
        '[^\w\d _-]' => '',
        '\s+' => $separator,
        '(' . $q_separator . ')+' => $separator,
    );

    $str = strip_tags($str);
    foreach ($trans as $key => $val) {
        $str = preg_replace('#' . $key . '#iu', $val, $str);
    }

    if ($lowercase === true) {
        $str = strtolower($str);
    }

    return trim(trim($str, $separator));
}

}

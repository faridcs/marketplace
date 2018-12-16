<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 2/12/18
 * Time: 2:54 PM
 */

namespace App\Services\Utils;

trait Helper
{

    public static function mb_str_word_count($string, $format = 0, $charlist = '[]') {

        mb_internal_encoding( 'UTF-8');
        mb_regex_encoding( 'UTF-8');

        $words = mb_split('[^\x{0600}-\x{06FF}]', $string);
        switch ($format) {
            case 0:
                return count($words);
                break;
            case 1:
            case 2:
                return $words;
                break;
            default:
                return $words;
                break;
        }
    }

    public static function remove_http($url) {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;
    }
}
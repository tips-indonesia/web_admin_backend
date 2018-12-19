<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DualLanguage extends Model
{
    protected $table = 'dual_language';

    public static function getByKey($key, $lang) {
        if ($lang == '') {
            return '';
        } else {
            $value = self::where('text_key', $key)->first();

            return $value ? $value['text_' . $lang] : '';
        }
    }

    public static function getByKeyWithChange($key, $lang, $var) {
        if ($lang == '') {
            return '';
        } else {
            $value = self::where('text_key', $key)->first();
            if (!$value) return '';
            else {
                $result = $value['text_' . $lang];
                for ($i = 0; $i < count($var); ++$i) {
                    $result = self::changeCertainString($result, $var[$i]);
                }

                return $result;
            }
        }
    }

    public static function changeCertainString($text, $val) {
        return str_replace('%@', $val, $text);
    }
}

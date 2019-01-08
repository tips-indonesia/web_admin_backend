<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorDualLanguage extends Model
{
    protected $table = 'error_dual_language';

    public static function get_message_by_key($lang, $key) {
        $label = $lang == 'en' ? '_en' : '_id';
        
        $message = self::where('text_key', $key)
            ->select('text' . $label . ' as text')
            ->first();

        if (!$message) {
            return '';
        }
        
        return $message->text;
    }
}

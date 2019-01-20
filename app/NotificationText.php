<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationText extends Model
{
    protected $table = 'notification_text';
    protected $primaryKey = 'text_key';
    public $timestamps = false;
    public $incrementing = false;

    public const PUSH_COLUMN = 'text_push';
    public const SMS_COLUMN = 'text_sms';
    public const EMAIL_SUBJECT_COLUMN = 'text_email_subject';
    public const EMAIL_COLUMN = 'text_email';

    public static function getByKey($key, $lang, $type) {
        if ($lang == '') {
            return '';
        } else {
            $value = self::where('text_key', $key)->first();
            $label = $lang == 'en' ? '_en' : '';
            return $value ? $value[$type . $label] : '';
        }
    }

    public static function getByKeyWithChange($key, $lang, $var, $type) {
        if ($lang == '') {
            return '';
        } else {
            $label = $lang == 'en' ? '_en' : '';
            $value = self::where('text_key', $key)->first();
            if (!$value) return '';
            else {
                $result = $value[$type . $label];
                for ($i = 0; $i < count($var); $i++) {
                    $result = str_replace_first('%@', $var[$i], $result);
                }

                return $result;
            }
        }
    }
}

<?php defined('SYSPATH') or die('No direct access allowed.');

class View_Helper {

    public static function format_phone($phone) {
        $phone = preg_replace('/[^\d]/', '', $phone);
        $ln = strlen($phone);
        if ($ln == 0) {
            return null;
        }

        switch ($ln) {
            case 12:
                $phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1 ($2) $3-$4-$5", $phone);
                break;
            case 11:
                $phone = preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1 ($2) $3-$4-$5", $phone);
                break;
            case 10:
                $phone = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $phone);
                break;
            case 7:
                $phone = preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone);
                break;
            case 6:
                $phone = preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone);
                break;
            case 5:
                $phone = preg_replace("/([0-9]{3})([0-9]{2})/", "$1-$2", $phone);
                break;
            case 4:
                $phone = preg_replace("/([0-9]{2})([0-9]{2})/", "$1-$2", $phone);
                break;
        }
        return $phone;
    }
}
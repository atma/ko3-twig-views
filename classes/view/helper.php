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

    public static function thumbnail($file, $params = array()) {
        $defaults = array(
            'width' => 0,
            'height' => 0,
            'quality' => 90,
            'relative' => false
        );
        $def_width = 96;
        $def_height = 96;
        $thumbs_url = 'media/thumbs/';
        $thumbs_path = str_replace('/', DIRECTORY_SEPARATOR, $thumbs_url);

        $params = array_merge($defaults, $params);

        $fileinfo = pathinfo($file);
        $new_width = max(0, (int) $params['width']);
        $new_height = max(0, (int) $params['height']);

        // set default width and height if neither are set already
        if ($new_width === 0 && $new_height === 0) {
            $new_width = $def_width;
            $new_height = $def_height;
        }

        if (strpos($fileinfo['dirname'], DOCROOT) === 0)
        {
            $fileinfo['dirname'] = substr($fileinfo['dirname'], strlen(DOCROOT));
        }
        $file = ltrim($file, '/');
        $file = ltrim($file, '\\');
        if (strpos($fileinfo['dirname'], 'media') === 0)
        {
            $fileinfo['dirname'] = substr($fileinfo['dirname'], strlen('media')+1);
        }

        $filename = $fileinfo['filename'].'_'.$new_width.'_'.$new_height.'_'.$params['quality'].'.'.$fileinfo['extension'];
        $thumbs_dir = DOCROOT.$thumbs_path.(str_replace('/', DIRECTORY_SEPARATOR, $fileinfo['dirname'])).DIRECTORY_SEPARATOR;
        $thumbs_url = $thumbs_url.$fileinfo['dirname'].'/';

        // Check the cached image
        if (file_exists($thumbs_dir.$filename)) {
            return $params['relative']
                ? $thumbs_url.$filename
                : URL::base(true,true).$thumbs_url.$filename;
        }

        // Create new thumbnail
        $filepath = DOCROOT.'media'.DIRECTORY_SEPARATOR.(str_replace('/', DIRECTORY_SEPARATOR, $fileinfo['dirname'])).DIRECTORY_SEPARATOR.$fileinfo['basename'];

        // original file is exist
        if (!file_exists($filepath)) {
            // TODO maybe better return some 1pixel.gif?
            return null;
        }

        // Check the cache dir with subpath
        if (!file_exists($thumbs_dir)) {
            mkdir($thumbs_dir, 0775, true);
        }
        $photo = Image::factory($filepath);
        $photo->resize($new_width, $new_height, Image::AUTO);
        $photo->save($thumbs_dir.$filename, $params['quality']);

        return $params['relative']
            ? $thumbs_url.$filename
            : URL::base(true,true).$thumbs_url.$filename;
    }
}
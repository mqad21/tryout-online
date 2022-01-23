<?php

namespace App\Helpers;

use App\Helpers\Helpers as HelpersHelpers;
use Illuminate\Support\Facades\File;

class Helpers
{


    public static function getPhotoUrl($file)
    {
        $fileContents = file_get_contents($file);
        $filename = uniqid() . "_profile_picture." . HelpersHelpers::getFileExtension($file);
        $filepath = '/profile_picture/' . $filename;
        File::put(public_path() . $filepath, $fileContents);
        return url($filepath);
    }

    public static function getFileExtension($image_path)
    {
        $mimes  = array(
            IMAGETYPE_GIF => "gif",
            IMAGETYPE_JPEG => "jpg",
            IMAGETYPE_PNG => "png",
            IMAGETYPE_SWF => "swf",
            IMAGETYPE_PSD => "psd",
            IMAGETYPE_BMP => "bmp",
            IMAGETYPE_TIFF_II => "tiff",
            IMAGETYPE_TIFF_MM => "tiff",
            IMAGETYPE_JPC => "jpc",
            IMAGETYPE_JP2 => "jp2",
            IMAGETYPE_JPX => "jpx",
            IMAGETYPE_JB2 => "jb2",
            IMAGETYPE_SWC => "swc",
            IMAGETYPE_IFF => "iff",
            IMAGETYPE_WBMP => "wbmp",
            IMAGETYPE_XBM => "xbm",
            IMAGETYPE_ICO => "ico"
        );

        if (($image_type = exif_imagetype($image_path))
            && (array_key_exists($image_type, $mimes))
        ) {
            return $mimes[$image_type];
        } else {
            return FALSE;
        }
    }
}

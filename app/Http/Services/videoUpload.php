<?php

namespace App\Http\Services;

class VideoUpload
{
    public static function uploader($file, $path, $name)
    {
        $path = trim($path, '\/') . "/";
        $name = trim($name, '\/');
        $name = $name . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                die("video : failed to create directory");
            }
        }
        is_writable($path);
        $path = $path . $name;

        if (file_exists($path)) {
            error('file_exists', 'this file already exist');
            return back();
        } else {
            $move = self::moveFile($file, $path);
            if ($move) {
                return $path;
            }
        }
    }

    private static function moveFile($file, $path)
    {
        return move_uploaded_file($file['tmp_name'], $path);
    }
}

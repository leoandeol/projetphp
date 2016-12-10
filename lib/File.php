<?php

class File {

    public static function build_path($path_array) {
        $DS = DIRECTORY_SEPARATOR;
        $ROOT_FOLDER = __DIR__ . $DS . "..";
        return $ROOT_FOLDER . $DS . join($DS, $path_array);
    }

    public static function convertImage($originalImage, $outputImage, $quality) {
        $exploded = explode('.', $originalImage);
        $ext = $exploded[count($exploded) - 1];

        if (preg_match('/jpg|jpeg/i', $ext))
            $imageTmp = imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i', $ext))
            $imageTmp = imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i', $ext))
            $imageTmp = imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i', $ext))
            $imageTmp = imagecreatefrombmp($originalImage);
        else
            return 0;

        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }

}

?>

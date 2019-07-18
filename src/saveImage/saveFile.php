<?php


    function saveImageToPath($path, Imagick $image)
    {

        return $image ->writeImage($path);

    }


    function saveImage($payload)
    {
        $path = $payload[outputKey];
        $image = $payload[imageKey];

        $isWritten = saveImageToPath($path, $image);

        return $isWritten;
    }
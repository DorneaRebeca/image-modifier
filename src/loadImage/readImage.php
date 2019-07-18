<?php

    function generateError($errorType, $msg){
        return [$errorType => $msg];
    }


/**
 * @param $path
 * @return Imagick
 * @throws ImagickException
 */
function readFromFile($path) {

       $image = new Imagick($path);
       return $image;


    }


/**
 * @param $payload
 * @return mixed
 * @throws ImagickException
 */
function readImage($payload) {

        $path = $payload[inputKey];

        $loadedImage =  readFromFile($path);

        $newPayload = $payload;
        $newPayload[imageKey] = $loadedImage;

        return $newPayload;
    }





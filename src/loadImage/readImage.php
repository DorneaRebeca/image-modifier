<?php

    function generateError($errorType, $msg){
        return [$errorType => $msg];
    }


/**
 * @param $path
 * @return Imagick
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 * @throws ImagickException
 */
function readFromFile($path) {

       $image = new Imagick($path);
       return $image;


    }

/**
 * Will read the image from file at path given or at default path
 * @param $payload
 * @return array containing information given and the new image resource
 * @throws ImagickException
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function readImage($payload)
{

    $path = $payload[INPUT_KEY];

    if(preg_match(DEFAULT_PATTERN, $payload[INPUT_KEY])){
        $loadedImage =  readFromFile(DEFAULT_PATH.$path);
    }
    else $loadedImage =  readFromFile($path);

    $newPayload = $payload;
    $newPayload[IMAGE_KEY] = $loadedImage;

    return $newPayload;
    }





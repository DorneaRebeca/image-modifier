<?php

const DEFAULT_PATTERN = '/^(\w+[0-9]*)\.[jpg|jpeg|png]+/';

    function saveImageToPath($path, Imagick $image)
    {
        return $image ->writeImage($path);
    }


/**
 * Saves the image at the given path or in the default path if only the image name is given
 * @param $payload
 * @return bool
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function saveImage($payload)
    {
        $path = $payload[OUTPUT_KEY];
        $image = $payload[IMAGE_KEY];
        if(preg_match(DEFAULT_PATTERN, $payload[OUTPUT_KEY])){
            $isWritten = saveImageToPath(DEFAULT_PATH.$path, $image);
            showSuccess(DEFAULT_PATH.$path);
        }
        else
            {
                $isWritten = saveImageToPath($path, $image);
                showSuccess($path);

            }

        return $isWritten;
    }
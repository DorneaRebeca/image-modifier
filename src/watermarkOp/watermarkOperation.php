<?php


    function canExecuteWatermark($payload) {
        if(!isset($payload[WATERMARK]))
        {
            return false;
        }
        return true;
    }

/**
 * @param Imagick $image
 * @return array containing the position where the watermark will be placed
 * @throws Exception
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function createRandomCorner(Imagick $image, Imagick $watermark) : array
{
        $imgWidth = $image->getImageWidth();
        $imgHeight = $image->getImageHeight();
        $watermarkW = $watermark->getImageWidth();
        $watermarkH = $watermark->getImageHeight();
        $corners = [];
        array_push($corners, [0,0]);
        array_push($corners, [0,$imgHeight - $watermarkH]);
        array_push($corners, [$imgWidth - $watermarkW, 0]);
        array_push($corners, [$imgWidth - $watermarkW, $imgHeight - $watermarkH]);

        $corner = random_int(0,3);
        return $corners[$corner];


    }

    /**
     * @param $payload
     * @throws Exception
     * @return array containing the path where modified image to be saved
     * @author Dornea Rebeca  <rebeca.dornea@evozon.com>
     */
function executeWatermark($payload) : array
    {

        if(!canExecuteWatermark($payload))
            return $payload;

        $watermark = new Imagick($payload[WATERMARK]);
        $watermark->scaleImage($watermark->getImageWidth()/10, $watermark->getImageHeight()/10);

        $randomCorner = createRandomCorner($payload[IMAGE_KEY], $watermark);

        $payload[IMAGE_KEY]->compositeImage($watermark, imagick::COMPOSITE_DEFAULT ,$randomCorner[0], $randomCorner[1]);

        return [ OUTPUT_KEY => $payload[OUTPUT_KEY] ,IMAGE_KEY => $payload[IMAGE_KEY]];
    }


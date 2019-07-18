<?php


    function canExecuteWatermark($payload) {
        if(!isset($payload[watermarkCommand]))
        {
            return false;
        }
        return true;
    }

/**
 * @param Imagick $image
 * @return mixed
 * @throws Exception
 */
function createRandomCorner(Imagick $image, Imagick $watermark) {
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
 */
function executeWatermark($payload)
    {

        if(!canExecuteWatermark($payload))
            return $payload;


        $watermark = new Imagick($payload[watermarkCommand]);
        $watermark->scaleImage($watermark->getImageWidth()/10, $watermark->getImageHeight()/10);

        $randomCorner = createRandomCorner($payload[imageKey], $watermark);

        $payload[imageKey]->compositeImage($watermark, imagick::COMPOSITE_DEFAULT ,$randomCorner[0], $randomCorner[1]);

        return [ outputKey => $payload[outputKey] ,imageKey => $payload[imageKey]];
    }


<?php

    include "./loadImage/readImage.php";
    include "./input/cli.php";
    include "./saveImage/saveFile.php";
    include "./operations/heightOperation.php";
    include "./operations/widthOperation.php";
    include "./operations/ratioOperation.php";
    include "./watermarkOp/watermarkOperation.php";
    include "./errors/error.php";
    include "./output/output.php";
    include "./validations/validations.php";
    include "./helpCommand/help.php";

const WIDTH_COMMAND = '--width';
const HEIGHT_COMMAND = '--height';
const FORMAT_COMMAND = '--format';
const IMAGE_KEY = 'image';
const OUTPUT_KEY = '--output-file';
const INPUT_KEY = '--input-file';
const WATERMARK = '--watermark';
const DEFAULT_PATH = '../savedPhotos/';
const HELP_COMMAND = '--help';





    $payload = createArrayFromInput($argv);
    var_dump($payload);

    if(!executeHelp($payload))
    {
        $payload = validate($payload);
        $payload = readImage($payload);
        $payload = executeWidth($payload);
        $payload = executeHeight($payload);
        $payload = executeFormat($payload);
        $payload = executeWatermark($payload);
        $payload = saveImage($payload);
    }




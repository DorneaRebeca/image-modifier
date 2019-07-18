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

const widthCommand = 'width';
const heightCommand = 'height';
const formatCommand = 'format';
const imageKey = 'image';
const outputKey = 'output-file';
const inputKey = 'input-file';
const watermarkCommand = 'watermark';




//$payload['image'] = readFromFile($argv[1]);
    $payload = createArray($argv);
    $payload = readImage($payload);
    $payload = executeWidth($payload);
    $payload = executeHeight($payload);
    $payload = executeFormat($payload);
    $payload = executeWatermark($payload);
    $payload = saveImage($payload);

   // $saved = saveImageToPath($argv[2], $img);


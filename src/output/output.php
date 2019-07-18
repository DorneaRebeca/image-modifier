<?php


    function showError($errorText)
    {
        print $errorText;
        print PHP_EOL;
        exit(0);
    }


    function showSuccess($savedPath)
    {
        print "The operation you asked was evaluated with success!".PHP_EOL;
        print "You can find your modified image in :".$savedPath.PHP_EOL;
        print "Bye bye!!!".PHP_EOL;
    }

    function showHelp()
    {
        print "The tool support the following arguments: 
            --input-file            -this is a required argument for the tool. Not providing it should fail the execution with a message.".
            " The tool should look for the file provided either in a predefined image folder or support the full path to the file ".PHP_EOL.
            "--output-file           -required argument. Like the input file argument, the tool should be able to create the output file either in".
            "the predefined folder or support the full path of the target file.
            --width - optional parameter. If used, the output image must have the given width while respecting either the original aspect ratio, or the one given in the --format argument".PHP_EOL.
            "--height - optional parameter. If used, the output image must have the given height while respecting either the original aspect ratio, or the one given in the --format argument".PHP_EOL.
            "--format - optional parameter. If used, the output image must have the given aspect ratio.".PHP_EOL.
            "--watermark - optional parameter. If used, the output image must have the given watermark image in a (random) corner".PHP_EOL.
            "--help - optional parameter. If used, a list with all possible arguments must be displayed explaining the usage of each one".PHP_EOL;
    }
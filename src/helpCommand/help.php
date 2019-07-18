<?php


    function executeHelp($payload) : bool
    {
        if(isset($payload[HELP_COMMAND]))
        {
            showHelp();
            return true;
        }
        return false;
    }
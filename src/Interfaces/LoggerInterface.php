<?php

namespace App\Interfaces;
/**
 * medoth for create a folder and a file who will stocked the errors
 * 
 */

interface Loggerable 
{
    public function createLogger(string $folderName, string $message):void;
}

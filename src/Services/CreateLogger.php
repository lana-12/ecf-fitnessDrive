<?php
namespace App\Services;


use App\Interfaces\Loggerable;
/**
 * class for create a folder and a file who will stocked the errors
 * 
 */

final class CreateLogger implements Loggerable
{

    /**
     * medoth for create a folder and a file who will stocked the errors, interface=> DBLoggerable
     * @params the error message
     * @return void
     */
    public function createLogger(string $file, string $message):void
    {
        
        if (!is_dir('Logger/')) {
            mkdir('Logger/'.$file.'/', 0777, true);
        }        
        else{
            echo 'erreur, dossier non créer';
        }
        file_put_contents('logger/'.$file.'/' .date('Y-d-m').'.log', $message. PHP_EOL, FILE_APPEND);
    }

}


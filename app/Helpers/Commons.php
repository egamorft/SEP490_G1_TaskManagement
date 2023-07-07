<?php

namespace App\Helpers;

use Config;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class Commons
{

    public static function uploadFile($request, $nameFile) {
        $file = $request->file($nameFile);
        $file_name = $file->getClientoriginalName();
        $file->move(public_path('uploads'), $file_name);
        return $file;
    }
}

?>
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function index() {
        $fileTypes = [
            [
                'title' => 'JPG',
                'files' => [
                    [
                        'name' => 'File1.jpg',
                        'size' => '5MB',
                        'upload_date' => '2020-01-20',
                        'user_name' => 'File1.jpg',
                    ],
                    ['name' => 'File2.jpeg'],
                    ['name' => 'File3.jpg'],
                    ['name' => 'File4.jpg'],
                    ['name' => 'File5.jpg'],
                ]
            ],
            [
                'title' => 'PNG',
                'files' => [
                    ['name' => 'File1.png'],
                    ['name' => 'File2.png'],
                    ['name' => 'File3.png'],
                    ['name' => 'File4.png'],
                    ['name' => 'File5.png'],
                ]
            ],
        ];
        return view('index', compact('fileTypes'));
    }

    function upload() {

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Upload;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function index() {
        $uploads = Upload::all()
        ;

        $fileTypes = [
            [
                'title' => 'All File Types',
                'files' => $uploads->map(function (Upload $upload) { return $upload->toArray(); })
            ],
        ];
        return view('index', compact('fileTypes'));
    }

    function upload(Request $request) {
        $uploadedFile = $request->file('fileUpload');

        $path = $uploadedFile->store('uploads');

        $upload = new Upload();
        $upload->path = $path;
        $upload->filename = $uploadedFile->getClientOriginalName();
        $upload->size = $uploadedFile->getSize();
        $upload->username = $request->input('user_name');
        $upload->save();

        return redirect('/')->with('success', 'File uploaded successfully!');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Upload;
use App\Utils\UploadUtils;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function index() {
        $uploads = Upload::all()->collect();

        $fileTypes = UploadUtils::groupUploadsByTypes($uploads);

        return view('index', compact('fileTypes'));
    }

    function upload(Request $request) {
        $uploadedFile = $request->file('fileUpload');

        $mimeType = $uploadedFile->getClientMimeType();

        $allowedMimeTypesString = env('ALLOWED_MIME_TYPES');
        $allowedMimeTypes = collect(explode(',', $allowedMimeTypesString))
            ->map(function ($s) { return strtolower(trim($s)); })
            ->filter(function ($s) { return !!$s; });

        if (!$allowedMimeTypes->contains($mimeType)) {
            return redirect('/')->with('error', 'This file type is not allowed to upload. Allowed file types: ' . $allowedMimeTypesString);
        }

        $path = $uploadedFile->store('uploads');

        $upload = new Upload();
        $upload->path = $path;
        $upload->filename = $uploadedFile->getClientOriginalName();
        $upload->size = $uploadedFile->getSize();
        $upload->username = $request->input('user_name');
        $upload->mime_type = $mimeType;
        $upload->save();

        return redirect('/')->with('success', 'File uploaded successfully!');
    }

}

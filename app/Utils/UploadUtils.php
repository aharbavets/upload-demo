<?php


namespace App\Utils;

use Illuminate\Support\Collection;

class UploadUtils {

    public static function groupUploadsByTypes(Collection $uploads) {
        $typeMap = collect();

        foreach ($uploads as $upload) {
            $mimeType = $upload->mime_type;

            if (!$mimeType) {
                continue;
            }

            if ($typeMap->has($mimeType)) {
                $array = $typeMap[$mimeType];
                $array[] = $upload; // add to existing array
                $typeMap[$mimeType] = $array;
            } else {
                $typeMap[$mimeType] = [$upload]; // init with array
            }
        }


        $result = [];
        foreach ($typeMap as $type => $uploads) {
            $result[] = [
                'title' => $type,
                'files' => $uploads,
            ];
        }

        return $result;
    }

}

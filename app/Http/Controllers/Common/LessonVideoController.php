<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonVideoController extends Controller
{
    public function getVideo(Request $request, Lesson $lesson)
    {
        $path = storage_path('app/' . $lesson->video_path);

        if (!\File::exists($path)) {
            abort(404);
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);
        $response->header("Accept-Ranges", "bytes");

        return $response;
    }

    // public function getVideo(Request $request, Lesson $lesson)
    // {
    //     $path = storage_path('app/' . $lesson->video_path);

    //     if (!\File::exists($path)) {
    //         abort(404);
    //     }

    //     $fileSize = \File::size($path);
    //     $mimeType = \File::mimeType($path);

    //     $headers = [
    //         'Content-Type' => $mimeType,
    //         'Content-Length' => $fileSize,
    //         'Accept-Ranges' => 'bytes',
    //     ];

    //     $range = $request->header('Range');

    //     if ($range) {
    //         $range = str_replace('bytes=', '', $range);
    //         $range = explode('-', $range);
    //         $start = intval($range[0]);
    //         $end = isset($range[1]) && is_numeric($range[1]) ? intval($range[1]) : $fileSize - 1;

    //         if ($start > $end || $end >= $fileSize) {
    //             return response('', 416)->header('Content-Range', "bytes */{$fileSize}");
    //         }

    //         $length = $end - $start + 1;
    //         $fileContent = \File::get($path, false, null, $start, $length);

    //         return response($fileContent, 206)
    //             ->header('Content-Type', $mimeType)
    //             ->header('Content-Length', $length)
    //             ->header('Content-Range', "bytes {$start}-{$end}/{$fileSize}")
    //             ->header('Accept-Ranges', 'bytes');
    //     }

    //     $fileContent = \File::get($path);
    //     return response($fileContent, 200)->withHeaders($headers);
    // }

}

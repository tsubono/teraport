<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 画像アップロード
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $dir = $request->get('dir');
        $img = $request->file('img');
        $filename = Carbon::now()->format('YmdHis') . rand(1, 9) . "." . $img->extension();
        $image = \Image::make($img)->setFileInfoFromPath($img);
        $image->orientate()->resize(1200, null,
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        );
        $image->save(storage_path() . "/app/public/{$dir}/{$filename}");
        return response()->json(['status' => 'ok', 'path' => Storage::url("{$dir}/{$filename}")]);
    }
}

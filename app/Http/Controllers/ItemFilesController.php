<?php

namespace App\Http\Controllers;

use App\ItemFile;

class ItemFilesController extends Controller
{
    public function download(ItemFile $file)
    {

        // Z Wistii
        if ($file->host == 1) {
            return response()->make(
                file_get_contents($file->path),
                200, [
                'Content-Type'        => $file->mime,
                'Content-Length'      => $file->size,
                'Content-disposition' => 'attachment; filename="' . $file->name . '"',
            ]);
        }

        if (file_exists(storage_path($file->path))) { // lokalny storage
            return response()->download(storage_path($file->path), $file->name);
        }

        return response()->json([], 404);
    }
}

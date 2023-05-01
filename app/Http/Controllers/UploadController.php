<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{

    //store temporary file
    public function store(Request $request)
    {
        Debugbar::disable();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . "-" . now()->timestamp;
            $file->storeAs('public/temp/' . $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $fileName,
            ]);

            return response($folder);
        } elseif ($request->hasFile('profileImage')) {
            $file = $request->file('profileImage');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . "-" . now()->timestamp;
            $file->storeAs('public/temp/' . $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $fileName,
            ]);

            return response($folder);
        } elseif ($request->hasFile('reviewVideo')) {
            $file = $request->file('reviewVideo');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . "-" . now()->timestamp;
            $file->storeAs('public/temp/' . $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $fileName,
            ]);

            return response($folder);
        }
        return 'unvalidated file recieved';
    }

    //delete temporary file
    public function destroy(Request $request)
    {
        $fileId = request()->getContent();
        $temporaryFile = TemporaryFile::where('folder', $fileId)->first();
        $temporaryFile->delete();
        return Storage::deleteDirectory('public/temp/' . $fileId);
    }
}
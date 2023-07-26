<?php

namespace App\Http\Controllers;

use App\Models\Img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FileUploadContoller extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, ['file' => 'required|file']);

        $file = $request->file('file');
        $filename = Str::random(10).'.'.$file->getClientOriginalExtension();

        try {
            $fullPath = Storage::disk('s3')->putFile('', $request->file('file'), 'public');

        } catch (\Exception $e) {
            Log::error('Failed to upload file to S3', [
                'error' => $e->getMessage(),
                'file' => $filename
            ]);
        
            return response()->json(['message' => 'Failed to upload file'], 500);
        }

        $img = Img::create(['img_path' => $fullPath]);

        if(!$img){
            return response()->json(['message' => 'Failed to create record'], 500);
        }

        return response()->json([
            'message' => 'File uploaded and record created successfully',
            'img_id' => $img->id,
            'img_path' => $img->img_path
        ], 200);
    }
}

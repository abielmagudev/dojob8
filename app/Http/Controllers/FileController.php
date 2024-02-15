<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileDestroyRequest;
use App\Http\Requests\FileSaveRequest;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(FileSaveRequest $request)
    {
        return response()->json(['message' => 'File uploaded successfully.']);

        if( $request->file('file')->isValid() )
        {
            $file = $request->file('file');

            try
            {
                $folder = sprintf('%s/%s', $request->get('folder'), $request->get('fileable_id'));

                $path = $file->storeAs($folder, $file->getClientOriginalName());
                
                
                if( Storage::exists($path) )
                {
                    File::create([
                        'filename' => $file->getClientOriginalName(),
                        'url' => $path,
                        'disk' => sprintf('app/%s', $folder),
                        'fileable_type' => File::getFileableClass( $request->get('folder') ),
                        'fileable_id' => $request->get('fileable_id'),
                    ]);

                    return response()->json(['message' => 'File uploaded successfully.']);
                } 
                else
                {
                    return response()->json(['error' => 'File was not uploaded.'], 500);
                }

            } catch (\Exception $e) {
                return response()->json(['error' => 'Error uploading file: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'Invalid file'], 400);
    }

    public function destroy(FileDestroyRequest $request)
    {
        $request->dd();
    }
}

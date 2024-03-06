<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaAjaxController extends Controller
{
    public function store(Request $request)
    {
        if( $request->file('file')->isValid() )
        {
            $file = $request->file('file');

            try
            {
                $folder = sprintf('%s/%s', $request->get('folder'), $request->get('fileable_id'));

                $path = $file->storeAs($folder, $file->getClientOriginalName());
                
                
                if( Storage::exists($path) )
                {
                    Media::create([
                        'filename' => $file->getClientOriginalName(),
                        'url' => $path,
                        'disk' => sprintf('app/%s', $folder),
                        'fileable_type' => null, // Media::getFileableClass( $request->get('folder') ),
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

    public function destroy()
    {
        
    }
}

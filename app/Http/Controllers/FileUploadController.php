<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileUploadPost(Request $request)
    {
        $name = $request->file->getClientOriginalName();
        $ext = $request->file->extension();
        $originalName = str_replace(".$ext", "", $name);
        $fileuploadRegex = "/[aeiou]/";
        
        $fileNameMatch = preg_match($fileuploadRegex, $originalName);

        if($fileNameMatch) {
            return back()
            ->with('failure',"$name did not pass the regex. You Need to have a filename that matches the.")
            ->with('file',$name);
        }

        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,png|max:4096',
        ]);

        
        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);

    }
}

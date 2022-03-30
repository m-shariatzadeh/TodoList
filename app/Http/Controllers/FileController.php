<?php

namespace App\Http\Controllers;

use App\Jobs\FileUploadJob;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required','max:2048','mimes:jpg,jpeg,png']
        ],[
            'file.required' => 'لطفا فایل خود را انتخاب کنید',
            'file.max' => 'حداکثر اندازه فایل 2 مگ می باشد',
            'file.mimes' => 'نوع فایل باید از فرمت های jpg,jpeg,png باشد'
        ]);

        $file = $request->file('file');
        $file_name = time().$file->getClientOriginalName();
        $file->move('uploads/',$file_name);

        $newFile = new File();
        $newFile->name = $file->getClientOriginalName();
        $newFile->path = 'uploads/'.$file_name;
        $newFile->user_id = auth()->id();
        $newFile->save();

        FileUploadJob::dispatch(auth()->user())->delay(now()->addMinutes(1));

        Session::flash('uploaded','فایل شما با موفقیت آپلود شد');
        return to_route('upload');
    }
}

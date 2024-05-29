<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('file-upload');
    }
    public function prosesFileUpload(Request $request){
        // dump($request->berkas);

        // if (request()->hasFile('berkas')) {
        //     echo "path() :". $request -> berkas -> path()."<br>";
        //     echo "extension() :". $request -> berkas -> extension()."<br>";
        //     echo "getClientOriginalExtention() :". $request -> berkas -> getClientOriginalExtension()."<br>";
        //     echo "getMimeType() :". $request -> berkas -> getMimeType()."<br>";
        //     echo "getClientOriginalName() :".$request -> berkas -> getClientOriginalName()."<br>";
        //     echo "getSize() :".$request -> berkas -> getSize()."<br>";
        // }
        // else{
        //     echo "Tidak ada file yang diupload";
        // }
        // $request->validate([
        //     'berkas' => 'required|file|image|max:500',
        // ]);
        // echo $request->berkas->getClientOriginalName." lolos validasi";

        $request->validate([
            'berkas' => 'required|file|image|max:500',
            'nama' => 'required',
        ]);
        $extfile=$request->berkas->getClientOriginalExtension();
        $namaFile = $request->nama.".".$extfile;


        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace("\\", "/", $path);
        $pathBaru = asset('gambar/'.$namaFile);
        echo "File berhasil diupload di $path";
        echo "<br>";
        echo "Tampilkan Link: <a href='$pathBaru'>$pathBaru</a>";
       
    }
}

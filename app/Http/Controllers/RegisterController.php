<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        // $event = array();
        // foreach (Event::all() as $item) {
        //     $event[$item->id_event] = $item->nama_event;
        // }
        return view('register',[
            'title'=>'Daftar Pendaftar',
            'events'=> Event::all(),
        ]);
        
    }

    public function storePendaftar(Request $request){
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "nama_pendaftar" => 'required',
            'tanggal_lahir' => 'required',
            "email_pendaftar" => 'required|email',
            "id_event" => 'required',
        ],$messages);
                
        Pendaftar::insert([
            "nama_pendaftar" => $request->nama_pendaftar,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email_pendaftar' => $request->email_pendaftar,
            "id_event" => $request->id_event,
        ]);
        return redirect('/hasil');
    }

    public function hasil(){
        return view('hasil',[
            'title'=>'Terima Kasih'
        ]);
    }
}

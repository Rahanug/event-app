<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index(Request $request){
        return view('admins.event',[
            'title'=>'Event',
            'events'=> Event::all(),
            // 'edits'=> $this->edit($request->id_event)
        ]);
    }
    // public function edit($id_event){
    //     $data = [
    //         'id_event' => $id_event,
    //         'nama_event' => $this->request->getPost('namaEvent'),
    //         'tgl_event' => $this->request->getPost('tanggalEvent'),
    //         'informasi_event' => $this->request->getPost('informasiEvent'),
    //     ];
    // }

    public function storeEvent(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "nama_event" => 'required',
            'tanggal_event' => 'required',
            "informasi_event" => 'required',
        ],$messages);
                
        Event::insert([
            "nama_event" => $request->nama_event,
            'tanggal_event' => $request->tanggal_event,
            "informasi_event" => $request->informasi_event,
        ]);
        return redirect('/event')->with('success', 'Event telah ditambahkan');
    }

    public function updateEvent(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "nama_event" => 'required',
            'tanggal_event' => 'required',
            "informasi_event" => 'required',
        ],$messages);
                
        Event::where('id_event', $request->id_event)->update([
            "nama_event" => $request->nama_event,
            'tanggal_event' => $request->tanggal_event,
            "informasi_event" => $request->informasi_event,
        ]);
        return redirect('/event')->with('success', 'Event telah diubah');
    }

    public function deleteEvent($id_event)
    {
        Event::where('id_event', $id_event)->delete();
        return redirect('/event')->with('danger', 'Event telah dihapus');
        
    }
}

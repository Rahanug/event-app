<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $countPendaftar = Pendaftar::all()->count();
        $event = array();
        foreach (Event::all() as $item) {
            $event[$item->id_event] = $item->nama_event;
        }
        return view('admins.dashboard',[
            'title'=>'Dashboard',
            'pendaftars'=>Pendaftar::all(),
            'countPendaftar'=>$countPendaftar,
            'event'=>$event
        ]);
    }
}

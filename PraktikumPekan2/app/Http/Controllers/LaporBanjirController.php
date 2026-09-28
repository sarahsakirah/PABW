<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LaporBanjirController extends Controller {


    public function formlaporbanjir(){
        return view('formlaporbanjir');
    } 

    public function proseslaporbanjir(Request $request){
        $nama_pelapor = $request->input('nama_pelapor');
        $lokasi = $request->input('lokasi');
        $tinggi_genangan = $request->input('tinggi_genangan');
        
        return view('hasillaporbanjir', ['nama_pelapor' => $nama_pelapor, 'lokasi' => $lokasi, 'tinggi_genangan' => $tinggi_genangan]);
    }
        
}

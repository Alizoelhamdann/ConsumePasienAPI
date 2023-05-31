<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil data dari input search
        $search = $request->search;
        // memanggil libraries BaseApi methodnya index dengan mengirim parameter dengan mengirim parameter1 berupa path data dari API nya, parameter2 data untuk mengisi search_nama API nya
        $data = (new BaseApi)->index('/api/pasiens',['search_nama' => $search]);
        // ambil response jsonnya
        $pasiens = $data->json();
        // dd($students);
        // kirim hasil pengambilan data ke blade index
        return view('index')->with(['pasiens'=>$pasiens['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor' => $request->nomor,
            'JK' => $request->JK,
            // 'tanggal_pendaftaran'=>\Carbon\Carbon::parse($request->tanggal_pendaftaran)->format('Y-m-d'), 
        ];
        $proses = (new BaseApi)->store('/api/pasiens/store', $data);
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil Menambahkan data baru ke pasiens API');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // proses ambil data api ke route REST API /pasiens/{id}
        $data = (new BaseApi)->edit('/api/pasiens/'. $id);
        if($data->failed()){
            //kalau gagal proses $data diatas, ambil dekripsi err dari json property data
            $errors = $data->json(['data']);
            // balikin ke halaman awal, sama errors nya
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // kalau berhasil, ambil data dari jsonnya
            $pasien = $data->json(['data']);
            // alihin ke blade edit dengan mengirim data $pasien diatas agar bisa digunakan pada blade
            return view('edit')->with(['pasien' => $pasien]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
          // data yang akan dikirim ($request ke REST APInya)
          $payload = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor' => $request->nomor,
            'JK' => $request->JK,
        ];
        // panggil method update dari BaseApi, kirim endpoint (route update dari REST APInya) dan data ($payload diatas)
        $proses = (new BaseApi)->update('/api/pasiens/'.$id.'/update', $payload);
        if ($proses->failed()) {
            // kalau gagal, balikin lagi sama pesan errors dari json nya
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // berhasil, balikin ke halaman paling awal dengan pesan
            return redirect('/')->with('success', 'Berhasil mengubah data siswa dari API');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $proses = (new BaseApi)->delete('/api/pasiens/'.$id.'/delete');
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil hapus data sementara dari API');
        }
    }

    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/pasiens/trash');
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else{
            $pasiensTrash = $proses->json('data');
            return view('trash')->with(['pasiensTrash'=> $pasiensTrash]);
        }
    }

    public function permanent($id)
    {
        $proses = (new BaseApi)->permanent('/api/pasiens/trash/permanent/' .$id);
        if($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect()->back()->with('success', 'Berhasil menghapus data secara permanen!' );
        }
    }

    public function restore($id)
    {
        $proses = (new BaseApi)->restore('/api/pasiens/trash/show/' .$id);
        // dd($proses);
        if($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect()->back()->with('success', 'Berhasil mengembalikan data dari sampah!');
        }
    }
}

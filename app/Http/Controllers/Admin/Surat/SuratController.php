<?php

namespace App\Http\Controllers\Admin\Surat;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Surat\PermohonanSurat;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permohonanSurat = PermohonanSurat::all();
        return view('admin.permohonan-surat.index', compact('permohonanSurat'));
    }

    public function tinjau(PermohonanSurat $permohonanSurat)
    {
        $penduduk = $permohonanSurat->penduduk;
        return view('admin.permohonan-surat.tinjau', compact('permohonanSurat', 'penduduk'));
    }

    public function verifikasi(PermohonanSurat $permohonanSurat)
    {
        $permohonanSurat->update([
            'status'=>'Menunggu File Surat'
        ]);
        return redirect(route('admin.surat'))->with('success', 'Selesai Meninjau Permohonan Surat');
    }

    public function tolakVerifikasi(PermohonanSurat $permohonanSurat, Request $request)
    {
        $validate = $request->validate([
            'pesan_gagal' => 'required',
        ]);

        $permohonanSurat->update([
            'status' => 'Gagal Terverifikasi',
        ]);

        $permohonanSurat->permohonanSuratAksi()->update([
            'pesan_gagal' => $request->pesan_gagal,
        ]);
        return redirect(route('admin.surat'))->with('success', 'Selesai Meninjau Permohonan Surat');
    }

    public function uploadFile(PermohonanSurat $permohonanSurat)
    {
        $penduduk = $permohonanSurat->penduduk;
        return view('admin.permohonan-surat.upload-file', compact('permohonanSurat', 'penduduk'));
    }
    public function uploadFileStore(PermohonanSurat $permohonanSurat, Request $request)
    {
        $validasi = $request->validate(
            [
                'file' => 'required|mimes:gif,pdf,jpg,jpeg,png|max:5120',
            ],
            [
                'mimes' => 'File harus berformat *jpg,jpeg,png,gif,pdf',
                'max' => 'Ukuran File Maksimal 5 MB',
            ],
        );
        // dd($request->file);
        if ($request->file('file')) {
            $nama_file = Str::uuid() . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file->storeAs('images/layanan-mandiri/permohonan-surat/'.$permohonanSurat->penduduk->NIK, $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $permohonanSurat->permohonanSuratAksi()->update([
                'file_surat' => $url,
            ]);
            $permohonanSurat->update(['status'=>'Selesai']);
        }
        return redirect(route('admin.surat'))->with('success', 'Berhasil Mengirim Surat');
    }
   
}

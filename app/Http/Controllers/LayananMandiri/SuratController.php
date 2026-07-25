<?php

namespace App\Http\Controllers\LayananMandiri;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Komponen\JenisDokumen;
use App\Models\Penduduk\PendudukDokumen;
use App\Models\Surat\JenisSurat;
use App\Models\Surat\PermohonanSurat;
use App\Models\Surat\PermohonanSuratAksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = auth('penduduk_layanan_mandiri')->user()->penduduk;
        $surat = $penduduk->permohonanSurat;
        return view('layanan-mandiri.surat.index', compact('surat', 'penduduk'));
    }

    public function create()
    {
        $jenisSurat = JenisSurat::all();
        return view('layanan-mandiri.surat.create', compact('jenisSurat'));
    }
    public function getSyarat(Request $request)
    {
        $jenisSuratId = $request->input('id_jenis_surat');

        // Ambil data syarat berdasarkan jenis dokumen ID
        $jenisSurat = JenisSurat::find($jenisSuratId);
        $syarat = $jenisSurat->syaratSurat;
        // $syarat = Syarat::where('jenis_dokumen_id', $jenisDokumenId)->get();

        // Kirim data sebagai response JSON
        return response()->json(['syarat' => $syarat]);
    }

    public function getDokumenPenduduk(Request $request)
    {
        $jenisDokumenId = $request->input('id_jenis_dokumen');
        $dokumen = auth('penduduk_layanan_mandiri')
            ->user()
            ->penduduk->dokumen()
            ->where('id_jenis_dokumen', $jenisDokumenId)
            ->get();

        return response()->json(['dokumen' => $dokumen]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'id_jenis_surat' => 'required',
                'keterangan' => 'required',
                'dokumen.*' => 'nullable|exists:penduduk_dokumen,id',
            ],
            [
                'required' => 'Kolom Ini Wajib Diisi',
            ],
        );
        $penduduk = auth('penduduk_layanan_mandiri')->user()->penduduk;
        $permohonanSurat = PermohonanSurat::create([
            'id_penduduk' => $penduduk->id,
            'id_jenis_surat' => $request->id_jenis_surat,
            'keterangan' => $request->keterangan,
        ]);
        if ($request->has('dokumen')) {
            $permohonanSurat->dokumenPenduduk()->attach($request->dokumen);
        }
        PermohonanSuratAksi::create([
            'id_permohonan' => $permohonanSurat->id,
        ]);
        return redirect()
            ->route('layanan-mandiri')
            ->with('success', 'Permohonan surat berhasil disimpan.');
    }

    public function download(PermohonanSurat $surat)
    {
        $file = $surat->permohonanSuratAksi->file_surat;
        // $fileContents = file_get_contents($file);
        // dd($fileContents);
        $pathFile = str_replace(url(''), '', $file);
        $fileName = $surat->penduduk->NIK . ' - ' . $surat->jenisSurat->nama;
        $extension = pathinfo($pathFile, PATHINFO_EXTENSION);
        // dd(public_path($pathFile));
        return response()->download(public_path($pathFile), $fileName . '.' . $extension);
    }

    public function destroy(PermohonanSurat $surat)
    {
        if($surat->permohonanSuratAksi->file_surat){

            $pathFoto = str_replace(url('/storage'), '', $surat->permohonanSuratAksi->file_surat);
            Storage::delete($pathFoto);
        }
        $surat->permohonanSuratAksi()->delete();
        $surat->dokumenPenduduk()->detach();
        $surat->delete();

        return redirect()
            ->route('layanan-mandiri')
            ->with('success', 'Permohonan surat berhasil Dibatalkan.');
    }
}

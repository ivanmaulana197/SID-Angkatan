<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Imports\PendudukImport;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\Penduduk;
use App\Models\Penduduk\Komponen\Agama;
use App\Models\Penduduk\Komponen\GolonganDarah;
use App\Models\Penduduk\Komponen\Kecacatan;
use App\Models\Penduduk\Komponen\Pekerjaan;
use App\Models\Penduduk\Komponen\Pendidikan;
use App\Models\Penduduk\Komponen\PendidikanKK;
use App\Models\Penduduk\Komponen\Penyakit;
use App\Models\Penduduk\Komponen\StatusKawin;
use App\Models\Penduduk\PendudukHubungan;
use App\Models\Penduduk\PendudukKartuKeluarga;
use App\Models\Penduduk\PendudukKondisi;
use App\Models\Penduduk\PendudukUmur;
use App\Models\Surat\PermohonanSurat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = Penduduk::all();
        // $dusun=Dusun::create(['nama'=>'DAOKA']);
        // dd($dusun);
        return view('admin.kependudukan.index', compact('penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hubungan = PendudukHubungan::all();
        $data = self::getDusunRwRt();
        $agama = Agama::all();
        $golongan_darah = GolonganDarah::all();
        $kecacatan = Kecacatan::all();
        $penyakit = Penyakit::all();
        $status_kawin = StatusKawin::all();
        $pendidikan_kk = PendidikanKK::all();
        $sedang_pendidikan = Pendidikan::all();
        $pekerjaan = Pekerjaan::all();
        $kondisi = PendudukKondisi::all();

        // dd($data);
        return view('admin.kependudukan.create', compact('hubungan', 'data', 'agama', 'golongan_darah', 'kecacatan', 'penyakit', 'status_kawin', 'pendidikan_kk', 'sedang_pendidikan', 'pekerjaan', 'kondisi'));
    }

    public function getDusunRwRt()
    {
        $data = [];
        $dusuns = Dusun::all();
        foreach ($dusuns as $dusun) {
            $dusunData = [
                'id' => $dusun->id,
                'nama' => $dusun->nama,
                'kepala' => $dusun->kepalaDusun,
                'rw' => [],
            ];
            foreach ($dusun->rw as $rw) {
                $rwData = [
                    'id' => $rw->id,
                    'nama' => $rw->rw,
                    'ketua' => $rw->ketuaRW,
                    'rt' => [],
                ];
                foreach ($rw->rt as $rt) {
                    $rtData = [
                        'id' => $rt->id,
                        'name' => $rt->rt,
                        'ketua' => $rt->ketuaRT,
                    ];
                    $rwData['rt'][] = $rtData;
                }
                $dusunData['rw'][] = $rwData;
            }
            $data[] = $dusunData;
        }
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->foto);
        $validated = $request->validate(
            [
                'NIK' => 'required|numeric|digits:16|unique:penduduk,NIK',
                'foto' => 'file|image|mimes:jpeg,png,jpg,gif,svg',

                'nama' => 'required',
                'id_kondisi' => 'required',
                'id_hubungan' => 'required',
                'jenisKelamin' => 'required',
                'statusPenduduk' => 'required',
                'id_agama' => 'required',
                'kewarganegaraan' => 'required',
                'id_dusun' => 'required',
                'id_rw' => 'required',
                'id_rt' => 'required',
                'alamat_sebelumnya' => '',
                'alamat_sekarang' => 'required',
                'tempatLahir' => 'required',
                'tanggalLahir' => 'required|date',
                'id_golongan_darah' => 'required',
                // 'id_cacat'=>'required',
                // 'id_penyakit'=>'required',
                'id_status_kawin' => 'required',
                'no_akta_perkawinan' => '',
                'no_akta_perceraian' => '',
                // 'no_akta_kelahiran' => 'required',
                'id_pendidikan_kk' => 'required',
                'id_sedang_pendidikan' => 'required',
                'id_pekerjaan' => 'required',
                'nik_ayah' => 'nullable|numeric',
                'nik_ibu' => 'nullable|numeric',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi',
                'date' => 'Kolom ini harus di isi tanggal',
                'alpha' => 'Kolom ini hanya menerima alphabet',
            ],
        );

        // $id_kk = '';

        // dd($request->tanggalLahir);
        $date = date('Y-m-d', strtotime($request->tanggalLahir));
        // dd($date);
        $usia = Carbon::parse($date)->age;
        $rentangUmur = PendudukUmur::all();
        $id_usia = '';
        foreach ($rentangUmur as $value) {
            if ($usia >= $value->dari && $usia <= $value->sampai) {
                $id_usia = $value->id;
                break;
            }
        }
        if ($request->no_kk) {
            $kk = PendudukKartuKeluarga::where('no_kk', $request->no_kk)->first();
            if ($kk) {
                if ($kk->id_penduduk && $request->id_hubungan == 1) {
                    //cek apakah ada penduduk lain yang hubungannya kepala keluarga
                    return redirect()
                        ->back()
                        ->withErrors(['id_hubungan' => 'Hanya satu kepala keluarga yang diperbolehkan'])
                        ->withInput();
                }
            }
        }
        //dalam kk yg ditulis kepala tidak null dan yg baru hubnya kepala
        // dd(!$kk->id_penduduk);

        $penduduk = Penduduk::create([
            'NIK' => $request->NIK,
            'foto' => asset('img/profile-default.png'),
            'id_kk' => null,
            'nama' => $request->nama,
            'id_kondisi' => $request->id_kondisi,
            'id_hubungan' => $request->id_hubungan,
            'jenisKelamin' => $request->jenisKelamin,
            'statusPenduduk' => $request->statusPenduduk,
            'id_agama' => $request->id_agama,
            'kewarganegaraan' => $request->kewarganegaraan,
            'id_dusun' => $request->id_dusun,
            'id_rw' => $request->id_rw,
            'id_rt' => $request->id_rt,
            'alamat_sebelumnya' => $request->alamat_sebelumnya,
            'alamat_sekarang' => $request->alamat_sekarang,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $date,
            'id_usia' => $id_usia,
            'id_golongan_darah' => $request->id_golongan_darah,
            'id_cacat' => $request->id_cacat,
            'id_penyakit' => $request->id_penyakit,
            'id_status_kawin' => $request->id_status_kawin,
            'no_akta_perkawinan' => $request->no_akta_perkawinan ?? null,
            'no_akta_kelahiran' => $request->no_akta_kelahiran ?? null,
            'no_akta_perceraian' => $request->no_akta_perceraian ?? null,
            'id_pendidikan_kk' => $request->id_pendidikan_kk,
            'id_sedang_pendidikan' => $request->id_sedang_pendidikan,
            'id_pekerjaan' => $request->id_pekerjaan,
            'nik_ayah' => $request->nik_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'created_by' => auth()->user()->id,
        ]);
        if ($request->file('foto')) {
            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/penduduk/' . $penduduk->NIK, $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $penduduk->update(['foto' => $url]);
        }
        if ($request->no_kk) {
            if ($kk) {
                if (!$kk->id_penduduk) {
                    $kk->update([
                        'id_penduduk' => $penduduk->id_hubungan == '1' ? $penduduk->id : null,
                    ]);
                }
                $penduduk->update([
                    'id_kk' => $kk->id,
                ]);
            } else {
                $kk = PendudukKartuKeluarga::create([
                    'no_kk' => $request->no_kk,
                    'id_penduduk' => $penduduk->id_hubungan == '1' ? $penduduk->id : null,
                ]);
            }
        }

        return redirect()
            ->route('admin.kependudukan')
            ->with('success', 'Berhasil menambahkan data penduduk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view('admin.kependudukan.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        $hubungan = PendudukHubungan::all();
        $data = self::getDusunRwRt();
        $agama = Agama::all();
        $golongan_darah = GolonganDarah::all();
        $kecacatan = Kecacatan::all();
        $penyakit = Penyakit::all();
        $status_kawin = StatusKawin::all();
        $pendidikan_kk = PendidikanKK::all();
        $sedang_pendidikan = Pendidikan::all();
        $pekerjaan = Pekerjaan::all();
        $kondisi = PendudukKondisi::all();

        return view('admin.kependudukan.edit', compact('penduduk', 'hubungan', 'data', 'agama', 'golongan_darah', 'kecacatan', 'penyakit', 'status_kawin', 'pendidikan_kk', 'sedang_pendidikan', 'pekerjaan', 'kondisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate(
            [
                'NIK' => 'required|numeric|digits:16|unique:penduduk,NIK,' . $penduduk->id,
                'foto' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
                'nama' => 'required',
                'id_kondisi' => 'required',
                'id_hubungan' => 'required',
                'jenisKelamin' => 'required',
                'statusPenduduk' => 'required',
                'id_agama' => 'required',
                'kewarganegaraan' => 'required',
                'id_dusun' => 'required',
                'id_rw' => 'required',
                'id_rt' => 'required',
                'alamat_sebelumnya' => '',
                'alamat_sekarang' => 'required',
                'tempatLahir' => 'required',
                'tanggalLahir' => 'required|date',
                'id_golongan_darah' => 'required',
                // 'id_cacat'=>'required',
                // 'id_penyakit'=>'required',
                'id_status_kawin' => 'required',
                'no_akta_perkawinan' => '',
                'no_akta_perceraian' => '',
                // 'no_akta_kelahiran' => 'required',
                'id_pendidikan_kk' => 'required',
                'id_sedang_pendidikan' => 'required',
                'id_pekerjaan' => 'required',
                'nik_ayah' => 'nullable|numeric',
                'nik_ibu' => 'nullable|numeric',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi',
                'date' => 'Kolom ini harus di isi tanggal',
                'alpha' => 'Kolom ini hanya menerima alphabet',
            ],
        );
        if ($request->no_kk) {
            $kk = PendudukKartuKeluarga::where('no_kk', $request->no_kk)->first();
            if (!$kk) {
                if ($penduduk->id == $penduduk->no_kk->id_penduduk) {
                    //jika penduduk yg dipilih = ketua
                    //hapus ketua kknya
                    $penduduk->no_kk()->update(['id_penduduk' => null]);
                }
                $kk = PendudukKartuKeluarga::create([
                    'no_kk' => $request->no_kk,
                    'id_penduduk' => $request->id_hubungan == '1' ? $penduduk->id : null,
                ]);
            } else {
                if ($kk->id_penduduk) {
                    if ($request->id_hubungan == 1) {
                        return redirect()
                            ->back()
                            ->withErrors(['id_hubungan' => 'Hanya satu kepala keluarga yang diperbolehkan'])
                            ->withInput();
                    }
                } else {
                    $kk->update([
                        'id_penduduk' => $request->id_hubungan == '1' ? $penduduk->id : null,
                    ]);
                }
            }
            $penduduk->update(['id_kk' => $kk->id]);
        } else {
            if ($penduduk->no_kk) {
                if ($penduduk->id == $penduduk->no_kk->id_penduduk) {
                    //jika penduduk yg dipilih = ketua
                    //hapus ketua kknya
                    $penduduk->no_kk()->update(['id_penduduk' => null]);
                }
            }
            $penduduk->update(['id_kk' => null]);
        }

        $date = date('Y-m-d', strtotime($request->tanggalLahir));
        $usia = Carbon::parse($date)->age;
        $rentangUmur = PendudukUmur::all();
        $id_usia = '';
        foreach ($rentangUmur as $value) {
            if ($usia >= $value->dari && $usia <= $value->sampai) {
                $id_usia = $value->id;
                break;
            }
        }
        $penduduk->update([
            'NIK' => $request->NIK,
            'nama' => $request->nama,
            'id_kondisi' => $request->id_kondisi,
            'id_hubungan' => $request->id_hubungan,
            'jenisKelamin' => $request->jenisKelamin,
            'statusPenduduk' => $request->statusPenduduk,
            'id_agama' => $request->id_agama,
            'kewarganegaraan' => $request->kewarganegaraan,
            'id_dusun' => $request->id_dusun,
            'id_rw' => $request->id_rw,
            'id_rt' => $request->id_rt,
            'id_usia' => $id_usia,
            'alamat_sebelumnya' => $request->alamat_sebelumnya,
            'alamat_sekarang' => $request->alamat_sekarang,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $date,
            'id_golongan_darah' => $request->id_golongan_darah,
            'id_cacat' => $request->id_cacat,
            'id_penyakit' => $request->id_penyakit,
            'id_status_kawin' => $request->id_status_kawin,
            'no_akta_perkawinan' => $request->no_akta_perkawinan ?? null,
            'no_akta_kelahiran' => $request->no_akta_kelahiran ?? null,
            'no_akta_perceraian' => $request->no_akta_perceraian ?? null,
            'id_pendidikan_kk' => $request->id_pendidikan_kk,
            'id_sedang_pendidikan' => $request->id_sedang_pendidikan,
            'id_pekerjaan' => $request->id_pekerjaan,
            'nik_ayah' => $request->nik_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
        ]);
        if ($request->file('foto')) {
            //hapus dulu
            $pathFoto = str_replace(url('/storage'), '', $penduduk->foto);
            Storage::delete($pathFoto);

            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/penduduk/' . $penduduk->NIK, $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $penduduk->update(['foto' => $url]);
        }

        return redirect()
            ->route('admin.kependudukan')
            ->with('success', 'Berhasil Mengupdate Bio Data Penduduk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        // dd($penduduk);
        if ($penduduk->no_kk) {
            if (count($penduduk->no_kk->penduduk) == 1) {
                $penduduk->no_kk()->delete();
            }
        }
        // $pathFoto = str_replace(url('/storage'), '', $penduduk->foto);
        Storage::deleteDirectory('images/penduduk/'.$penduduk->NIK);
        Storage::deleteDirectory('images/layanan-mandiri/permohonan-surat'.$penduduk->NIK);
        
           
        
        // $penduduk->permohonanSurat()->permohonanSuratAksi()->detach();
        $permohonan = $penduduk->permohonanSurat;
        foreach ($permohonan as $key => $value) {
            $value->dokumenPenduduk()->detach();
            // dd($value);
            $value->permohonanSuratAksi()->delete();
            $value->delete();
        }
        
        
        $penduduk->dokumen()->delete();
        dd($permohonan);
        // $idPermohonanSurat = $penduduk->permohonanSurat()->dokumenPenduduk();
        // dd($idPermohonanSurat);
        
        $penduduk->layananMandiri()->delete();
        
        $penduduk->delete();
        return redirect()
            ->route('admin.kependudukan')
            ->with('success', 'Berhasil Menghapus Penduduk');
    }

    function import(Request $request) {
        Excel::import(new PendudukImport, $request->file('file'));
        return back();
    }
}

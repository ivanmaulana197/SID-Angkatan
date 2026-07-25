<?php

namespace App\Http\Controllers\Admin\Lembaga;

use App\Models\Penduduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LembagaDesa\LembagaDesa;
use Illuminate\Support\Facades\Storage;
use App\Models\LembagaDesa\AnggotaLembaga;

class AnggotaLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LembagaDesa $lembaga)
    {
        $id_anggota = $lembaga->anggotaLembaga->pluck('id');
        $penduduk = Penduduk::whereNotIn('id', $id_anggota)->get();

        return view('admin.lembaga.anggota.create', compact('lembaga', 'penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LembagaDesa $lembaga)
    {
        $validate = $request->validate([
            'id_penduduk' => 'required',
            'jabatan' => 'required',
        ]);
        if ($request->jabatan == 'KETUA') {
            $ketuaDulu = $lembaga
                ->anggotaLembaga()
                ->where('jabatan', 'KETUA')
                ->first();
            if ($ketuaDulu) {
                $ketuaDulu->update(['jabatan' => 'ANGGOTA']);
            }
            $anggota = AnggotaLembaga::create([
                'id_lembaga' => $lembaga->id,
                'id_penduduk' => $request->id_penduduk,
                'foto' => asset('img/profile-default.png'),
                'keterangan' => $request->keterangan,
                'jabatan' => 'KETUA',
            ]);
            $lembaga->update(['id_ketua_lembaga' => $request->id_penduduk]);
        } else {
            $anggota = AnggotaLembaga::create([
                'id_lembaga' => $lembaga->id,
                'id_penduduk' => $request->id_penduduk,
                'foto' => asset('img/profile-default.png'),
                'keterangan' => $request->keterangan,
                'jabatan' => $request->jabatan,
            ]);
        }
        if ($request->file('foto')) {
            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/lembaga/anggota', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $anggota->update(['foto' => $url]);
        }
        return redirect()
            ->route('admin.lembaga.show', $lembaga->id)
            ->with('success', 'Berhasil Menambahkan Anggota Lembaga');
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
    public function edit(LembagaDesa $lembaga, AnggotaLembaga $anggota)
    {
        // Ambil daftar ID anggota lembaga
        $id_anggota = $lembaga->anggotaLembaga->pluck('id');

        // Masukkan ID anggota yang sedang diedit
        // ke dalam daftar yang akan dikecualikan

        // Ambil daftar penduduk yang bukan anggota lembaga
        // kecuali anggota yang sedang diedit
        $penduduk = Penduduk::whereNotIn('id', $id_anggota)
            ->orWhere('id', $anggota->anggota->id)
            ->get();
        // dd($penduduk);

        return view('admin.lembaga.anggota.edit', compact('penduduk', 'lembaga', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LembagaDesa $lembaga, AnggotaLembaga $anggota)
    {
        $validate = $request->validate([
            'jabatan' => 'required',
        ]);
        // dd($request->id_penduduk);
        if ($request->jabatan == 'KETUA') {
            $ketuadulu = $lembaga
                ->anggotaLembaga()
                ->where('jabatan', 'KETUA')
                ->first();
            if ($ketuadulu) {
                $ketuadulu->update(['jabatan' => 'ANGGOTA']);
            }
            $lembaga->update(['id_ketua_lembaga' => $request->id_penduduk]);
        }
        $anggota->update(['jabatan' => $request->jabatan]);
        if ($request->file('foto')) {
            $pathlogo = str_replace(url('/storage'), '', $anggota->logo);
            Storage::delete($pathlogo);

            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/lembaga/anggota', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $anggota->update(['foto' => $url]);
        }
        return redirect()
            ->route('admin.lembaga.show', $lembaga->id)
            ->with('success', 'Berhasil Mengedit Anggota Lembaga');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembagaDesa $lembaga, AnggotaLembaga $anggota)
    {
        // dd($anggota);
        $pathlogo = str_replace(url('/storage'), '', $anggota->logo);
        Storage::delete($pathlogo);
        $anggota->delete();
        return redirect()
            ->route('admin.lembaga.show', $lembaga->id)
            ->with('success', 'Berhasil Menghapus Anggota Lembaga');
    }
}

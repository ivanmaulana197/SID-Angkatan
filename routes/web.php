<?php

use App\Http\Controllers\Admin\Agenda\AgendaController;
use App\Http\Controllers\Admin\Berita\BeritaController;
use App\Http\Controllers\Admin\Berita\GambarBeritaController;
use App\Http\Controllers\Admin\Berita\KategoriBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Desa\PemerintahDesaController;
use App\Http\Controllers\Admin\Desa\SejarahDesaController;
use App\Http\Controllers\Admin\Desa\VisiMisiController;
use App\Http\Controllers\Admin\InformasiDesa\GambarInformasiDesaController;
use App\Http\Controllers\Admin\InformasiDesa\InformasiDesaController;
use App\Http\Controllers\Admin\InformasiDesa\KategoriInformasiDesaController;
use App\Http\Controllers\Admin\Lembaga\AnggotaLembagaController;
use App\Http\Controllers\Admin\Lembaga\LembagaController;
use App\Http\Controllers\Admin\Penduduk\DusunController;
use App\Http\Controllers\Admin\Penduduk\KartuKeluargaController;
use App\Http\Controllers\Admin\Penduduk\PendudukController;
use App\Http\Controllers\Admin\Penduduk\RTController;
use App\Http\Controllers\Admin\Penduduk\RWController;
use App\Http\Controllers\Admin\Setting\SettingPermissionController;
use App\Http\Controllers\Admin\Setting\SettingRoleController;
use App\Http\Controllers\Admin\Setting\SettingUserController;
use App\Http\Controllers\Admin\TransparansiAnggaran\AnggaranKeluarController;
use App\Http\Controllers\Admin\TransparansiAnggaran\AnggaranMasukController;
use App\Http\Controllers\Admin\TransparansiAnggaran\TransparansiAnggaranController;
use App\Http\Controllers\Admin\LayananMandiri\LayananMandiriController as AdminLayananMandiriController;
use App\Http\Controllers\Admin\Surat\DokumenPersyaratanSuratController;
use App\Http\Controllers\Admin\Surat\SuratController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthLayananMandiriController;

use App\Http\Controllers\LayananMandiri\SuratController as LayananMandiriSuratController;

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\Penduduk\DokumenController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Setting\SettingDesaController;
use App\Http\Controllers\Admin\Surat\JenisSuratController;
use App\Http\Controllers\Admin\Surat\PermohonanSuratController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Guest\AgendaController as GuestAgendaController;
use App\Http\Controllers\Guest\Berita\BeritaController as GuestBeritaController;
use App\Http\Controllers\Guest\DataDesaController;
use App\Http\Controllers\Guest\InformasiDesaController as GuestInformasiDesaController;
use App\Http\Controllers\Guest\LembagaController as GuestLembagaController;
use App\Http\Controllers\Guest\ProfileDesaController;
use App\Http\Controllers\Guest\SearchController;
use App\Http\Controllers\Guest\SIGController;
use App\Http\Controllers\Guest\TransparansiKeuanganController;
use App\Http\Controllers\LayananMandiri\DokumenLayananMandiriController;
use App\Http\Controllers\LayananMandiri\LayananMandiriController;
use App\Models\Berita\Berita;
use App\Models\Berita\KategoriBerita;
use App\Models\LembagaDesa\AnggotaLembaga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', Home::class)->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visi-misi-desa', [ProfileDesaController::class, 'visiMisi'])->name('visi-misi');
Route::get('/pemerintah-desa', [ProfileDesaController::class, 'pemerintahDesa'])->name('pemerintah-desa');
Route::get('/sejarah-desa', [ProfileDesaController::class, 'sejarahDesa'])->name('sejarah-desa');

Route::prefix('/berita')->group(function () {
    Route::get('/', [GuestBeritaController::class, 'index'])->name('berita');
    Route::get('/{berita}', [GuestBeritaController::class, 'show'])->name('berita.show');
    Route::get('/kategori/{kategoriBerita}', [GuestBeritaController::class, 'kategori'])->name('berita.kategori');
    Route::get('/dibuat-oleh/{user}', [GuestBeritaController::class, 'dibuatOleh'])->name('berita.dibuat-oleh');
});
Route::prefix('/informasi-desa')->group(function () {
    Route::get('/', [GuestInformasiDesaController::class, 'index'])->name('informasi-desa');
    Route::get('/{informasiDesa}', [GuestInformasiDesaController::class, 'show'])->name('informasi-desa.show');
    Route::get('/kategori/{kategoriInformasiDesa}', [GuestInformasiDesaController::class, 'kategori'])->name('informasi-desa.kategori');
    Route::get('/dibuat-oleh/{user}', [GuestInformasiDesaController::class, 'dibuatOleh'])->name('informasi-desa.dibuat-oleh');
});

Route::prefix('/lembaga')->group(function () {
    Route::get('/', [GuestLembagaController::class, 'all'])->name('lembaga');
    Route::get('/{lembaga}', [GuestLembagaController::class, 'show'])->name('lembaga.show');
});

Route::get('data-wilayah-administratif', [DataDesaController::class, 'dataWilayahAdministratif'])->name('data-desa.wilayah-administratif');
Route::get('data-agama', [DataDesaController::class, 'dataAgama'])->name('data-desa.agama');
Route::get('data-jenis-kelamin', [DataDesaController::class, 'dataJenisKelamin'])->name('data-desa.jenisKelamin');
Route::get('data-pendidikan-dalam-kk', [DataDesaController::class, 'dataPendidikanDalamKK'])->name('data-desa.pendidikanKK');
Route::get('data-pendidikan-ditempuh', [DataDesaController::class, 'dataPendidikan'])->name('data-desa.pendidikan');
Route::get('data-pekerjaan', [DataDesaController::class, 'dataPekerjaan'])->name('data-desa.pekerjaan');
Route::get('data-rentang-usia', [DataDesaController::class, 'dataUsia'])->name('data-desa.usia');

Route::get('lokasi-desa', [SIGController::class, 'lokasiDesa'])->name('sig.lokasi-desa');
Route::get('lokasi-kantor-desa', [SIGController::class, 'lokasiKantorDesa'])->name('sig.lokasi-kantor-desa');

Route::get('/transparansi-keuangan',[TransparansiKeuanganController::class,'index'])->name('transparansi-keuangan');

Route::get('/agenda',[GuestAgendaController::class,'index'])->name('agenda');
Route::get('/agenda/{agenda}',[GuestAgendaController::class,'show'])->name('agenda.show');

Route::post('/search', [SearchController::class,'index'])->name('search');

Route::get('/galeri/{galeri}',[GaleriController::class,'show'])->name('galeri.show');
// Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
// Route::get('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/logout', [AuthController::class, 'index'])->name('logout');

Route::middleware('guest:web,penduduk_layanan_mandiri')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

    Route::get('/login-layanan-mandiri', [AuthLayananMandiriController::class, 'login'])->name('layanan-mandiri.login');
    Route::post('/login-layanan-mandiri', [AuthLayananMandiriController::class, 'authenticate'])->name('layanan-mandiri.authenticate');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('logout');

Route::middleware('layanan_mandiri')->group(function () {
    Route::prefix('/layanan-mandiri')->group(function () {
        Route::get('/', [LayananMandiriSuratController::class, 'index'])->name('layanan-mandiri');
        Route::get('/buat-surat', [LayananMandiriSuratController::class, 'create'])->name('layanan-mandiri.surat.create');
        Route::post('/buat-surat', [LayananMandiriSuratController::class, 'store'])->name('layanan-mandiri.surat.store');
        Route::get('/get-syarat', [LayananMandiriSuratController::class, 'getSyarat'])->name('layanan-mandiri.surat.get-syarat');
        Route::post('/{surat}/download', [LayananMandiriSuratController::class, 'download'])->name('layanan-mandiri.surat.download');
        Route::delete('/{surat}', [LayananMandiriSuratController::class, 'destroy'])->name('layanan-mandiri.surat.delete');
        Route::get('/dokumen-penduduk', [LayananMandiriSuratController::class, 'getDokumenPenduduk']);

        Route::prefix('dokumen')->group(function () {
            Route::get('/', [DokumenLayananMandiriController::class, 'index'])->name('layanan-mandiri.dokumen');
            Route::get('/tambah-dokumen', [DokumenLayananMandiriController::class, 'create'])->name('layanan-mandiri.dokumen.create');
            Route::post('/tambah-dokumen', [DokumenLayananMandiriController::class, 'store'])->name('layanan-mandiri.dokumen.store');
            Route::get('/{dokumen}/edit-dokumen', [DokumenLayananMandiriController::class, 'edit'])->name('layanan-mandiri.dokumen.edit');
            Route::put('/{dokumen}/edit-dokumen', [DokumenLayananMandiriController::class, 'update'])->name('layanan-mandiri.dokumen.update');
            Route::delete('/{dokumen}', [DokumenLayananMandiriController::class, 'destroy'])->name('layanan-mandiri.dokumen.delete');
        });

        Route::get('/ganti-pin', [LayananMandiriController::class, 'gantiPIN'])->name('layanan-mandiri.ganti-pin');
        Route::get('/profile', [LayananMandiriController::class, 'profile'])->name('layanan-mandiri.profile');
        Route::post('/ganti-pin', [LayananMandiriController::class, 'updatePIN'])->name('layanan-mandiri.update-pin');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');

        Route::prefix('/kependudukan')->group(function () {
            Route::get('/', [PendudukController::class, 'index'])->name('admin.kependudukan');
            Route::get('/tambah-penduduk', [PendudukController::class, 'create'])->name('admin.kependudukan.create');
            Route::post('/tambah-penduduk', [PendudukController::class, 'store'])->name('admin.kependudukan.store');
            Route::post('import_penduduk',[PendudukController::class,'import'])->name('admin.kependududkan.import');
            Route::get('/{penduduk}', [PendudukController::class, 'show'])->name('admin.kependudukan.show');
            Route::get('/{penduduk}/edit', [PendudukController::class, 'edit'])->name('admin.kependudukan.edit');
            Route::put('/{penduduk}/edit', [PendudukController::class, 'update'])->name('admin.kependudukan.update');
            Route::delete('/{penduduk}', [PendudukController::class, 'destroy'])->name('admin.kependudukan.delete');
            Route::prefix('/{penduduk}/dokumen')->group(function () {
                Route::get('/', [DokumenController::class, 'index'])->name('admin.kependudukan.dokumen');
                Route::get('/tambah-dokumen', [DokumenController::class, 'create'])->name('admin.kependudukan.dokumen.create');
                Route::post('/tambah-dokumen', [DokumenController::class, 'store'])->name('admin.kependudukan.dokumen.store');
                Route::get('/{dokumen}/edit', [DokumenController::class, 'edit'])->name('admin.kependudukan.dokumen.edit');
                Route::put('/{dokumen}/edit', [DokumenController::class, 'update'])->name('admin.kependudukan.dokumen.update');
                Route::delete('/{dokumen}', [DokumenController::class, 'destroy'])->name('admin.kependudukan.dokumen.delete');
            });
        });
        Route::prefix('/keluarga')->group(function () {
            Route::get('/', [KartuKeluargaController::class, 'index'])->name('admin.keluarga');
            Route::get('/tambah-kk', [KartuKeluargaController::class, 'create'])->name('admin.keluarga.create');
            Route::post('/tambah-kk', [KartuKeluargaController::class, 'store'])->name('admin.keluarga.store');
            Route::get('/{kk}', [KartuKeluargaController::class, 'show'])->name('admin.keluarga.show');
            Route::get('/{kk}/edit', [KartuKeluargaController::class, 'edit'])->name('admin.keluarga.edit');
            Route::put('/{kk}/edit', [KartuKeluargaController::class, 'update'])->name('admin.keluarga.update');
            Route::delete('/{kk}', [KartuKeluargaController::class, 'destroy'])->name('admin.keluarga.delete');
            Route::delete('/{kk}/{penduduk}', [KartuKeluargaController::class, 'deletePenduduk'])->name('admin.keluarga.penduduk.delete');
            Route::get('/{kk}/tambah-penduduk', [KartuKeluargaController::class, 'pendudukCreate'])->name('admin.keluarga.penduduk.create');
            Route::post('/{kk}/tambah-penduduk', [KartuKeluargaController::class, 'pendudukStore'])->name('admin.keluarga.penduduk.store');
        });
        Route::prefix('/berita')->group(function () {
            Route::get('/', [BeritaController::class, 'index'])->name('admin.berita');
            Route::prefix('/kategori')->group(function () {
                Route::get('/cek-slug', [KategoriBeritaController::class, 'cekSlug'])->name('cekSlugKategoriBerita');
                Route::get('/add', [KategoriBeritaController::class, 'create'])->name('admin.berita.kategori.create');
                Route::post('/add', [KategoriBeritaController::class, 'store'])->name('admin.berita.kategori.store');
                Route::get('/{kategoriBerita:slug}/edit', [KategoriBeritaController::class, 'edit'])->name('admin.berita.kategori.edit');
                Route::put('/{kategoriBerita:slug}/edit', [KategoriBeritaController::class, 'update'])->name('admin.berita.kategori.update');
                Route::delete('/{kategoriBerita:slug}', [KategoriBeritaController::class, 'destroy'])->name('admin.berita.kategori.delete');
            });

            Route::get('/tambah-berita', [BeritaController::class, 'create'])->name('admin.berita.create');
            Route::post('/tambah-berita', [BeritaController::class, 'store'])->name('admin.berita.store');
            // Route::get('/cek-slug', [BeritaController::class, 'cekSlug'])->name('cekSlugBerita');
            Route::get('/{berita:slug}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
            Route::get('/{berita:slug}', [BeritaController::class, 'show'])->name('admin.berita.show');
            Route::put('/{berita:slug}/edit', [BeritaController::class, 'update'])->name('admin.berita.update');
            Route::delete('/{berita:slug}', [BeritaController::class, 'destroy'])->name('admin.berita.delete');
            Route::prefix('/{berita:slug}/kelola-gambar')->group(function () {
                Route::get('/', [GambarBeritaController::class, 'index'])->name('admin.berita.gambar');
                Route::post('/', [GambarBeritaController::class, 'store'])->name('admin.berita.gambar.store');
                Route::delete('/{id}', [GambarBeritaController::class, 'destroy'])->name('admin.berita.gambar.delete');
            });
        });
        Route::prefix('/informasi-desa')->group(function () {
            Route::get('/', [InformasiDesaController::class, 'index'])->name('admin.informasi-desa');

            Route::prefix('/kategori')->group(function () {
                Route::get('/cek-slug', [KategoriInformasiDesaController::class, 'cekSlug'])->name('cekSlugKategoriInformasiDesa');
                Route::get('/add', [KategoriInformasiDesaController::class, 'create'])->name('admin.informasi-desa.kategori.create');
                Route::post('/add', [KategoriInformasiDesaController::class, 'store'])->name('admin.informasi-desa.kategori.store');
                Route::get('/{kategoriInformasiDesa:slug}/edit', [KategoriInformasiDesaController::class, 'edit'])->name('admin.informasi-desa.kategori.edit');
                Route::put('/{kategoriInformasiDesa:slug}/edit', [KategoriInformasiDesaController::class, 'update'])->name('admin.informasi-desa.kategori.update');
                Route::delete('/{kategoriInformasiDesa:slug}', [KategoriInformasiDesaController::class, 'destroy'])->name('admin.informasi-desa.kategori.delete');
            });

            Route::get('/tambah-informasi-desa', [InformasiDesaController::class, 'create'])->name('admin.informasi-desa.create');
            Route::post('/tambah-informasi-desa', [InformasiDesaController::class, 'store'])->name('admin.informasi-desa.store');
            // Route::get('/cek-slug', [InformasiDesaController::class, 'cekSlug'])->name('cekSlugBerita');
            Route::get('/{informasiDesa:slug}/edit', [InformasiDesaController::class, 'edit'])->name('admin.informasi-desa.edit');
            Route::put('/{informasiDesa:slug}/edit', [InformasiDesaController::class, 'update'])->name('admin.informasi-desa.update');
            Route::delete('/{informasiDesa:slug}', [InformasiDesaController::class, 'destroy'])->name('admin.informasi-desa.delete');
            Route::prefix('/{informasiDesa:slug}/kelola-gambar')->group(function () {
                Route::get('/', [GambarInformasiDesaController::class, 'index'])->name('admin.informasi-desa.gambar');
                Route::post('/', [GambarInformasiDesaController::class, 'store'])->name('admin.informasi-desa.gambar.store');
                Route::delete('/{id}', [GambarInformasiDesaController::class, 'destroy'])->name('admin.informasi-desa.gambar.delete');
            });
        });

        Route::prefix('/wilayah-administratif')->group(function () {
            Route::get('/', [DusunController::class, 'index'])->name('admin.dusun');
            Route::get('/tambah-dusun', [DusunController::class, 'create'])->name('admin.dusun.create');
            Route::post('/tambah-dusun', [DusunController::class, 'store'])->name('admin.dusun.store');
            Route::get('/{dusun:id}/edit-dusun', [DusunController::class, 'edit'])->name('admin.dusun.edit');
            Route::put('/{dusun:id}/edit-dusun', [DusunController::class, 'update'])->name('admin.dusun.update');
            Route::delete('/{dusun:id}', [DusunController::class, 'destroy'])->name('admin.dusun.delete');
            Route::prefix('/{dusun:id}/rw')->group(function () {
                Route::get('/', [RWController::class, 'index'])->name('admin.rw');
                Route::get('/tambah-rw', [RWController::class, 'create'])->name('admin.rw.create');
                Route::post('/tambah-rw', [RWController::class, 'store'])->name('admin.rw.store');
                Route::get('/{rw}/edit', [RWController::class, 'edit'])->name('admin.rw.edit');
                Route::put('/{rw}/edit', [RWController::class, 'update'])->name('admin.rw.update');
                Route::get('/{rw}', [RWController::class, 'show'])->name('admin.rw.show');
                Route::delete('/{rw}', [RWController::class, 'destroy'])->name('admin.rw.delete');

                Route::prefix('/{rw}/rt')->group(function () {
                    Route::get('/', [RTController::class, 'index'])->name('admin.rt');
                    Route::get('/tambah-rt', [RTController::class, 'create'])->name('admin.rt.create');
                    Route::post('/tambah-rt', [RTController::class, 'store'])->name('admin.rt.store');
                    Route::get('/{rt}/edit', [RTController::class, 'edit'])->name('admin.rt.edit');
                    Route::put('/{rt}/edit', [RTController::class, 'update'])->name('admin.rt.update');
                    Route::delete('/{rt}', [RTController::class, 'destroy'])->name('admin.rt.delete');
                });
            });
        });

        Route::prefix('/lembaga')->group(function () {
            Route::get('/', [LembagaController::class, 'index'])->name('admin.lembaga');
            Route::get('/tambah-lembaga', [LembagaController::class, 'create'])->name('admin.lembaga.create');
            Route::post('/tambah-lembaga', [LembagaController::class, 'store'])->name('admin.lembaga.store');
            Route::get('/{lembaga}', [LembagaController::class, 'show'])->name('admin.lembaga.show');
            Route::get('/{lembaga}/edit', [LembagaController::class, 'edit'])->name('admin.lembaga.edit');
            Route::put('/{lembaga}/edit', [LembagaController::class, 'update'])->name('admin.lembaga.update');
            Route::delete('/{lembaga}', [LembagaController::class, 'destroy'])->name('admin.lembaga.delete');
            // Route::delete('/{kk}/{penduduk}', [LembagaController::class,'deletePenduduk'])->name('admin.lembaga.penduduk.delete');
            // Route::get('/{kk}/tambah-penduduk', [LembagaController::class,'pendudukCreate'])->name('admin.lembaga.penduduk.create');
            // Route::post('/{kk}/tambah-penduduk', [LembagaController::class,'pendudukStore'])->name('admin.lembaga.penduduk.store');

            Route::get('/{lembaga}/tambah-anggota', [AnggotaLembagaController::class, 'create'])->name('admin.lembaga.anggota.create');
            Route::post('/{lembaga}/tambah-anggota', [AnggotaLembagaController::class, 'store'])->name('admin.lembaga.anggota.store');
            Route::get('/{lembaga}/anggota/{anggota}/edit', [AnggotaLembagaController::class, 'edit'])->name('admin.lembaga.anggota.edit');
            Route::put('/{lembaga}/anggota/{anggota}/edit', [AnggotaLembagaController::class, 'update'])->name('admin.lembaga.anggota.update');
            Route::delete('/{lembaga}/anggota/{anggota}', [AnggotaLembagaController::class, 'destroy'])->name('admin.lembaga.anggota.delete');
        });

        Route::prefix('pemerintahan-desa')->group(function () {
            Route::get('visi-misi', [VisiMisiController::class, 'index'])->name('admin.visi-misi');
            Route::post('visi-misi', [VisiMisiController::class, 'store'])->name('admin.visi-misi.store');

            Route::get('sejarah-desa', [SejarahDesaController::class, 'index'])->name('admin.sejarah-desa');
            Route::post('sejarah-desa', [SejarahDesaController::class, 'store'])->name('admin.sejarah-desa.store');

            Route::get('pemerintah-desa', [PemerintahDesaController::class, 'index'])->name('admin.pemerintah-desa');
            Route::post('pemerintah-desa', [PemerintahDesaController::class, 'store'])->name('admin.pemerintah-desa.store');
        });

        Route::prefix('/transparansi-anggaran')->group(function () {
            Route::get('/', [TransparansiAnggaranController::class, 'index'])->name('admin.transparansi-anggaran');
            Route::prefix('/anggaran-masuk')->group(function () {
                Route::get('/tambah-anggaran-masuk', [AnggaranMasukController::class, 'create'])->name('admin.transparansi-anggaran.anggaran-masuk.create');
                Route::post('/tambah-anggaran-masuk', [AnggaranMasukController::class, 'store'])->name('admin.transparansi-anggaran.anggaran-masuk.store');
                Route::get('/{anggaran}/edit', [AnggaranMasukController::class, 'edit'])->name('admin.transparansi-anggaran.anggaran-masuk.edit');
                Route::put('/{anggaran}/edit', [AnggaranMasukController::class, 'update'])->name('admin.transparansi-anggaran.anggaran-masuk.update');
                Route::delete('/{anggaran}', [AnggaranMasukController::class, 'destroy'])->name('admin.transparansi-anggaran.anggaran-masuk.delete');
            });
            Route::prefix('/anggaran-keluar')->group(function () {
                Route::get('/tambah-anggaran-keluar', [AnggaranKeluarController::class, 'create'])->name('admin.transparansi-anggaran.anggaran-keluar.create');
                Route::post('/tambah-anggaran-keluar', [AnggaranKeluarController::class, 'store'])->name('admin.transparansi-anggaran.anggaran-keluar.store');
                Route::get('/{anggaran}/edit', [AnggaranKeluarController::class, 'edit'])->name('admin.transparansi-anggaran.anggaran-keluar.edit');
                Route::put('/{anggaran}/edit', [AnggaranKeluarController::class, 'update'])->name('admin.transparansi-anggaran.anggaran-keluar.update');
                Route::delete('/{anggaran}', [AnggaranKeluarController::class, 'destroy'])->name('admin.transparansi-anggaran.anggaran-keluar.delete');
            });
        });

        Route::prefix('/surat')->group(function () {
            Route::get('/', [SuratController::class, 'index'])->name('admin.surat');
            Route::get('/{permohonanSurat}/tinjau', [SuratController::class, 'tinjau'])->name('admin.surat.tinjau');
            Route::get('/{permohonanSurat}/upload-file', [SuratController::class, 'uploadFile'])->name('admin.surat.upload-file');
            Route::post('/{permohonanSurat}/upload-file', [SuratController::class, 'uploadFileStore'])->name('admin.surat.upload-file.store');
            Route::post('/{permohonanSurat}/tinjau/verifikasi', [SuratController::class, 'verifikasi'])->name('admin.surat.verifikasi');
            Route::post('/{permohonanSurat}/tinjau/tolak-verifikasi', [SuratController::class, 'tolakVerifikasi'])->name('admin.surat.tolak-verifikasi');
            Route::prefix('/jenis-surat')->group(function () {
                Route::get('/', [JenisSuratController::class, 'index'])->name('admin.surat.jenis-surat');
                Route::get('/tambah-jenis-surat', [JenisSuratController::class, 'create'])->name('admin.surat.jenis-surat.create');
                Route::post('/tambah-jenis-surat', [JenisSuratController::class, 'store'])->name('admin.surat.jenis-surat.store');
                Route::get('/{jenis}/edit', [JenisSuratController::class, 'edit'])->name('admin.surat.jenis-surat.edit');
                Route::put('/{jenis}/edit', [JenisSuratController::class, 'update'])->name('admin.surat.jenis-surat.update');
                Route::delete('/{jenis}', [JenisSuratController::class, 'destroy'])->name('admin.surat.jenis-surat.delete');
            });
            Route::prefix('/persyaratan-surat')->group(function () {
                Route::get('/', [DokumenPersyaratanSuratController::class, 'index'])->name('admin.surat.persyaratan-surat');
                Route::get('/tambah-dokumen', [DokumenPersyaratanSuratController::class, 'create'])->name('admin.surat.persyaratan-surat.create');
                Route::post('/tambah-dokumen', [DokumenPersyaratanSuratController::class, 'store'])->name('admin.surat.persyaratan-surat.store');
                Route::get('/{jenis}/edit', [DokumenPersyaratanSuratController::class, 'edit'])->name('admin.surat.persyaratan-surat.edit');
                Route::put('/{jenis}/edit', [DokumenPersyaratanSuratController::class, 'update'])->name('admin.surat.persyaratan-surat.update');
                Route::delete('/{jenis}', [DokumenPersyaratanSuratController::class, 'destroy'])->name('admin.surat.persyaratan-surat.delete');
            });
        });
        // Route::prefix('/permohonan-surat')->group(function () {
        //     Route::get('/', [PermohonanSuratController::class, 'index'])->name('admin.surat.permohonan-surat');
        //     Route::get('/tambah-permohonan-surat', [PermohonanSuratController::class, 'create'])->name('admin.surat.permohonan-surat.create');
        //     Route::post('/tambah-permohonan-surat', [PermohonanSuratController::class, 'store'])->name('admin.surat.permohonan-surat.store');
        //     Route::get('/{jenis}/edit', [PermohonanSuratController::class, 'edit'])->name('admin.surat.permohonan-surat.edit');
        //     Route::put('/{jenis}/edit', [PermohonanSuratController::class, 'update'])->name('admin.surat.permohonan-surat.update');
        //     Route::delete('/{jenis}', [PermohonanSuratController::class, 'destroy'])->name('admin.surat.permohonan-surat.delete');
        // });

        Route::prefix('/layanan-mandiri')->group(function () {
            Route::get('/', [AdminLayananMandiriController::class, 'index'])->name('admin.layanan-mandiri');
            Route::get('/tambah-akun', [AdminLayananMandiriController::class, 'create'])->name('admin.layanan-mandiri.create');
            Route::post('/tambah-akun', [AdminLayananMandiriController::class, 'store'])->name('admin.layanan-mandiri.store');
            Route::post('/{penduduk}/ganti-pin', [AdminLayananMandiriController::class, 'gantiPin'])->name('admin.layanan-mandiri.ganti-pin');
            Route::delete('/{penduduk}', [AdminLayananMandiriController::class, 'destroy'])->name('admin.layanan-mandiri.delete');
        });

        Route::prefix('/settings')->group(function () {
            Route::middleware(['role:admin,web'])->group(function () {
                Route::prefix('/users')->group(function () {
                    Route::get('/', [SettingUserController::class, 'index'])->name('admin.setting.user');
                    Route::get('/tambah-user', [SettingUserController::class, 'create'])->name('admin.setting.user.create');
                    Route::post('/tambah-user', [SettingUserController::class, 'store'])->name('admin.setting.user.store');
                    Route::get('/{user}/edit', [SettingUserController::class, 'edit'])->name('admin.setting.user.edit');
                    Route::post('/{user}/new-password', [SettingUserController::class, 'newPassword'])->name('admin.setting.user.newPassword');
                    Route::put('/{user}/edit', [SettingUserController::class, 'update'])->name('admin.setting.user.update');
                    Route::delete('/{user}/delete', [SettingUserController::class, 'destroy'])->name('admin.setting.user.delete');
                });
                Route::prefix('/pengaturan-desa')->group(function () {
                    Route::get('/', [SettingDesaController::class, 'index'])->name('admin.setting.desa');
                    Route::post('/', [SettingDesaController::class, 'store'])->name('admin.setting.desa.store');
                });
            });
        });

        Route::prefix('/agenda')->group(function ()
        {
            Route::get('/',[AgendaController::class,'index'])->name('admin.agenda');
            Route::get('/tambah-agenda',[AgendaController::class,'create'])->name('admin.agenda.create');
            Route::post('/tambah-agenda',[AgendaController::class,'store'])->name('admin.agenda.store');
            Route::get('/{agenda}',[AgendaController::class,'show'])->name('admin.agenda.show');
            Route::get('/{agenda}/edit',[AgendaController::class,'edit'])->name('admin.agenda.edit');
            Route::put('/{agenda}/edit',[AgendaController::class,'update'])->name('admin.agenda.update');
            Route::delete('/{agenda}',[AgendaController::class,'destroy'])->name('admin.agenda.delete');
        });

        Route::prefix('/galeri')->group(function ()
        {
            Route::get('/',[GaleriController::class,'index'])->name('admin.galeri');
            Route::get('/tambah-galeri',[GaleriController::class,'create'])->name('admin.galeri.create');
            Route::post('/tambah-galeri',[GaleriController::class,'store'])->name('admin.galeri.store');
            Route::get('/{galeri}/edit',[GaleriController::class,'edit'])->name('admin.galeri.edit');
            Route::put('/{galeri}/edit',[GaleriController::class,'update'])->name('admin.galeri.update');
            Route::delete('/{galeri}',[GaleriController::class,'destroy'])->name('admin.galeri.delete');
        });

        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('/profile/ubah-password', [ProfileController::class, 'ubahPassword'])->name('admin.profile.ubah-password');
        Route::post('/profile/ubah-password', [ProfileController::class, 'updatePassword'])->name('admin.profile.update-password');
    });
});

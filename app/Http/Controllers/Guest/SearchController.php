<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita\Berita;
use App\Models\InformasiDesa\InformasiDesa;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->search;
        $keywords = explode(' ', $key);
        $beritaQuery = Berita::where('status', 'PUBLISHED');
        $informasiDesaQuery = InformasiDesa::where('status', 'PUBLISHED');
        $agendaDesaQuery = Agenda::query();

        foreach ($keywords as $i=>$keyword) {
            if($i==0){
                $beritaQuery->where(function ($query) use ($keyword) {
                    $query->where('judul', 'like', "%$keyword%")->orWhere('isi_berita', 'like', "%$keyword%");
                });
    
                $informasiDesaQuery->where(function ($query) use ($keyword) {
                    $query->where('judul', 'like', "%$keyword%")->orWhere('isi_informasi_desa', 'like', "%$keyword%");
                });
    
                $agendaDesaQuery->where(function ($query) use ($keyword) {
                    $query->where('nama', 'like', "%$keyword%")->orWhere('keterangan', 'like', "%$keyword%");
                });
            }
            $beritaQuery->orWhere(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")->orWhere('isi_berita', 'like', "%$keyword%");
            });

            $informasiDesaQuery->orWhere(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")->orWhere('isi_informasi_desa', 'like', "%$keyword%");
            });

            $agendaDesaQuery->orWhere(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $berita = $beritaQuery->get();
        $informasiDesa = $informasiDesaQuery->get();
        $agendaDesa = $agendaDesaQuery->get();
        $data = new Collection();
        $data = $data->concat($berita);
        $data = $data->concat($informasiDesa);
        $data = $data->concat($agendaDesa);
        // dd($data);
        $data = $data
            ->sortByDesc(function ($item) use ($key) {
                $titleSimilarity = similar_text(strtolower($item->judul ?? $item->nama), strtolower($key));
                $contentSimilarity = similar_text(strtolower($item->isi_berita ?? ($item->isi_informasi_desa ?? $item->keterangan)), strtolower($key));
                // $descriptionSimilarity = similar_text(strtolower($item->keterangan), strtolower($key));

                // Jumlah kemiripan terbesar akan digunakan untuk urutan
                return max($titleSimilarity, $contentSimilarity);
            })
            ->values();
        // $data = $data->paginate(6);
        $perPage = 10; // Jumlah item per halaman
        $currentPage = request()->get('page', 1); // Ambil nomor halaman dari query string, defaultnya 1 jika tidak ada

        $pagedData = new LengthAwarePaginator($data->forPage($currentPage, $perPage), $data->count(), $perPage, $currentPage);
        $pagedData->withPath('/search?search=' . $key);

        $currentPage = $pagedData->currentPage(); // Nomor halaman saat ini
        $totalItems = $pagedData->total(); // Total item
        $totalPages = $pagedData->lastPage(); // Total halaman
        // dd($pagedData->items());
        return view('guest.search.search', compact('pagedData', 'key'));
    }
}

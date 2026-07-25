<div class="card mb-3">
    <div class="card-body">
        <div id="table-anggaran-masuk" data-list='{"valueNames":["nama","tanggal","jumlah","teralisasi"],"page":5,"pagination":true}'>
            <h3 class="mb-3">Data Anggaran Masuk</h3>
            <div class="row justify-content-between g-0">
                <div class="col-auto col-sm-5 mb-3">
                    <form>
                        <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                            <div class="input-group-text bg-transparent">
                                <span class="fa fa-search fs--1 text-600"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort" data-sort="nama">Nama</th>
                            <th class="sort" data-sort="tanggal">Tanggal</th>
                            <th class="sort" data-sort="jumlah" style="width: 100px">Jumlah Anggaran</th>
                            <th class="sort" data-sort="teralisasi" style="width: 100px">Terealisasi</th>
                            <th data-sort="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($anggaranMasuk as $data)
                            <tr>
                                <td class="nama">{{ $data->nama }}</td>
                                <td class="tanggal">{{ \App\Helpers\DateHelpers::tgl_indo($data->tanggal) ?? '-' }}</td>
                                <td class="jumlah">Rp. {{ number_format($data->total, 0, ',', '.') }}</td>
                                <td class="teralisasi">Rp. {{ number_format(($data->total - $data->sisa), 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#detail-anggaran-masuk-{{ $data->id }}" class="badge badge-subtle-primary" style="border: none">detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Tidak ada data yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
            </div>
        </div>
    </div>
</div>

@include('guest.transparansi-keuangan.modal-anggaran-masuk')

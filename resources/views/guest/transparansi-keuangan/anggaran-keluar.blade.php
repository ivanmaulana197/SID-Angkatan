<div class="card mb-3">
    <div class="card-body">
        <div id="table-anggaran-keluar" data-list='{"valueNames":["nama","sumber","jumlah"],"page":5,"pagination":true}'>
            <h3 class="mb-3">Data Anggaran Keluar</h3>
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
                            <th class="sort" data-sort="nama" style="width: 200px">Nama</th>
                            <th class="sort" data-sort="sumber">Sumber Dana</th>
                            <th class="sort" data-sort="jumlah" style="width: 100px">Jumlah Anggaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($anggaranKeluar as $data)
                            <tr>
                                <td class="nama">{{ $data->nama }}</td>
                                <td class="sumber">
                                    <ul>
                                        @foreach ($data->anggaranMasuk as $anggaran)
                                            <li>{{ $anggaran->nama }} | Rp. {{ number_format($anggaran->pivot->jumlah_anggaran, 0, ',', '.') }}</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td class="jumlah">Rp. {{ number_format($data->total, 0, ',', '.') }}</td>
                                
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#detail-anggaran-keluar-{{ $data->id }}" class="badge badge-subtle-primary" style="border: none">detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Tidak ada data yang tersedia.</td>
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

@include('guest.transparansi-keuangan.modal-anggaran-keluar')

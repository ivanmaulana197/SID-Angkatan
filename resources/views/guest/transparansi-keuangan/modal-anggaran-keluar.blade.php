@foreach ($anggaranKeluar as $data)
    <div class="modal fade" id="detail-anggaran-keluar-{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content position-relative ">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Detail Anggaran Keluar
                    </h5>
                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="p-2 pb-0">

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="table-responsive scrollbar">
                                    <table class="table table-striped overflow-hidden">
                                        <tr>
                                            <td>Nama Anggaran</td>
                                            <td>:</td>
                                            <td><span><strong>{{ $data->nama }}</strong></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Anggaran</td>
                                            <td>:</td>
                                            <td><span><strong>{{ $data->tanggal }}</strong></span></td>
                                        </tr>
                                        <tr>
                                            <td width="300">Jumlah Anggaran</td>
                                            <td width="1">:</td>
                                            <td><span><strong>Rp. {{ number_format($data->total, 0, ',', '.') }}</strong></span></td>
                                        </tr>
                                        <tr>
                                            <td width="300">Keterangan</td>
                                            <td width="1">:</td>
                                            <td>{!! $data->keterangan !!}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div id="tabel-sumber-dana" data-list='{"valueNames":["nama","tanggal","jumlah"],"page":5,"pagination":true}'>
                                    <h3 class="mb-3">Sumber Dana </h3>
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
                                                    <th class="sort" data-sort="nama" style="width: 100px">Nama</th>
                                                    <th class="sort" data-sort="tanggal" style="width: 100px">Tanggal</th>
                                                    <th class="sort" data-sort="jumlah" style="width: 100px">Jumlah Anggaran Teralisasikan</th>
                                                   
                                                    <th style="width: 100px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @forelse ($data->anggaranMasuk as $value)
                                                    <tr>
                                                        <td class="nama">{{ $value->nama }}</td>
                                                        <td class="tanggal">{{ \App\Helpers\DateHelpers::tgl_indo($value->tanggal) ?? '-' }}</td>
                                                        <td class="jumlah">Rp. {{ number_format($value->pivot->jumlah_anggaran, 0, ',', '.') }}</td>                                                        
                                                        <td>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#detail-anggaran-masuk-{{ $value->id }}" class="badge badge-subtle-primary" style="border: none">detail</button>
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

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

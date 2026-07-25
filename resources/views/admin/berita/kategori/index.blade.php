<div class="card mb-3">
    <div class="card-body">
        <div id="tableExample3" data-list='{"valueNames":["nama"],"page":5,"pagination":false}'>
            <h3 class="mb-3">Data Kategori Berita</h3>  
            <div class="row justify-content-between g-0">
                <div class="col-auto col-sm-5">
                    <a href="{{ route('admin.berita.kategori.create') }}" class="btn btn-sm btn-success mb-3">
                        + Tambah
                    </a>
                </div>
                <div class="col-auto col-sm-5 mb-3">
                    <form>
                        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                            <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort" data-sort="nama">Judul</th>
                            <th data-sort="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($kategori as $data)
                            <tr>
                                <td class="nama">{{ $data->nama }}</td>
                                <td>
                                    <a href="{{ route('admin.berita.kategori.edit', $data->slug) }}" class="btn btn-primary btn-sm">edit</a>
                                    
                                    @include('admin.berita.kategori.delete')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="2">Tidak ada data yang tersedia.</td>

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




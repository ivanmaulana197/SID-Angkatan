<button type="button" class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalDeleteAnggaranKeluar{{ $data->id }}"><i class="fa-regular fa-trash-can"></i></button>

<div class="modal fade" id="modalDeleteAnggaranKeluar{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-3">
                <i class="fa-5x fa-solid fa-trash-can mb-3" style="color: #dc3545"></i>
                <h4>Apakah Kamu Yakin Menghapus Anggaran Keluar: <strong>{{ $data->nama }}</strong> ini? </h4>
            </div>

            <div class="my-2 text-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cencel</button>

                <form class="d-inline" action="{{ route('admin.transparansi-anggaran.anggaran-keluar.delete', $data->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
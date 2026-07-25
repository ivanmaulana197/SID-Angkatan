<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteKategori{{ $gambar->id }}">
    <i class="fa-solid fa-trash-can"></i> 
</button>

<div class="modal fade" id="modalDeleteKategori{{ $gambar->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-3">
                <i class="fa-5x fa-solid fa-trash-can mb-3" style="color: #dc3545"></i>
                <h4>Apakah Kamu Yakin <strong>Menghapus</strong> Berita ini? </h4>
            </div>

            <div class="my-2 text-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cencel</button>

                <form class="d-inline" action="{{ route('admin.berita.gambar.delete', [$berita->slug, $gambar]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
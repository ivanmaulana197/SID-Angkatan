<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteKategori{{ $data->id }}">
    <i class="fa-regular fa-trash-can"></i> 
</button>

<div class="modal fade" id="modalDeleteKategori{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-3">
                <i class="fa-5x fa-solid fa-trash-can mb-3" style="color: #dc3545"></i>
                <h4>Are You Sure to Delete this Community?</h4>
            </div>

            <div class="my-2 text-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cencel</button>

                <form class="d-inline" action="{{ route('admin.berita.kategori.delete', $data->slug) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
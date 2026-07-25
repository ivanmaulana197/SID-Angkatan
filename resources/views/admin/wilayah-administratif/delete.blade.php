<button type="button" class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalDeleteDusun{{ $dusun->id }}" {{ $jumlahPenduduk>0? 'disabled':'' }}><i class="fa-regular fa-trash-can"></i> 
</button>


<div class="modal fade" id="modalDeleteDusun{{ $dusun->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-3">
                <i class="fa-5x fa-solid fa-trash-can mb-3" style="color: #dc3545"></i>
                <h4>Apakah anda yakin menghapus Dusun {{ $dusun->nama }}?</h4>
            </div>

            <div class="my-2 text-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cencel</button>

                <form class="d-inline" action="{{ route('admin.dusun.delete', $dusun->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
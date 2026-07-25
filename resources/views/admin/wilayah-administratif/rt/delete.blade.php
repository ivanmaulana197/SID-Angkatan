<button type="button" class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalDeleteRT{{ $rt->id }}" {{ $jumlahPenduduk>0? 'disabled':'' }}><i class="fa-regular fa-trash-can"></i> 
</button>


<div class="modal fade" id="modalDeleteRT{{ $rt->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-3">
                <i class="fa-5x fa-solid fa-trash-can mb-3" style="color: #dc3545"></i>
                <h5>Apakah kamu yakin menghapus <br>RT: {{ $rt->rt }}, RW: {{ $rw->rw }}, Dusun: {{ $dusun->nama }}?</h5>
            </div>
            <div class="my-2 text-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cencel</button>

                <form class="d-inline" action="{{ route('admin.rt.delete', [$dusun->id,$rw->id,$rt->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
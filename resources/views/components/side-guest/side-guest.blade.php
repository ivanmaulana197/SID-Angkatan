<div class="col-lg-4 col-md-12 mb-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-grid mb-3">
                <form action="{{ route('search') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Search.." name="search">
                        <span class="input-group-append">
                            <button class="btn btn-success bg-success border-start-0 border rounded-pill ms-n3" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            {{-- @include('guest.home.components.info') --}}
            @include('components.side-guest.statistik')

        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @include('components.side-guest.arsip-berita')
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @include('components.side-guest.agenda-terbaru')
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @include('components.side-guest.galeri-desa')
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @include('components.side-guest.statistik-pengunjung')
        </div>
    </div>

</div>
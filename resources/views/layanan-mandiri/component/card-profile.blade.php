<div class="card">
    <div class="card-img-top p-2"><img class="img-fluid" src="{{ $penduduk->foto }}" alt="foto-profile" /></div>
    <div class="card-body d-grid">
        <a href="{{ route('layanan-mandiri.profile') }}" class="btn btn-sm btn-primary mb-2">Profile</a>
        <a href="{{ route('layanan-mandiri.ganti-pin') }}" class="btn btn-sm bg-900 text-white mb-2">Ganti PIN</a>
        <form action="{{ route('logout') }}" method="post" class="d-grid">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
        </form>
    </div>
</div>
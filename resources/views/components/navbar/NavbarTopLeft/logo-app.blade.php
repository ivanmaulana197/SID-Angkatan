<div class="navbar-brand me-3 me-sm-3">
    <a href="{{ route('home') }}" class="d-flex align-items-center">
        <img class="me-2" src="{{ $myData['desa']->logo }}" alt="" width="40">
        <div class="d-flex flex-column justify-content-center" style="margin-top: 5px">
            <span class="font-sans-serif text-success" style="font-size: 16px;">Desa {{ $myData['desa']->nama }}</span>
            <p class="text-500 fs--2">Kecamatan {{ $myData['desa']->kecamatan }}</p>
        </div>
    </a>    
</div>
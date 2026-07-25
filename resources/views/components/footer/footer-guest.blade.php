<section class="bg-dark pt-8 pb-4" data-bs-theme="light">
    <div class="container">
        <div class="position-absolute btn-back-to-top bg-dark">
            <a class="text-600" href="#banner" data-bs-offset-top="0"><span class="fas fa-chevron-up" data-fa-transform="rotate-45"></span></a>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h5 class="text-uppercase text-white opacity-85 mb-3">Desa {{ $myData['desa']->nama }}</h5>
                <p class="text-600">    {{ $myData['desa']->alamat }}</p>
                <div class="icon-group mt-4"><a class="icon-item bg-white text-facebook" href="#!"><span class="fab fa-facebook-f"></span></a><a class="icon-item bg-white text-twitter" href="#!"><span class="fab fa-twitter"></span></a><a class="icon-item bg-white text-google-plus" href="#!"><span class="fab fa-google-plus-g"></span></a><a class="icon-item bg-white text-linkedin" href="#!"><span class="fab fa-linkedin-in"></span></a><a class="icon-item bg-white" href="#!"><span class="fab fa-medium-m"></span></a></div>
            </div>
            <div class="col ps-lg-6 ps-xl-8">
                <div class="row mt-5 mt-lg-0">
                    <div class="col-6 col-md-3">
                        <h5 class="text-uppercase text-white opacity-85 mb-3">Kategori Berita</h5>
                        <ul class="list-unstyled">
                            @forelse ($myData['kategori-berita'] as $kategori)
                                <li class="mb-1"><a class="link-600" href="#!">{{ $kategori->nama }}</a></li>
                            @empty
                            <li class="mb-1"><a class="link-600" href="#!">-</a></li>
                            @endforelse

                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <h5 class="text-uppercase text-white opacity-85 mb-3">Kategori Informasi</h5>
                        <ul class="list-unstyled">
                            @forelse ($myData['kategori-informasi-desa'] as $kategori)
                                <li class="mb-1"><a class="link-600" href="#!">{{ $kategori->nama }}</a></li>
                            @empty
                                <li class="mb-1"><a class="link-600" href="#!">-</a></li>
                            @endforelse

                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>

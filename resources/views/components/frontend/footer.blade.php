<footer class="bg-dark position-relative overflow-hidden pb-0 pt-3 pt-lg-8" data-bs-theme="dark">

    @include('partials.figure.figure-three')

    <div class="position-absolute top-0 end-0  me-n4">
        <img src="{{ asset('frontend/images/elements/decoration-pattern-2.svg') }}" style="opacity:0.05;" alt="">
    </div>

    <div class="container position-relative">
        <div class="row g-4 justify-content-between">

            <div class="col-lg-3">
                <a class="me-0" href="index-2.html">
                    <img width="300px" src="{{ asset('frontend/images/logo_indekost.svg') }}" alt="logo">
                </a>

                <p class="mt-4 mb-2">Solusi pencarian kost untuk kalian yang ingin mencari penginapan kost-kosan kec. tamalanrea</p>
            </div>

            <div class="col-lg-8 col-xxl-7">
                <div class="row g-4">
                    <div class="col-6 col-md-4">
                        <h6 class="mb-2 mb-md-4">Links</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link pt-0 active" href="{{ route('landing-page.home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('landing-page.rekomendasi') }}">Rekomendasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('landing-page.cari-kost') }}">Cari Kost</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('landing-page.maps') }}">Maps</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h6 class="mb-2 mb-md-4">Follow on</h6>

                        <ul class="list-inline mb-0 mt-3">
                            <li class="list-inline-item"> <a class="btn btn-xs btn-icon btn-light" href="#"><i class="fab fa-fw fa-facebook-f lh-base"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn btn-xs btn-icon btn-light" href="#"><i class="fab fa-fw fa-instagram lh-base"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn btn-xs btn-icon btn-light" href="#"><i class="fab fa-fw fa-twitter lh-base"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn btn-xs btn-icon btn-light" href="#"><i class="fab fa-fw fa-linkedin-in lh-base"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn btn-xs btn-icon btn-light" href="#"><i class="fab fa-fw fa-youtube lh-base"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4 mb-0">

        <div class="d-md-flex justify-content-between align-items-center text-center text-lg-start py-4">
            <div class="text-body"> Copyrights ©2024 Indekost, Aplikasi Sistem Pencarian Kost Kecamatan Tamalanrea </div>
        </div>
    </div>
</footer>
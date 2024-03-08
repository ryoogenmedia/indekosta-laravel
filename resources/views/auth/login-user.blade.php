<x-layouts.auth-frontend title="Login">
    <div class="row g-0">
        <div class="col-lg-7 vh-100 d-none d-lg-block">
            <div class="swiper h-100" data-swiper-options='{
                "pagination":{
                    "el":".swiper-pagination",
                    "clickable":"true"
                }}'>

                <div class="swiper-wrapper">
                    @foreach ($kost as $item)
                        <div class="swiper-slide">
                            <div class="card rounded-0 h-100" data-bs-theme="dark" style="background-image:url({{ asset('storage/' . $item->image) }}); background-position: center left; background-size: cover;">
                                <div class="bg-overlay bg-dark opacity-5"></div>

                                <div class="card-img-overlay z-index-2 p-7">
                                    <div class="d-flex flex-column justify-content-end h-100">
                                        <h4 class="fw-light">{{ $item->deskripsi }}</h4>
                                        <div class="d-flex justify-content-between mt-5">
                                            <div>
                                                <h5 class="mb-0">{{ $item->nama_kost }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination swiper-pagination-line mb-3"></div>
            </div>
        </div>

        <div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
            <div class="row w-100 m-auto">
                <div class="col-sm-10 my-5 m-auto">
                    <div class="row text-center mb-5">
                        <a href="{{ route('landing-page.home') }}"><img width="350px" src="{{ asset('static/logo_indekost.svg') }}" alt="logo"></a>
                    </div>

                    <h2 class="mb-0">Selamat datang</h2>
                    <p class="mb-0">Selamat datang, silah kan isi data admin</p>

                    <form action="{{ route('login') }}" method="post" class="mt-4" autocomplete="off">
                        @csrf

                        <div class="input-floating-label form-floating mb-4">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
                            <label for="floatingInput">Email address</label>
                            @error('email')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-floating-label form-floating mb-4 position-relative">
                            <input name="password" type="password" class="form-control fakepassword pe-6" id="psw-input" placeholder="Enter your password">
                            <label for="floatingInput">Password</label>
                            <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
                                <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="align-items-center mt-0">
                            <div class="d-grid">
                                <button class="btn btn-dark mb-0" type="submit">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth-frontend>
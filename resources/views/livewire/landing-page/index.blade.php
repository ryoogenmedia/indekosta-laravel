<x-layouts.landing-page>
    <section class="position-relative overflow-hidden pb-0 pt-xl-9 mb-5">
        <div class="position-absolute top-0 start-0 ms-n7 d-none d-xl-block">
          <img src="{{ asset('frontend/images/elements/decoration-pattern.svg') }}" alt="">
        </div>
  
        @include('partials.figure.figure-one')
  
        <div class="container pt-4 pt-sm-5">
          <div class="row g-xl-5">
            <div class="col-xl-7 mb-5 mb-xl-0">
              <div class="pe-xxl-4">
                <span class="heading-color d-inline-block bg-light small rounded-3 px-3 py-2">🤩 Cari kost dengan mudah dengan indekost</span>
  
                <h1 class="mt-3 lh-base">Sistem Pencarian Kost Kec.Tamalanrea
                  <span class="cd-headline clip big-clip is-full-width text-primary mb-0 d-block d-xxl-inline-block">
                    <span class="typed" data-type-text="Indekost&&Cari Kost&&Kost Murah&&Kost Kec Tamalanrea"></span>
                  </span>
                </h1>
                <p class="mb-0 mt-4 mt-md-5">Website ini menyediakan pencarian kost untuk kecamatan tamalanrea, cocok buat kalian yang ingin mencari kost murah dan nyaman!</p>
              </div>
            </div>
  
            <div class="col-md-10 col-xl-5 position-relative mx-auto mt-7 mt-xl-0">
  
                @include('partials.figure.figure-two')
  
              <img src="{{ asset('frontend/images/bg/001.png') }}" class="rounded" alt="hero-img">
  
            </div>
          </div>
        </div>
      </section>
  
      <section class="pt-0 mt-5">
        <div class="container">
  
          <div class="d-lg-flex justify-content-between align-items-center">
            <h4 class="mb-3 mb-lg-0">Kost Teratas</h4>
          </div>
  
          <div class="row g-4 g-sm-5 g-xl-7 mt-0">
            
            @foreach ($this->kosts as $kost)
              <div wire:key="row-{{ $kost->id }}" class="col-md-6 col-lg-4">
                <article class="card bg-transparent h-100 p-0">
                  <div class="badge text-bg-dark position-absolute top-0 start-0 m-3">Diswakan</div>

                  @if ($kost->image)
                    <img style="height: 240px; object-fit: cover" src="{{ asset('storage/'. $kost->image) }}" class="card-img" alt="Blog-img">
                  @else
                    <img src="{{ asset('frontend/images/blog/4by3/03.jpg') }}" class="card-img" alt="Blog-img">
                  @endif

                  <div class="card-body px-2 pb-4">
                    <h5 class="card-title mb-2"><a href="#">{{ $kost->nama_kost }}</a></h5>
                    <h6 class="card-title mb-2"><a href="#">{{ money_format_idr($kost->harga) }}</a></h6>
                    <p class="small mb-2">{{ $kost->alamat }} 📌</p>
                    <p class="small mb-0">{{ $kost->deskripsi }}</p>
                  </div>
                  <div class="card-footer bg-transparent d-flex justify-content-between px-2 py-0">
                    <a class="icon-link icon-link-hover stretched-link" href="{{ route('landing-page.detail-kost', $kost->id) }}">Lihat Kost<i class="bi bi-arrow-right"></i> </a>
                  </div>
                </article>
              </div>
            @endforeach
  
          </div>
  
          <div class="row mt-7">
            <div class="col-12 mx-auto d-flex justify-content-center">
              <a href="{{ route('landing-page.cari-kost') }}" class="btn btn-primary mb-0">Kost Lainnya <i class="bi fa-fw bi-arrow-right ms-2"></i></a>
            </div>
          </div>
  
        </div>
      </section>
</x-layouts.landing-page>
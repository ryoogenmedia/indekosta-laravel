<x-layouts.landing-page>
    <section class="pt-8">
        <div class="container">
            <div class="inner-container text-center">
                <h1 class="mb-0 lh-base position-relative">
                   
                    @include('partials.svg.search')

                    Cari Kost Kamu Sekarang!
                </h1>

                <div class="col-md-7 bg-light border rounded-2 position-relative mx-auto p-2 mt-4 mt-md-5">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control focus-shadow-none bg-light border-0 me-1"  placeholder="Cari Kost Sekarang">
                        <button type="button" class="btn btn-dark rounded-2 mb-0"><i class="bi bi-search me-2"></i>Cari Kost</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container" id="output">
            <div class="row g-4 g-sm-5 g-xl-7 mt-0">
                @foreach ($this->rows as $row)
                    <div wire:key="row-{{ $row->id }}" class="col-md-6 col-lg-4">
                        <article class="card bg-transparent h-100 p-0">
                            <div class="badge text-bg-dark position-absolute top-0 start-0 m-3">Diswakan</div>

                            @if ($row->image)
                                <img style="height: 300px; object-fit: cover" src="{{ asset('storage/' . $row->image) }}" class="card-img" alt="Blog-img">
                            @else
                                <img src="{{ asset('frontend/images/blog/4by3/03.jpg') }}" class="card-img" alt="Blog-img">
                            @endif

                            <div class="card-body px-2 pb-4">
                                <h5 class="card-title mb-2"><a href="#">{{ $row->nama_kost }}</a></h5>
                                <h6 class="card-title mb-2"><a href="#">{{  money_format_idr($row->harga) }}</a></h6>
                                <p class="small mb-2">{{ $row->alamat }} 📌</p>
                                <p class="small mb-0">{{ $row->deskripsi }}</p>
                            </div>
                            <div class="card-footer bg-transparent d-flex justify-content-between px-2 py-0 mt-2">
                                <a class="icon-link icon-link-hover stretched-link" href="{{ route('landing-page.detail-kost', $row->id) }}">Lihat Kost<i class="bi bi-arrow-right"></i> </a>
                            </div>
                        </article>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="row mt-7">
            <div class="col-12 mx-auto d-flex justify-content-center">
                {{ $this->rows->links() }}
            </div>
        </div>
    
    </section>
</x-layouts.landing-page>

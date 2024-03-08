@once
    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <link rel="stylesheet" type="text/css"
        href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
    @endsection
@endonce

<div>
    <section>
        <div class="container">
            <div class="row mt-7">
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div wire:ignore class="panel panel-info panel-dashboard">
                                    <div id="map" style="width:100%;height:380px;">

                                        <div class="row align-items-center" style="margin-left: 95px;">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 ps-md-6">
                    <h1 class="h2 mb-4">{{ $this->namaKost }}</h1>
                    <h5 class="h4">{{ $this->alamat }}📌</h5>

                    @if(!$this->persent)
                        <h6 class="h6 mb-4">{{ money_format_idr($this->harga) }}</h6>
                    @else
                        <h6 class="h6">{{ money_format_idr($this->harga) }}
                            <div class='btn btn-primary ms-3 btn-sm text-sm'>diskon % {{ $this->persent }}</div></h6>
                            <div class='mb-4'>
                                <s>{{ money_format_idr($this->kost->harga) }}</s>
                            </div>
                        </h6>
                    @endif
                  
                    <div class="d-flex gap-2 mb-3">
                        @foreach ($this->category as $item)
                            <button wire:click='discount({{ $item->id }})' class="btn {{ $item->id == $this->categoryId ? 'btn-primary' : 'btn-outline-primary' }}">{{ $item->category }}</button>                          
                        @endforeach

                        @if($this->persent)
                            <button wire:click='backPrice' class="btn btn-outline-primary">Harga Awal</button>
                        @endif
                    </div>

                    <p class="mb-4"></p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <h2 class="h4 mb-5">Rating & review</h2>

            <div class="row sticky">
                <div class="col-lg-5 pe-lg-5 mb-5 mb-lg-0 mt-3">
                    {{-- <div class="border rounded-2 p-4">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="mb-0"></h2>
                                <ul class="list-inline mb-2">

                                  

                                </ul>
                                <p class="mb-2"></p>
                            </div>

                            <div class="col-md-7">
                                <div class="d-flex align-items-center">
                                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                       
                                    </div>
                                    <span class="heading-color">5</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                       
                                    </div>
                                    <span class="heading-color">4</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                    </div>
                                    <span class="heading-color">3</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                       
                                    </div>
                                    <span class="heading-color">2</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                     
                                    </div>
                                    <span class="heading-color">1</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="swiper mt-4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card card-element-hover overflow-hidden">

                                    @if($this->kost->image)                                    
                                        <img style="height: 300px; object-fit:cover" src="{{ asset('storage/' . $this->kost->image) }}" class="rounded-3" alt="gambar-kost">
                                    @endif

                                    <div class="hover-element w-100 h-100">
                                        <i class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div id="output">
                        @forelse ($this->recomendations as $item)
                            <hr>
                            
                            <div class="d-flex">
                                <img class="avatar avatar-md rounded-circle float-start me-3" src="https://gravatar.com/avatar/'{{ md5(strtolower(trim($item->email))) }}?s=1024" alt="avatar">
                               
                                <div>
                                    <div>
                                        <h6 class="m-0">{{ $item->nama }}</h6>
                                        <span class="me-3 small">{{ $item->created_at }}</span>
                                    </div>

                                    <ul class="list-inline">
                                        @for ($i = 0; $i < (int) $item->rating; $i++)

                                            <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>

                                        @endfor
                                    </ul>
    
                                    <p>{{ $item->ulasan }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="border border-secondary pb-3 pt-4 rounded-3"><h6 class="text-center text-muted">Belum Ada Ulasan</h6></div>
                        @endforelse
                    </div>
                    <div class="row my-5">
                        @if ($this->showMore && $this->totalRecomendation > 5)
                            <div class="col-12 mx-auto d-flex justify-content-center">
                                <button wire:click='moreComment' id="load_more" class="btn btn-primary-soft mb-0">Komentar Lainnya</button>
                            </div>
                        @endif
                    </div>

                    <hr>

                    <x-alert/>

                    @auth
                        <div class="card mt-5">
                            <form wire:submit='addComment' method="post" enctype="multipart/form-data">
                                <select wire:model='rating' name="rating" class="form-select mb-3" aria-label="Default select example">
                                    <option selected value="5">★★★★★ (5/5)</option>
                                    <option value="4">★★★★☆ (4/5)</option>
                                    <option value="3">★★★☆☆ (3/5)</option>
                                    <option value="2">★★☆☆☆ (2/5)</option>
                                    <option value="1">★☆☆☆☆ (1/5)</option>
                                </select>
                                <textarea wire:model='comment' class="form-control mb-3" name="comment" id="comment" placeholder="Your review" rows="3"></textarea>
                                <button type="submit" class="btn btn-primary mb-0">Kirim Ulasan <i class="bi fa-fw bi-arrow-right ms-2"></i></button>
                            </form>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

<script>

    var dataRecomendations;

    Livewire.on('data-kost',(items) => {
        const dataKost = items[0];
        
        var latLang = [dataKost['latitude'], dataKost['longitude']];

        var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var map = L.map('map', {
            center: latLang,
            zoom: 13,
            layers: [osm],
            minZoom: 5,
            maxZoom: 18,
        });

        var link = `<table cellpadding="5">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b>${dataKost['nama_kost']}</b></td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><b>${dataKost['alamat']}</b></td>
                </tr>

                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><b>${dataKost['deskripsi']}</b></td>
                </tr>

                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><b>${dataKost['created_at']}</b></td>
                </tr>
            </table>`

        L.marker(latLang).addTo(map)
            .bindPopup(link)
            .openPopup();
    });
 
</script>
@endpush
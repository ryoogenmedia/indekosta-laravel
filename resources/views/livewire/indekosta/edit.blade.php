@once
    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

        <link rel="stylesheet" type="text/css"
            href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

        <style>
            #map {
                height: 400px;
            }
        </style>
    @endsection
@endonce

<div>
    <x-slot name="title">Sunting Indekosta</x-slot>

    <x-slot name="pagePretitle">Menyunting indekosta.</x-slot>

    <x-slot name="pageTitle">Sunting Indekosta</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('indekosta.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="edit" autocomplete="off" enctype="multipart/form-data">
        <div class="card-header">
            Sunting data indekosta
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="namaKost" name="namaKost" label="Nama Kost"
                        placeholder="masukkan nama kost" type="text" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model.lazy="gambar" name="gambar" label="Gambar Kost" type="file" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.textarea wire:model="alamat" name="alamat" label="Alamat Kost"
                        placeholder="masukkan alamat kost" type="text" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.textarea wire:model="deskripsi" name="deskripsi" label="Deskripsi Kost"
                        placeholder="masukkan deskripsi kost" type="text" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="harga" name="harga" label="Harga Kost" placeholder="masukkan harga kost"
                        type="text" />
                </div>
            </div>
        </div>

        <div class="card-body">
            <h4>Tambah Kategori</h4>

            <div class="row">
                <div class="col-2">
                    <x-form.check value='kuliah' wire:model.lazy="kategoriKuliah" name="kategoriKuliah"
                        description="Kategori Kuliah" />
                </div>

                @if ($this->kategoriKuliah)
                    <div class="col-auto">
                        <x-form.input wire:model="persentKuliah" min='0' max='100' name="persentKuliah"
                            type="number" placeholder='0' />
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-2">
                    <x-form.check value='kerja' wire:model.lazy="kategoriKerja" name="kategoriKerja"
                        description="Kategori Kerja" />
                </div>

                @if ($this->kategoriKerja)
                    <div class="col-auto">
                        <x-form.input wire:model="persentKerja" min='0' max='100' name="persentKerja"
                            type="number" placeholder='0' />
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-2">
                    <x-form.check value='pasutri' wire:model.lazy="kategoriPasutri" name="kategoriPasutri"
                        description="Kategori Pasutri" />
                </div>

                @if ($this->kategoriPasutri)
                    <div class="col-auto">
                        <x-form.input wire:model="persentPasutri" min='0' max='100' name="persentPasutri"
                            type="number" placeholder='0' />
                    </div>
                @endif
            </div>
        </div>

        <div wire:ignore class="card-body">
            <div class="row">
                <div class="col-12" id="map"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input readonly wire:model.lazy='longitude' name="longitude" label="Longitude"
                        placeholder="0" type="text" />
                </div>
                <div class="col-12 col-lg-6">
                    <x-form.input readonly wire:model.lazy='latitude' name="latitude" label="Latitude"
                        placeholder="0" type="text" />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="edit" />
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var map = L.map('map', {
            center: [{{ $this->latitude }},
                {{ $this->longitude }}
            ],
            zoom: 13,
            layers: [osm],
            minZoom: 5,
            maxZoom: 15,
        })

        var marker = L.marker([{{ $this->latitude }},
            {{ $this->longitude }}
        ], {
            draggable: true
        }).addTo(map);

        // EVENT CLICK (JIKA DI KLIK)
        map.on('click', function(e) {
            @this.longitude = e.latlng.lng;
            @this.latitude = e.latlng.lat;
            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
        });

        // EVENT DRAG (JIKA DI TARIK)
        marker.on('dragend', function(e) {
            let coordinate = e.target._latlng
            @this.longitude = coordinate.lng;
            @this.latitude = coordinate.lat;
            marker.setLatLng(coordinate);
        });

        // EVENT JIKA DI SEARCH
        var searchControl = new L.esri.Controls.Geosearch().addTo(map);
        var results = new L.LayerGroup().addTo(map)

        searchControl.on('results', function(data) {
            results.clearLayers();

            @this.latitude = data.results[0].latlng['lat'];
            @this.longitude = data.results[0].latlng['lng'];

            marker.setLatLng(data.results[0].latlng, {
                draggable: true
            });
        });
    </script>
@endpush

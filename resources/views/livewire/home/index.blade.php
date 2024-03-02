<div>
    <x-slot name="title">Beranda</x-slot>

    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    <x-slot name="pageTitle">Beranda</x-slot>

    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            @if (auth()->user()->roles == 'admin')
                <div class="card mt-2 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Jumlah Pengguna</div>

                            <div class="ms-auto lh-1">
                                <span class="badge bg-blue-lt">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlPengguna }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Jumlah Rekomendasi</div>

                            <div class="ms-auto lh-1">
                                <span class="badge bg-blue-lt">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlRekomendasi }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Jumlah Kosta</div>

                            <div class="ms-auto lh-1">
                                <span class="badge bg-blue-lt">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlKost }}</div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="col-12 col-md-8 col-lg-9 d-flex">
            @if (auth()->user()->roles == 'admin')
                <div class="card h-100 mt-2 w-100" wire:ignore>
                    <div class="card-body">
                        <h3 class="card-title">Data kost dan rekomendasi dalam 10 hari terakhir</h3>

                        <div data-kost="{{ json_encode($kost['data']) }}"
                            data-rekomendasi="{{ json_encode($rekomendasi['data']) }}"
                            date="{{ json_encode($kost['date']) }}" id="chart-mentions" class="chart-lg">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const item = document.getElementById('chart-mentions');
        window.ApexCharts && (new ApexCharts(item, {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 380,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
                stacked: true,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Keterampilan Akademik",
                data: JSON.parse(item.getAttribute('data-kost'))
            }, {
                name: "Keterampilan Non Akademik",
                data: JSON.parse(item.getAttribute('data-rekomendasi'))
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: JSON.parse(item.getAttribute('date')),
            colors: ["#1d4ed8", "#4ade80"],
            legend: {
                show: false,
            },
        })).render();
    </script>
@endpush

<div>
    <x-slot name="title">Pengguna</x-slot>

    <x-slot name="pageTitle">Pengguna</x-slot>

    <x-slot name="pagePretitle">Daftar Pengguna</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Pengguna" :route="route('user.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div>
                <x-datatable.search placeholder="Cari pengguna..." />
            </div>
        </div>

        <div class="col-auto ms-auto d-flex">
            <x-datatable.items-per-page />

            <x-datatable.bulk.dropdown>
                <div class="dropdown-menu dropdown-menu-end">
                    <button data-bs-toggle="modal" data-bs-target="#delete-confirmation" class="dropdown-item"
                        type="button">
                        <i class="las la-trash me-3"></i>

                        <span>Hapus</span>
                    </button>
                </div>
            </x-datatable.bulk.dropdown>
        </div>
    </div>

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <div class="table-responsive mb-0">
            <table class="table card-table table-bordered datatable">
                <thead>
                    <tr>
                        <th class="w-1">
                            <x-datatable.bulk.check wire:model.lazy="selectPage" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Akun" wire:click="sortBy('username')" :direction="$sorts['username'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Email" wire:click="sortBy('email')" :direction="$sorts['email'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Peran Akun" wire:click="sortBy('roles')" :direction="$sorts['roles'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Status" wire:click="sortBy('email_verified_at')"
                                :direction="$sorts['email_verified_at'] ?? null" />
                        </th>

                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($selectPage)
                        <tr>
                            <td colspan="10" class="bg-azure-lt">
                                @if (!$selectAll)
                                    <div class="text-blue">
                                        <span>Anda telah memilih <strong>{{ $this->rows->total() }}</strong> pengguna,
                                            apakah
                                            Anda mau memilih semua <strong>{{ $this->rows->total() }}</strong>
                                            pengguna?</span>

                                        <button wire:click="selectedAll" class="btn ms-2">Pilih Semua</button>
                                    </div>
                                @else
                                    <span class="text-pink">Anda sekarang memilih semua
                                        <strong>{{ count($this->selected) }}</strong> pengguna.
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endif

                    @forelse ($this->rows as $row)
                        <tr wire:key="row-{{ $row->id }}">
                            <td>
                                <x-datatable.bulk.check wire:model.lazy="selected" value="{{ $row->id }}" />
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm"
                                        style="background-image: url({{ $row->avatarUrl() }})"></span>

                                    <span class="ms-2">{{ $row->username }}</span>
                                </div>
                            </td>

                            <td>{{ $row->email ?? '-' }}</td>

                            <td>
                                <span class="badge bg-{{ $row->roles == 'admin' ? 'green' : 'blue' }}-lt">
                                    {{ $row->roles }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-{{ $row->email_verified_at ? 'lime' : 'red' }}-lt">
                                    {{ $row->email_verified_at ? 'aktif' : 'nonaktif' }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div class="ms-auto">
                                        <a class="btn btn-sm" href="{{ route('user.edit', $row->id) }}">
                                            Sunting
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-datatable.empty colspan="10" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex mt-3 justify-content-end mx-3">
            {{ $this->rows->links() }}
        </div>
    </div>
</div>

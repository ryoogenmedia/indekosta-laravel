<div>
    <x-slot name="title">Tambah Pengguna</x-slot>

    <x-slot name="pagePretitle">Menambah pengguna aplikasi.</x-slot>

    <x-slot name="pageTitle">Tambah Pengguna</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('user.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Tambah data pengguna
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="username" name="username" label="Username" placeholder="masukkan username"
                        type="text" />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="email" name="email" label="Masukkan Email" placeholder="masukkan email"
                        type="text" />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="password" name="password" label="Password" placeholder="**********"
                        type="password" />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="avatar" name="avatar" label="Avatar" placeholder="masukkan avatar"
                        type="file" />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="save" />
            </div>
        </div>
    </form>
</div>

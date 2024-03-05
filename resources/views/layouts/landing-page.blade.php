@extends('layouts.base-frontend')

@section('content')
<div>
    <x-frontend.header/>
    <main>
        {{ $slot }}
    </main>
    <x-frontend.footer/>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Kegiatan Baru</h2>
    <form action="{{ route('activities.store') }}" method="POST">
        @include('activities._form')
    </form>
</div>
@endsection
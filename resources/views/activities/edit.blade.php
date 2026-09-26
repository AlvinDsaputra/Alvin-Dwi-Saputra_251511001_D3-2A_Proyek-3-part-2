@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Kegiatan</h2>
    <form action="{{ route('activities.update', $activity->id) }}" method="POST">
        @method('PUT')
        @include('activities._form', ['activity' => $activity])
    </form>
</div>
@endsection
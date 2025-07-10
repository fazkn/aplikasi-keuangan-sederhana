@extends('layout')

@section('content')
<h4 class="mb-4">Edit Kategori</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @include('kategori._form', ['isEdit' => true])
    <div class="d-flex justify-content-between">
        <button class="btn btn-success">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>
</form>
@endsection

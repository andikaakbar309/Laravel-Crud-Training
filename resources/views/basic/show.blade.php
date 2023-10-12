@extends('layouts.admin')

@section('main-content')
    <div class="card">
        <div class="card-body">
            <h5>Seq :{{ $data->seq }}</h5>
            <hr>
            <p>Name: {{ $data->name }}</p>
            <hr>
            <p>Description: {{ $data->description }}</p>
            <hr>
            <p>Created At: {{ $data->created_at }}</p>
            <hr>
            <p>Updated At: {{ $data->updated_at }}</p>
            <hr>
            <p>Status: <span class="badge rounded-pill {{ $data->status == 'Active' ? 'bg-primary' : 'bg-danger' }}">{{ $data->status }}</span></p>
            <hr>
        </div>
    </div>
    <a href="/basic" class="btn btn-secondary btn-sm mt-3">Back</a>
@endsection

       
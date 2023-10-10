@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Category') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('basic.create') }}" class="btn btn-primary btn-sm mb-3">Add Data</a>
<form action="{{ route('export-pdf') }}" class="mb-3 float-end" target="__blank" method="POST">
    @csrf
    <button class="btn btn-danger btn-sm mx-1">Export PDF</button>
</form>
<form action="{{ route('export-excel') }}" class="mb-3 float-end" method="post">
@csrf
<button class="btn btn-success btn-sm mx-1">Export Excel</button>
</form>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped mb-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Seq</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->seq }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td><span class="badge rounded-pill {{ $item->status == 'Active' ? 'bg-primary' : 'bg-danger' }}">{{ $item->status }}</span></td>
                <td>
                    <a href="{{ route('basic.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                    <form onsubmit="return confirm('Sure Inactive Data?')" class="d-inline" action="{{ route('basic.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                <a href="{{ url('/basic/'.$item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush

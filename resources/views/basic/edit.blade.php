@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('basic.update' , $data->id) }}">
                @csrf
                @method('PUT')
                    <div class="mb-3">
                    <h3>ID :{{ $data->id }}</h3>
                    </div>
                    <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
                          </div>
                          <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" name="description">{{ $data->description }}</textarea>
                              </div>
                              <div class="mb-3">
                                    <label for="seq">Seq</label>
                              <input type="text" class="form-control" name="seq" id="seq" value="{{ $data->seq }}">
                              </div>
                              <div class="mb-3">
                                          @if ($data->status === 'Inactive')
                                                <label for="status">Status</label>
                                                <select name="status" id="status">
                                                       <option value="Active" {{ $data->status === 'Active' ? 'selected' : '' }}>Active</option>      
                                                </select>  
                                                @else
                                          <label for="status" class="badge rounded-pill {{ $data->status === 'Active' ? 'bg-primary' : 'bg-danger' }}">Active</label>                                
                                          @endif
                                    </div>
                              <div class="mb-3">
                                    <a href="/basic" class="btn btn-secondary btn-sm">Back</a>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                              </div>
                  </form>
        </div>
    </div>

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

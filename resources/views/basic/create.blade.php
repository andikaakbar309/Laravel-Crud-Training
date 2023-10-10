@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
        <form method="POST" action="{{ route('basic.store') }}">
                @csrf
                    <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama">
                          </div>
                          <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" name="description" placeholder="Deskripsi"></textarea>
                              </div>
                              <div class="mb-3">
                                <label for="seq" class="form-label">SEQ</label>
                              <input type="text" class="form-control" name="seq" id="seq" placeholder="Sequence">
                              </div>
                              <div class="mb-3">
                                    <a href="/categories" class="btn btn-secondary btn-sm">Back</a>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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

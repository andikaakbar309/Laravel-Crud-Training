@extends('layouts.admin')

@section('main-content')
<div class="container mt-3">
        <div class="card">
            <form action="{{ url('/api') }}" method="get">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h6>Nama Anda</h6>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Kirim Dari</h6>
                                <select name="province_from" class="form-select">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach($provinsi as $result)
                                        <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="origin" class="form-select">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Kirim Ke</h6>
                                <select name="province_to" class="form-select">
                                    <option value="" holder>Pilih Provinsi</option>
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach($provinsi as $result)
                                        <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="destination" class="form-select">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Berat Paket</h6>
                                <input type="text" class="form-control" name="weight">
                                <small>dalam gram contoh = 1700/1,7g</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Pilih Kurir</h6>
                                <select name="courier" class="form-select">
                                    <option value="" holder>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group d-grid">
                                <button type="submit" class="btn btn-primary">Hitung Ongkir</button>
                            </div>
                        </div>
                    </div>
            </form>
            @if($cekongkir)
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered table-hovered mt-3" width="100%">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Estimasi</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cekongkir as $result)
                                    <tr>
                                        <td>{{ $result['service'] }}</td>
                                        <td>{{ $result['description'] }}</td>
                                        <td>{{ $result['cost'][0]['value'] }}
                                        </td>
                                        <td>{{ $result['cost'][0]['etd'] }}
                                        </td>
                                        <td>{{ $result['cost'][0]['note'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else

            @endif
        </div>
    </div>
    </div>
@endsection
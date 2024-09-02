@extends('layouts.global')

@section('title', 'SITA | Bimbingan Tugas Akhir Mahasiswa')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('content')



    <section class="section">
        <div class="section-header">
            <h1>Menambahkan Data Log Book</h1>
        </div>
        <div class="row ">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-primary">
                    <form class="col-sm-12 col-md-12" enctype="multipart/form-data"
                        action="{{ route('student.storeLogbook', [$topic->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" value="PUT" name="_method">

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 ">
                                    <label for="dospem_id">Dosen Pembimbing</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <select class="form-control " name="dospem_id"
                                            class="form-control @error('dospem_id') is-invalid @enderror"
                                            value="{{ old('dospem_id') }}" required autocomplete="dospem_id" autofocus>
                                            <option>Pilih Dosen Pembimbing</option>
                                            <option value="{{ $dosbing_id[0] }}">
                                                {{ $awal[0] }} {{ $akhir[0] }}
                                            <option value="{{ $dosbing_id[1] }}">
                                                {{ $awal[1] }} {{ $akhir[1] }}
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group col-12 ">
                                    <label for="waktu">Waktu Bimbingan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input id="waktu" name="waktu" type="text"
                                            class="form-control datetimepicker">
                                    </div>
                                </div>
                                <div class="form-group col-12 ">
                                    <label for="ruangan">Tempat Bimbingan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-marker"></i>
                                            </div>
                                        </div>
                                        <input id="ruangan" name="ruangan" type="text" class="form-control ">
                                    </div>
                                </div>


                                <div class="form-group col-12 ">
                                    <label for="catatan">Catatan Bimbingan</label>
                                    <div class="input-group">

                                        <textarea id="catatan" name="catatan" type="text" class="form-control "></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection

@push('page-scripts')
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endpush

@push('after-scripts')
    <script>
        //
    </script>
@endpush

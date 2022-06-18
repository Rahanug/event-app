@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Daftar Event</h1>
                        </div>
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @endif
                        <section id="multiple-column-form">
                            <form method="POST" action="{{ route('storependaftar') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="id_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Event</label>
                                    <select class="form-control @error('id_event') is-invalid @enderror " id="id_event" name="id_event">
                                        <option value="" onclick="">-- Pilih Event --</option>
                                        @foreach ($events as $item)
                                        <option value="{{ old('id_event',$item->id_event) }}">{{ $item->nama_event }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_event')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_pendaftar" style="font-weight:500; color:#3378FF; font-size: 18px;">Nama</label>
                                    <input type="text" id="nama_pendaftar" value="{{ old('nama_pendaftar') }}" class="form-control @error('nama_pendaftar') is-invalid @enderror" placeholder="Nama" name="nama_pendaftar">
                                    @error('nama_pendaftar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email_pendaftar" style="font-weight:500; color:#3378FF; font-size: 18px;">Email</label>
                                    <input type="text" id="email_pendaftar" value="{{ old('email_pendaftar')}}" class="form-control @error('email_pendaftar') is-invalid @enderror" placeholder="Email" name="email_pendaftar">
                                    @error('email_pendaftar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir" style="font-weight:500; color:#3378FF; font-size: 18px;">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" value="{{ old('tanggal_lahir')}}" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="tanggal_lahir" name="tanggal_lahir">
                                    @error('tanggal_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-secondary" style="background: #8A2EFF; border: none" name="submit" value="Simpan Data">Submit</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
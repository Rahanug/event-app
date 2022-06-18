@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
    document.title = "Event"
</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2" style="font-weight:bold; color:#3378FF;">Event</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="mr-2">
                <button type="button" class="btn btn-outline-primary" style="font-weight: bold;" data-toggle="modal" data-target="#tambahModal">Tambah Event</button>
                <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <main class="justify-content-md-center-lg-10 px-md-2">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <section id="multiple-column-form">
                                        <div class="row match-height">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form method="POST" action="{{route('admins.storeEvents')}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="nama_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Nama Event</label>
                                                                            <input type="text" id="nama_event" value="{{ old('nama_event') }}" class="form-control @error('nama_event') is-invalid @enderror" placeholder="Nama Event" name="nama_event">
                                                                            @error('nama_event')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tanggal_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Tanggal Event</label>
                                                                            <input type="date" id="tanggal_event" value="{{ old('tanggal_event')}}" class="form-control @error('tanggal_event') is-invalid @enderror" placeholder="tanggal_event" name="tanggal_event">
                                                                            @error('tanggal_event')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="informasi_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Informasi Event</label>
                                                                            <input type="text" id="informasi_event" value="{{ old('informasi_event') }}" class="form-control @error('informasi_event') is-invalid @enderror" placeholder="informasi Event" name="informasi_event">
                                                                            @error('informasi_event')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="card shadow w-100 responsive" style="margin: top 10px;">
            <div class="card-body" style="margin: top 10px;">
                @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                @if (session()->has('info'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="tableMaster">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Informasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{ ++$no; }}</td>
                                <td>{{ $event->nama_event }}</td>
                                <td>{{ date('d-m-Y', strtotime($event->tanggal_event))}}</td>
                                <td>{{ $event->informasi_event }}</td>
                                <td>
                                    <a style="margin: 0 3px" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#EditModal{{$event->id_event}}">Edit</a>
                                    <a style="margin: 0 3px" class="btn btn-sm btn-danger" href="{{route('admins.deleteEvents', [$event->id_event])}}">Hapus</a>
                                </td>
                                <div class="modal fade" id="EditModal{{$event->id_event}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Event</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <main class="justify-content-md-center-lg-10 px-md-2">
                                                    <div class="chartjs-size-monitor">
                                                        <div class="chartjs-size-monitor-expand">
                                                            <div class=""></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink">
                                                            <div class=""></div>
                                                        </div>
                                                    </div>
                                                    <section id="multiple-column-form">
                                                        <div class="row match-height">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form method="POST" action="{{route('admins.updateEvents')}}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <label for="nama_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Nama Event</label>
                                                                                            <input type="text" id="nama_event" value="{{ old('nama_event', $event->nama_event) }}" class="form-control @error('nama_event') is-invalid @enderror" placeholder="Nama Event" name="nama_event">
                                                                                            @error('nama_event')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="tanggal_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Tanggal Event</label>
                                                                                            <input type="date" id="tanggal_event" value="{{ old('tanggal_event', optional($event->tanggal_event)->format('Y-m-d'))}}" class="form-control @error('tanggal_event') is-invalid @enderror" placeholder="tanggal_event" name="tanggal_event">
                                                                                            @error('tanggal_event')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="informasi_event" style="font-weight:500; color:#3378FF; font-size: 18px;">Informasi Event</label>
                                                                                            <input type="text" id="informasi_event" value="{{ old('informasi_event', $event->informasi_event) }}" class="form-control @error('informasi_event') is-invalid @enderror" placeholder="informasi Event" name="informasi_event">
                                                                                            @error('informasi_event')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-end">
                                                                                        <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                                                    </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableMaster').DataTable({
            responsive: true,
        });

    });
</script>
@endpush
@extends('layouts.admin')
@section('title', 'Laporan')


@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Laporan</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lihat</li>
                    <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-4 order-xl-1">
            <div class="card">
              <div class="card-header border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h3>Filter Laporan</h3>
              </div>
              <div class="card-body">
               <form action="{{ route('laporan.get') }}" method="POST">
                   @csrf
                    <div class="form-group">
                        <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $from ?? '' }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $to ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Cari Laporan</button>
               </form>
              </div>
            </div>
          </div>
          <div class="col-xl-12 order-xl-2">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Data Pengaduan</h3>
                  </div>
                  <div class="col text-right">
                    @if ($pengaduan ?? '')
                      <form action="{{ route('laporan.export') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date_from" value="{{ $from }}">
                        <input type="hidden" name="date_to" value="{{ $to }}">
                        <button type="submit" class="btn btn-info">Export PDF</button>
                      </form>
                    @endif
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if($pengaduan ?? '')
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Pengaduan</th>
                                <th>Nama</th>
                                <th>Judul Laporan</th>
                                <th>Isi Laporan</th>
                                <th>Tgl Kejadian</th>
                                <th>Lokasi Kejadian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $k => $i)
                            <tr>
                                <td>{{ $k += 1 }}.</td>
                                <td>{{ Carbon\Carbon::parse($i->tgl_pengaduan)->format('d-m-Y') }}</td>
                                <td>{{ $i->user->name }}</td>
                                <td>{{ $i->judul_laporan }}</td>
                                <td>{{ $i->isi_laporan }}</td>
                                <td>{{ Carbon\Carbon::parse($i->tgl_kejadian)->format('d-m-Y') }}</td>
                                <td>{{ $i->lokasi_kejadian }}</td>
                                <td>{{ $i->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('addon-script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pengaduanTable').DataTable();
    } );
</script>
@if (session()->has('status'))
<script>
    Swal.fire({
        title: 'Pemberitahuan!',
        text: "{{ Session::get('status') }}",
        icon: 'success',
        confirmButtonColor: '#28B7B5',
        confirmButtonText: 'OK',
    });
    </script>
@endif
@endpush

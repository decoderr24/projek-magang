@extends('layouts.admin')
@section('title', 'Detail Masyarakat')


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
                <h6 class="h2 text-white d-inline-block mb-0">Detail Masyarakat</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  {{-- <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lihat</li>
                    <li class="breadcrumb-item"><a href="#">Detail Masyarakat</a></li>
                  </ol> --}}
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-6 order-xl-1">
            <div class="card">

              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h3>Detail Masyarakat</h3>
              </div>
              <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NIK</th>
                            <td>:</td>
                            <td>{{ $masyarakat->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $masyarakat->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $masyarakat->email }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>:</td>
                            <td>{{ $masyarakat->username }}</td>
                        </tr>
                        <tr>
                            <th>No Telpon</th>
                            <td>:</td>
                            <td>{{ $masyarakat->telp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td>{{ $masyarakat->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Rt</th>
                            <td>:</td>
                            <td>{{ $masyarakat->rt }}</td>
                        </tr>
                        <tr>
                            <th>Rw</th>
                            <td>:</td>
                            <td>{{ $masyarakat->rw }}</td>
                        </tr>
                        <tr>
                            <th>KD Pos</th>
                            <td>:</td>
                            <td>{{ $masyarakat->kode_pos }}</td>
                        </tr>
                        <tr>
                            <th>ID Provinsi</th>
                            <td>:</td>
                            <td>{{ $masyarakat->province_id }}</td>
                        </tr>
                        <tr>
                            <th>ID Kota/Kabupaten</th>
                            <td>:</td>
                            <td>{{ $masyarakat->regency_id }}</td>
                        </tr>
                        <tr>
                            <th>ID Kecamatan</th>
                            <td>:</td>
                            <td>{{ $masyarakat->district_id }}</td>
                        </tr>
                        <tr>
                            <th>ID Desa</th>
                            <td>:</td>
                            <td>{{ $masyarakat->village_id }}</td>
                        </tr>

                    </tbody>
                </table>
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

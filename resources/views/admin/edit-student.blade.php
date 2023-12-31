@extends('layouts.app')

@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h3 class="text-dark font-weight-bold my-1 mr-5"><b>Edit Data Siswa</b></h3>
                    <!--end::Page Title-->

                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Data Siswa</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.student', ['id' => $student->id]) }}" method="post">
                        @csrf

                        <div class="form-group"> 
                            <label for="nis">NIS</label> 
                            <input type="text" name="nis" id="nis" class="form-control" required="required"
                            value="{{ $student->nis }}" placeholder="Masukkan nomor induk siswa"> 
                        </div>

                        <div class="form-group"> 
                            <label for="nama">Nama Lengkap</label> 
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $student->nama }}" placeholder="Masukkan nama siswa"> 
                        </div>

                        <div class="form-group">
                            <label for="id_kelas">Class</label>
                            <select class="form-select" name="id_kelas" id="id_kelas">
                                @foreach($student_classes as $student_class)
                                <option value="{{ $student_class->id }}" {{ $student->student_class ? $student->student_class->id == $student_class->id ? 'selected' : '' : '' }}>{{ $student_class->nama_kelas }}</option>
                                @endforeach
                            </select>
                         </div>
                         

                        <div class="form-group"> 
                            <label for="tempat_lahir">Tempat Lahir</label> 
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $student->tempat_lahir }}" placeholder="Masukkan tempat lahir siswa"> 
                        </div>

                        <div class="form-group"> 
                            <label for="tanggal_lahir">Tanggal Lahir</label> 
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $student->tanggal_lahir }}" placeholder="Masukkan tanggal lahir siswa"> 
                        </div>

                        <div class="form-group">
                            <label for="jk">Jenis Kelamin:</label>
                            <input type="radio" id="laki-laki" name="jk" value="laki-laki" {{ $student->jk === 'laki-laki' ? 'checked' : '' }}>
                            <label for="laki-laki">Laki-laki</label>
                            <input type="radio" id="perempuan" name="jk" value="perempuan" {{ $student->jk === 'perempuan' ? 'checked' : '' }}>
                            <label for="perempuan">Perempuan</label><br>
                        </div>

                        <div class="form-group"> 
                            <label for="nama_ortu">Nama Orang Tua</label> 
                            <input type="text" name="nama_ortu" id="nama_ortu" class="form-control" value="{{ $student->nama_ortu }}" placeholder="Masukkan nama orang tua siswa"> 
                        </div>
    
                        <div class="form-group"> 
                            <label for="alamat">Alamat</label> 
                            <br><textarea name="alamat" id="alamat" rows="3" class="form-control"   placeholder="Masukkan alamat siswa">{{ $student->alamat }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-select">
                                <option value="Belum Lulus" {{ $student->status === 'Belum Lulus' ? 'selected' : '' }}>Belum Lulus</option>
                                <option value="Sudah Lulus" {{ $student->status === 'Sudah Lulus' ? 'selected' : '' }}>Sudah Lulus</option>
                            </select>
                        </div>
    
                        <div class="text-right"> 
                            <a href="{{ route('admin.student') }}" class="btn btn-outline-danger mr-2" role="button">Batal</a> 
                            <button type="submit" class="btn btn-primary">Simpan</button> 
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

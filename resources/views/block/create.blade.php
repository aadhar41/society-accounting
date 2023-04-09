@extends('layouts.app')

@section('title', config('app.name') . ' | ' . ucfirst($title))

@section('content')

@include('partials._select2Assests')

<!-- Main content -->
<section class="content mt-2">
    <div class="container-fluid">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ ucfirst($title) }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $module }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <form action="{{ route('admin.block.store') }}" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="{{ route('admin.block.list') }}" class="btn btn-primary">
                                            <i class="fas fa-arrow-circle-left"></i>&nbsp;
                                            Record Lists
                                        </a>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" />
                                                @if($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="society">Society :</label>
                                                <select name="society" id="society" class="form-control select2 {{ $errors->has('society') ? 'is-invalid' : '' }}">
                                                    <option value="">Select Society</option>
                                                    @foreach($societies as $id => $name)
                                                    <option value="{{ $id }}" {{ (old("society") == $id ? "selected":"") }}>{{ ucwords($name) }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('society'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('society') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_flats">Total Flats :</label>
                                                <input type="number" minlength="1" maxlength="10" name="total_flats" value="{{ old('total_flats') }}" id="total_flats" class="form-control {{ $errors->has('total_flats') ? 'is-invalid' : '' }}" placeholder="Total Flats" autocomplete="off" />
                                                @if($errors->has('total_flats'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('total_flats') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" rows="4" class="ckeditor form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
                                                @if($errors->has('description'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary ml-2">
                                            Submit
                                        </button>

                                    </div>
                                    <!-- /.card-body -->

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6"></div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@include('partials._ckeditor')
@endsection
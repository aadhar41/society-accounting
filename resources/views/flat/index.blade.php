@extends('layouts.app')

@section('title', config('app.name') . ' | ' . ucfirst($title))

@section('content')

@include('partials._select2Assests')
@include('partials._datatableAssests')


<!-- Main content -->
<section class="content mt-2">
    <div class="container-fluid">

        <!-- Content Header (Page header) -->
        <x-content-header :title="$title" :module="$module" />

        <form action="{{ route('admin.flat.store') }}" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-lg-12 col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <x-card-title route="{{ route('admin.flat.create') }}" type="primary" title="Add Record" />
                                    <x-card-tools route="{{ route('admin.flat.list') }}" type="primary" title="Clear Search" />
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name </label>
                                                    <input type="text" name="name" id="name" placeholder="Name" class="form-control" autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" id="status" class="form-control select2" placeholder="Select Status">
                                                        <option value="">Select Status</option>
                                                        <option value="0">Inactive</option>
                                                        <option value="1">Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                            </div>
                            <!-- /.card -->


                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>Listing</b>
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

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-sm display nowrap" style="width:100%" id="flat-table">
                                            <thead>
                                                <th>S.No</th>
                                                <th>Code</th>
                                                <th>Society</th>
                                                <th>Block</th>
                                                <th>Plot</th>
                                                <th>Owner</th>
                                                <th>Flat No</th>
                                                <th>Mobile No</th>
                                                <th>Property Type</th>
                                                <th>Tenant Name</th>
                                                <th>Tenant Contact</th>
                                                <!-- <th>Description</th> -->
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="100">Action</th>
                                            </thead>
                                        </table>
                                    </div>
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
    
    var oTable = $('#flat-table').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500, 1000, -1],
            [10, 25, 50, 100, 250, 500, 1000, 'All'],
        ],
        processing: true,
        destroy: true,
        searching: true,
        serverSide: true,
        ajax: {
            url: "{!! route('flat.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.name = $('#name').val();
            }
        },
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'unique_code',
                name: 'unique_code'
            },
            {
                data: 'society',
                name: 'society'
            },
            {
                data: 'block',
                name: 'block'
            },
            {
                data: 'plot',
                name: 'plot'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'flat_no',
                name: 'flat_no'
            },
            {
                data: 'mobile_no',
                name: 'mobile_no'
            },
            {
                data: 'property_type',
                name: 'property_type'
            },
            {
                data: 'tenant_name',
                name: 'tenant_name'
            },
            {
                data: 'tenant_contact',
                name: 'tenant_contact'
            },
            // {
            //     data: 'description',
            //     name: 'description'
            // },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    if (data == 'Enabled') {
                        return "<span class='right badge badge-success p-1'>" + data + "</span>";
                    } else {
                        return "<span class='right badge badge-danger p-1'>" + data + "</span>";
                    }
                }
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [
            [0, 'asc']
        ],
        // bLengthChange:false,
    });

    $('#status').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });

    $('#name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });

    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection
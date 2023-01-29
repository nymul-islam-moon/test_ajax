@extends('components.main')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 Ajax CRUD DataTables Tutorial</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Company</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- boostrap company model -->
    <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="CompanyModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('company.store') }}" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Company Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Company Email" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Company Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Company Address">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
@endsection

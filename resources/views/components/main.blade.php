<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel 9 AJAX CRUD using DataTable js Tutorial From Scratch - Tutsmake.com</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    </head>
<body>

    <div class="container mt-2">
        @yield('content')
    </div>

</body>
<script type="text/javascript">
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var table_x = $('#ajax-crud-datatable').DataTable({
            dom: "lBfrtip",
            processing: true,
            serverSide: true,
            ajax: "{{ url('ajax-crud-datatable') }}",
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            order: [[0, 'desc']]
        });

        // $('#ajax-crud-datatable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ url('ajax-crud-datatable') }}",
        //     columns: [
        //         { data: 'id', name: 'id' },
        //         { data: 'name', name: 'name' },
        //         { data: 'email', name: 'email' },
        //         { data: 'address', name: 'address' },
        //         { data: 'created_at', name: 'created_at' },
        //         {data: 'action', name: 'action', orderable: false},
        //     ],
        //     order: [[0, 'desc']]
        // });
    });

    function add(){
        $('#CompanyForm').trigger("reset");
        $('#CompanyModal').html("Add Company");
        $('#company-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id){
        $.ajax({
            type:"POST",
            url: "{{ url('edit-company') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $('#CompanyModal').html("Edit Company");
                $('#company-modal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#address').val(res.address);
                $('#email').val(res.email);
            }
        });
    }

    function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('delete-company') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    $('#CompanyForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ url('store-company')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#company-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
                console.log(data);
            }
        });
    });

</script>
</html>

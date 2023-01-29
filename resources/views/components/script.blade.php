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
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            order: [[0, 'desc']]
        });


        /*
            Old versions down
        */

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
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type:'POST',
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            success: (data) => {
                $("#company-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(err){
                console.log(err);
            }
        });
    });

</script>

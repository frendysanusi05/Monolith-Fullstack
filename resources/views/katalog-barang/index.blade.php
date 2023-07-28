@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.data-table').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('katalog.getBarang') }}",
            columns:[
                {data:'DT_RowIndex', name:'DT_RowIndex', searchable: false, orderable: false},
                {data:'nama', name:'nama'},
                {
                    data: 'id',
                    name: 'action',
                    render: function(data) {
                        var url = '/katalog-detail/' + data;
                        var btn = '<a href="' + url + '" class="edit btn btn-primary btn-sm">Detail</a>';
                        return btn;
                    }
                }
            ]
        });

        // Long-polling
        // function pollItems() {
        //     $.ajax({
        //         url: '/poll-barang',
        //         method: 'GET',
        //         dataType: 'json',
        //         success: function(response) {
        //             console.log("HERE");
        //             if (response.data.length > 0) {
        //                 // Update the table with new data
        //                 response.data.forEach(function(item) {
        //                     dataTable.row.add([
        //                         item.DT_RowIndex,
        //                         item.nama,
        //                         '<a href="/katalog-detail/' + item.id + '" class="edit btn btn-primary btn-sm">Detail</a>'
        //                     ]).draw();
        //                 });
        //             }
        //             pollItems();
        //         },
        //         error: function(error) {
        //             window.location.href = '/katalog';
        //         }
        //     });
        // }

        // pollItems();
    });
</script>
@endsection

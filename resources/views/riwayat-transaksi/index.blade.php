@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
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
            ajax:"{{ route('riwayat.getRiwayat', $id) }}",
            columns:[
                {data:'DT_RowIndex', name:'DT_RowIndex', searchable: false, orderable: false},
                {data:'item_name', name:'item_name'},
                {data:'amount', name:'amount'},
                {data:'total_price', name:'total_price'}
            ]
        });
    });
</script>
@endsection

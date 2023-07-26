@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kode</th>
                        <th>ID Perusahaan</th>
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
            ajax:"{{ route('beli.getIdentitasBarang', $id) }}",
            columns:[
                {data:'nama', name:'nama'},
                {data:'harga', name:'harga'},
                {data:'stok', name:'stok'},
                {data:'kode', name:'kode'},
                {data:'perusahaan_id', nama:'perusahaan_id'},
                {data:'jumlah', nama:'jumlah'},
                {data:'total', nama:'total'}           
            ],
        });

        $(document).on('change', '#item-jumlah', function() {
            console.log("TES");
            var rowIndex = $(this).closest('tr').index();
            var rowData = table.row(rowIndex).data();
            var harga = rowData.harga;
            var jumlah = $(this).val();
            rowData.jumlah = jumlah;
            var total = harga * jumlah;
            rowData.total = total;
            table.row(rowIndex).data(rowData).draw(false);
        });
    });
</script>
@endsection

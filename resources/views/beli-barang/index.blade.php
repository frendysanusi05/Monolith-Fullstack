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
        var table = $('.data-table').DataTable({
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
                {data:'total', nama:'total'},
                {
                    data: 'id',
                    name: 'action',
                    render: function(data, type, row) {
                        var jumlah = !isNaN(row.jumlah) ? row.jumlah : 1;
                        var edit_btn = '<a href="/beli/' + data + '" class="edit btn btn-primary btn-sm">Edit</a>';
                        var buy_btn = '<a href="/transaksi/' + data + '/' + jumlah + '" class="edit btn btn-danger btn-sm">Buy</a>';
                        return edit_btn + ' ' + buy_btn;
                    }
                }       
            ],
        });

        $(document).on('change', '#item-jumlah', function() {
            var rowIndex = $(this).closest('tr').index();
            var rowData = table.row(rowIndex).data();
            var harga = rowData.harga;
            var jumlah = $(this).val();
            rowData.jumlah = jumlah;
            var total = harga * jumlah;
            rowData.total = total;
            table.row(rowIndex).data(rowData);
        });
    });
</script>
@endsection

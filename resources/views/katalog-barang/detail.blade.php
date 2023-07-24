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
            ajax:"{{ route('katalog.getDetailBarang', $id) }}",
            columns:[
                {data:'nama', name:'nama'},
                {data:'harga', name:'harga'},
                {data:'stok', name:'stok'}
            ]
        });
    });
</script>
@endsection

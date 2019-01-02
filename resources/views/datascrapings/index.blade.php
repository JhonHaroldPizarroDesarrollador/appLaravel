@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Paginas Guardadas para hacer xray</h3>
            <ul>
                @foreach($datascrapings as $item)
                <li><?= $item; ?></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@include('footer') {{--  variables depend to this view  --}}
<script type="text/javascript">
    $(document).ready(function(){
        console.log(window);
    });
</script>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Paginas Guardadas para hacer xray</h3>
            <ul>

                <li><?= $datascraping->id; ?></li>
                <li><?= $datascraping->pagina; ?></li>
                <li><?= $datascraping->selector; ?></li>
                <li><?= $datascraping->titulo; ?></li>
                <li><?= $datascraping->imagen; ?></li>
                <li><?= $datascraping->url; ?></li>

            </ul>
            @foreach ($resultados as $resultado )
            <a href="<?= $resultado->url ;?>">
                <p><?= $resultado->id ;?></p>
                <p><?= $resultado->nombre ;?></p>
                <p><?= $resultado->precio ;?></p>
                <img src="<?= $resultado->imagen ;?>">
            </a>
            <br>
            @endforeach
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

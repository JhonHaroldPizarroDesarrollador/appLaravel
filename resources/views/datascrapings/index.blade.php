@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Paginas Guardadas para hacer scraping</h3>
            <li><?= $datascrapingid->id; ?></li>
            <li><?= $datascrapingid->pagina; ?></li>
            <li><?= $datascrapingid->selector; ?></li>
            <li><?= $datascrapingid->titulo; ?></li>
            <li><?= $datascrapingid->imagen; ?></li>
            <li><?= $datascrapingid->url; ?></li>

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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <form method="post" action="/datascrapingpagination" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="pagina">Pagina para hacer web scraping con goutte laravel:</label>
                <input type="text" class="form-control" id="pagina" name="pagina">
            </div>
            <div class="form-group">
                <label for="selector">Selector principal:</label>
                <input type="text" class="form-control" id="selector" name="selector">
            </div>
            <div class="form-group">
                <label for="url">Enlace:</label>
                <input type="text" class="form-control" id="url" name="url">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="text" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="form-group">
                <label for="titulo">Titulo:</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" class="form-control" id="precio" name="precio">
            </div>
            <div class="form-group">
                <label for="pagination">Paginacion:</label>
                <input type="text" class="form-control" id="pagination" name="pagination">
            </div>
            <button class="btn btn-primary" id="ajaxSubmit" name="ajaxSubmit" >Submit</button>
        </form>
    </div>
</div>
@include('footer') {{--  variables depend to this view  --}}
<script type="text/javascript">
    $(document).ready(function(){
        console.log(window);
    });
</script>
@endsection

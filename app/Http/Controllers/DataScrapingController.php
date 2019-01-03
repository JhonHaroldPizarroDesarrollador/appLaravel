<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use JavaScript;
use App\Datascraping;
use App\Resultado;
use Goutte;
use Goutte\Client;

class DataScrapingController extends Controller{

    public function index(){
        $datascrapings = Datascraping::all();
        return view('datascrapings.index', ['datascrapings' => $datascrapings]);
    }

    public function create(){
        return view('datascrapings.create');
    }
    public function createSingle(){
        return view('datascrapings.create');
    }
    public function createPagination(){
        return view('datascrapings.createpagination');
    }



    public function show(Request $request, $id){
        //ACCEDEMOS A LA BASE DE DATOS//
        $datascraping = Datascraping::find($id);  // equivale a SELECT * FROM users where user=$id
        $resultado = Resultado::all();  // equivale a SELECT * FROM users where user=$id
        //return $datascraping;
        return view('datascrapings.show', ['datascraping' => $datascraping, 'resultados' => $resultado]);
    }

    public function showAll(){
        $datascrapings = Datascraping::all();
        return view('datascrapings.index', ['datascrapings' => $datascrapings]);
    }

    public function store(Request $request){
        $this->validate(request(),[
            //put fields to be validated here
        ]);
        // get vars from  the request
        $pagina = $request['pagina'];
        $selector = $request['selector'];
        $titulo = $request['titulo'];
        $imagen = $request['imagen'];
        $url = $request['url'];
        $precio = $request['precio'];
        // save in database the arguments for make scraping
        $datascraping = new Datascraping();
        $datascraping->pagina = $pagina;
        $datascraping->selector = $selector;
        $datascraping->titulo = $titulo;
        $datascraping->imagen = $imagen;
        $datascraping->url = $url;
        $datascraping->precio = $precio;
        $datascraping->save();
        $insertedId = $datascraping->id;
        // start scraping
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $precioNode ='';
        $nombres ='';
        $crawler = Goutte::request('GET', $pagina);
        $crawler->filter($selector)->each(function ($liNode) use ($pagina, $insertedId, $titulo, $imagen, $url, $precio) {
            $urlNode = $liNode->filter($url)->eq(0)->attr('href');
            $imagenNode = $liNode->filter($imagen)->eq(0)->attr('src');
            $nombreNode = $liNode->filter($titulo)->first();
            $nombres = $nombreNode->text();
            $precioNode = $liNode->filter($precio)->first();
            $precios = $precioNode->text();
            //echo $nombres .' - '. $precios .' <br>';
            // save data from in database table resultados
            $resultados = new Resultado();
            $resultados->nombre = $nombres;
            $resultados->precio = $precios;
            $resultados->imagen = $imagenNode;
            $resultados->url = $urlNode;
            $resultados->datascraping_id = $insertedId;
            $resultados->save();
        });

        /*$datascrapings = Datascraping::all();
        return view('datascrapings.index', [
            'datascrapings' => $datascrapings
        ]);*/
        $datascrapings = Datascraping::all();
        $datascrapingid = Datascraping::find($insertedId);  // equivale a SELECT * FROM users where user=$id
        $resultado = Resultado::all();  // equivale a SELECT * FROM users where user=$id
        //return $datascraping;
        return view('datascrapings.index', [
            'datascrapings' => $datascrapings,
            'datascrapingid' => $datascrapingid,
            'resultados' => $resultado
        ]);
    }

    public function storePagination(Request $request){

        $this->validate(request(),[
            //put fields to be validated here
        ]);
        // get vars from  the request
        $pagina = $request['pagina'];
        $selector = $request['selector'];
        $titulo = $request['titulo'];
        $imagen = $request['imagen'];
        $url = $request['url'];
        $precio = $request['precio'];
        $pagination = $request['pagination'];
        // save in database the arguments for make scraping
        $datascraping = new Datascraping();
        $datascraping->pagina = $pagina;
        $datascraping->selector = $selector;
        $datascraping->titulo = $titulo;
        $datascraping->imagen = $imagen;
        $datascraping->url = $url;
        $datascraping->precio = $precio;
        //$datascraping->paginacion = $pagination;
        $datascraping->save();
        $insertedId = $datascraping->id;
        // start scraping
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $pages=0;
        $startPage=1;
        $nextPageUrl = '';
        $nextPageNumber = '';
        do {
            $crawler = Goutte::request('GET', $pagina.$startPage);
            // $vaidate variable para verificar que el contenedor principal exita
            $validate = $crawler->filter($selector)->count();
            if (!empty($validate)) {
                $nextPageUrl = $crawler->filter($pagination)->eq(0)->attr('href');
                $nextPageNumber = substr($nextPageUrl, -1); // returns "#pagina"
                $crawler->filter($selector)->each(function ($liNode) use ($startPage, $pagina, $insertedId, $titulo, $imagen, $url, $precio) {
                    $urlNode = $liNode->filter($url)->eq(0)->attr('href');
                    $imagenNode = $liNode->filter($imagen)->eq(0)->attr('src');
                    $nombreNode = $liNode->filter($titulo)->first();
                    $nombres = $nombreNode->text();
                    //$precioNode = $liNode->filter('.s-item__price > span')->first();
                    $precioNode='';
                    $precios='';
                    //count the node precioNode before you try to get that attribute:
                        if ($liNode->filter($precio)->count() > 0 ) {
                            $precioNode = $liNode->filter($precio)->first();
                                $precios = $precioNode->text();
                        }
                    //echo $nombres .' - ' . $precios . ' - '. $startPage .' - <br>';
                    // save data from in database table resultados
                    $resultados = new Resultado();
                    $resultados->nombre = $nombres;
                    $resultados->precio = $precios;
                    $resultados->imagen = $imagenNode;
                    $resultados->url = $urlNode;
                    $resultados->datascraping_id = $insertedId;
                    $resultados->save();
                });
                $startPage++;
            }
        }
        while (!empty($validate) );

        $datascrapings = Datascraping::all();
        $datascrapingid = Datascraping::find($insertedId);  // equivale a SELECT * FROM users where user=$id
        $resultado = Resultado::all();  // equivale a SELECT * FROM users where user=$id
        //return $datascraping;
        return view('datascrapings.index', [
            'datascrapings' => $datascrapings,
            'datascrapingid' => $datascrapingid,
            'resultados' => $resultado
        ]);;
    }


}
/* XrayWebsSraping('https://www.buy-online.es/', '#subcategories li', '', '' , '');

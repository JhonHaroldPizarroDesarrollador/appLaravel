<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use JavaScript;
use App\Datascraping;
use Goutte;
use Goutte\Client;

class DataScrapingController extends Controller
{

    public function getData(Request $request){
        return $request->all();

    }

    public function index(){
        $datascrapings = Datascraping::all();
        return view('datascrapings.index', ['datascrapings' => $datascrapings]);
    }

    public function create(){
        return view('datascrapings.create');
    }

    public function showols(Datascraping $id){
        return view('datascrapings.show', ['datascrapings' => $id]);
    }

    public function show(Request $request, $id){
        //ACCEDEMOS A LA BASE DE DATOS//
        $datascraping = Datascraping::find($id);  // equivale a SELECT * FROM users where user=$id
        //return $datascraping;
        return view('datascrapings.show', ['datascraping' => $datascraping]);
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
            // start scraping
            $urlNode = '';
            $imagenNode ='';
            $nombreNode ='';
            $precioNode ='';
            $nombres ='';
            $crawler = Goutte::request('GET', $pagina);
            $crawler->filter($selector)->each(function ($liNode) use ($titulo, $imagen, $url, $precio) {
                $urlNode = $liNode->filter($url)->eq(0)->attr('href');
                $imagenNode = $liNode->filter($imagen)->eq(0)->attr('src');
                $nombreNode = $liNode->filter($titulo)->first();
                $nombres = $nombreNode->text();
                $precioNode = $liNode->filter($precio)->first();
                $precios = $precioNode->text();
                echo $nombres .' - '. $precios .' - '. $imagenNode .' - '. $urlNode .'<br>';
            });





        //return redirect('/');
         JavaScript::put([
            'pagina'=>$request['pagina'],
            'selector'=>$request['selector'],
            'image'=>$request['imagen'],
            'title'=>$request['titulo'],
            'url'=> $request['url']
        ]);

        $datascrapings = Datascraping::all();
        return view('datascrapings.index', [
            'datascrapings' => $datascrapings
        ]);
    }




}
/* XrayWebsSraping('https://www.buy-online.es/', '#subcategories li', '', '' , '');

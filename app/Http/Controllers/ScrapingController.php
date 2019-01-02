<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;
//use Goutte\Client;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

class ScrapingController extends Controller
{
    public function example(Client $client){
        $crawler = $client->request('GET', 'https://www.buy-online.es/');
        dd($crawler);
    }

    public function scrapingOrignal(){

        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $pages=0;

        $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999');


        // hay que seleccionar el elemento que esta despues del ol y tmar el enlace, luego pasar ese enlace al crawler para que tome los datos de cada pagina  hasta llegar a la ultima. esto para ebay
        // pra linio hay que tomar el valor del nmro de pagina que hay en la url.

        // luego  hay que validar si la pagina es ebay, linio o alguna otra par apoder aplicar un crwler diferente segun sea el caso .[]

        $pages = ($crawler->filter('.ebayui-pagination  ol > li')->count() > 0)
            //? $crawler->filter('.ebayui-pagination ol > li:nth-last-child(2) > a')->text()
            ? $crawler->filter('.ebayui-pagination ol > li:first-child > a')->text()
            : 0
        ;

        for ($i = 0; $i < $pages + 1; $i++) {
            if ($i != 0) {
                $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999?rt=nc&_pgn='.$i);
                $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($pages) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    $precioNode = $liNode->filter('.s-item__price span')->first();
                    $precios = $precioNode->text();
                    echo $nombres .' - ' . $precios . ' - '. $pages .' - <br>';
                });
            }
        }



        // $output = $crawler->filter('.ebayui-pagination  ol  li')->first()->text();
        //var_dump($output);

        return view('scrapings.index', ['pages' => $pages]);
    }

    public function scrapingotro(){

        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $page=1;

        $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999');

        $pages = ($crawler->filter('.ebayui-pagination  ol > li')->count() > 0)
            //? $crawler->filter('.ebayui-pagination ol > li:nth-last-child(2) > a')->text()
            ? $crawler->filter('.ebayui-pagination ol > li:first-child > a')->text()
            : 0
        ;

        $nextPageUrl = $crawler->filter('.ebayui-pagination ol + a')->eq(0)->attr('href');
        $nextPageNumber = substr($nextPageUrl, -1); // returns "s"


        for ($i = 0; $i < $pages + 1; $i++) {
            if (($i != 0) && ($i <= 1 )) {
                $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999?rt=nc&_pgn='.$i);
                $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($nextPageNumber) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    $precioNode = $liNode->filter('.s-item__price span')->first();
                    $precios = $precioNode->text();
                    echo $nombres .' - ' . $precios . ' - Nexpage:'. $nextPageNumber .' - <br>';
                });
                //echo $pages;$pages++;
            }
            if ($i === $nextPageNumber) {
                $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999?rt=nc&_pgn='.$i);
                $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($nextPageNumber) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    $precioNode = $liNode->filter('.s-item__price span')->first();
                    $precios = $precioNode->text();
                    echo $nombres .' - ' . $precios . ' - Nexpage:'. $nextPageNumber .' - <br>';
                });
                //echo $pages;$pages++;
            }
        }



        // $output = $crawler->filter('.ebayui-pagination  ol  li')->first()->text();
        //var_dump($output);

        return view('scrapings.index', ['pages' => $pages]);
    }
    public function scrapingnew(){
        // en ebay para saber que pagina sigue, hay que seleccionar el elemento que esta despues del ol y tomar el enlace, luego pasar ese enlace al crawler para que tome los datos de cada pagina  hasta llegar a la ultima. esto para ebay

        // para linio hay que tomar el valor del nmro de pagina que hay en la url.
        /*$pages = ($crawler->filter('.ebayui-pagination  ol + a')->count() > 0)
            //? $crawler->filter('.ebayui-pagination ol > li:nth-last-child(2) > a')->text()
            ? $crawler->filter('.ebayui-pagination ol > li:first-child > a')->text()
            : 0
        ;*/
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $url='https://co.ebay.com/b/Mens-Shoes/93427/bn_61999';
        $pagination='?rt=nc&_pgn=';
        $currentPage=1;
        $pages=0;
        // hay que validar si la pagina es ebay, linio o alguna otra par apoder aplicar un crwler diferente segun sea el caso.
        $crawler = Goutte::request('GET', $url.$pagination.$currentPage);
        $nextPage = $crawler->filter('.ebayui-pagination ol + a')->eq(0)->attr('href');

        for ($i = 0; $i < $currentPage + 1; $i++) {
            //$currentPage++;
            if ($i === 1) {
                $crawler = Goutte::request('GET', $url.$pagination.$currentPage);
                $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($currentPage) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    $precioNode = $liNode->filter('.s-item__price span')->first();
                    $precios = $precioNode->text();
                    echo $nombres .' - ' . $precios . ' - '. $currentPage .' - <br>';
                });
                $currentPage++;
                echo $nextPage.' - <br>';
            }
            elseif ($i === $currentPage) {
                $crawlerNext = Goutte::request('GET', $nextPage);
                //$nextPage = $crawlerNext->filter('.ebayui-pagination ol + a.ebayui-pagination__control')->eq(0)->attr('href');
                //$newCrawler = Goutte::request('GET', $nextPage);
                $crawlerNext->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($currentPage) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    $precioNode = $liNode->filter('.s-item__price span')->first();
                    $precios = $precioNode->text();
                    echo $nombres .' - ' . $precios . ' - '. $currentPage .' - <br>';
                });
                $nextPage = $crawlerNext->filter('.ebayui-pagination ol + a.ebayui-pagination__control')->eq(0)->attr('href');
                $currentPage++;
                echo $nextPage.' - <br>';
            }
            //$pages++;
        };



        // $output = $crawler->filter('.ebayui-pagination  ol  li')->first()->text();
        //var_dump($output);

        return view('scrapings.index', ['pages' => $pages]);
    }

    public function scraping(){

        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $pages='';
        $page=1;
        $data = array();

        $crawler = Goutte::request('GET', 'https://www.linio.com.pa/c/computacion?q=&page='.$page);

        for ($i = 0; $i < $page + 1; $i++ ) {
            if ($i != 0) {

                if (!empty($crawler->filter('#catalogue-product-container'))) {

                    $crawler->filter('#catalogue-product-container ')->each(function ($liNode) use ($page) {

                        $urlNode = $liNode->filter('.catalogue-product a')->eq(0)->attr('href');
                        $imagenNode = $liNode->filter('.catalogue-product a .image-container  img')->eq(0)->attr('src');
                        $nombreNode = $liNode->filter('.catalogue-product .detail-container p  span')->first();
                        $nombres = $nombreNode->text();
                        $precioNode = $liNode->filter('.catalogue-product .detail-container .price-section .price-secondary')->first();
                        $precios = $precioNode->text();
                        //echo $nombres .' - ' . $precios . ' - '. $page .' - <br>';
                        echo $page .'<br>';

                    });
                    $page++;
                }

            }
        }



        // $output = $crawler->filter('.ebayui-pagination  ol  li')->first()->text();
        //var_dump($output);

        return view('scrapings.index', ['data' => $data]);
    }

    public function scrapingold(){
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999');
        $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) {
            $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
            $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
            $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
            $nombres = $nombreNode->text();
            $precioNode = $liNode->filter('.s-item__price span')->first();
            $precios = $precioNode->text();
            echo $nombres .' - ' . $precios . ' - '. $imagenNode .' - '. $urlNode .'<br>';
        });
        return view('scrapings.index');
    }

}

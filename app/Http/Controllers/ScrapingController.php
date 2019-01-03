<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


//use Guzzle\Http\Client;
//use Guzzle\Http\Exception\ClientErrorResponseException;

class ScrapingController extends Controller{

    public function example(Client $client){
        $crawler = $client->request('GET', 'https://www.buy-online.es/');
        dd($crawler);
    }

    public function scraping(){
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $crawler = Goutte::request('GET', 'https://tucanstore.com/categoria-producto/entrega-i/');
        $crawler->filter('.products li')->each(function ($liNode) {
            $urlNode = $liNode->filter('a')->eq(0)->attr('href');
            $imagenNode = $liNode->filter('a .et_shop_image img')->eq(0)->attr('src');
            $nombreNode = $liNode->filter('a h2')->first();
            $nombres = $nombreNode->text();
            $precioNode = $liNode->filter('a .price .amount')->first();
            $precios = $precioNode->text();
            echo $nombres .' - ' . $precios . ' - '. $imagenNode .' - '. $urlNode .'<br>';
        });
        return view('scrapings.index');
    }

    public function scrapingAngular(){
        $urlNode = '';
        $imagenNode ='';
        $nombreNode ='';
        $nombres='';
        $precios='';
        $crawler = Goutte::request('GET', 'https://www.bershka.com/pa/hombre/rebajas/cazadoras-c1010194081.html');
        $crawler->filter('#grid_images .item .grid-item-container')->each(function ($liNode) {
            $urlNode = $liNode->filter(' .image a')->eq(0)->attr('href');
            $imagenNode = $liNode->filter('.image a img')->eq(0)->attr('src');
            $nombreNode = $liNode->filter('.prodinfo a')->first();
            $nombres = $nombreNode->text();
            $precioNode = $liNode->filter('.product-price span')->first();
            $precios = $precioNode->text();
            echo $nombres .' - ' . $precios . ' - '. $imagenNode .' - '. $urlNode .'<br>';
        });
        //dd($crawler);
        return view('scrapings.index');
    }

    public function scrapingSingle(){
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

    public function scrapingPagination(){
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
            $crawler = Goutte::request('GET', 'https://www.linio.com.pa/c/belleza-y-cuidado-personal?page='.$startPage);
            // $vaidate variable para verificar que el contenedor principal exita
            $validate = $crawler->filter('#catalogue-product-container .catalogue-product')->count();
            if (!empty($validate)) {
                $nextPageUrl = $crawler->filter('.pagination li:nth-last-child(2) a')->eq(0)->attr('href');
                $nextPageNumber = substr($nextPageUrl, -1); // returns "#pagina"
                $crawler->filter('#catalogue-product-container .catalogue-product')->each(function ($liNode) use ($startPage) {
                    $urlNode = $liNode->filter('a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('a .image-container  img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.detail-container p  span')->first();
                    $nombres = $nombreNode->text();
                    //$precioNode = $liNode->filter('.s-item__price > span')->first();
                    $precioNode='';
                    $precios='';
                    //count the node precioNode before you try to get that attribute:
                        if ($liNode->filter('.detail-container .price-section .price-secondary')->count() > 0 ) {
                            $precioNode = $liNode->filter('.detail-container .price-section .price-secondary')->first();
                             $precios = $precioNode->text();
                        }
                    echo $nombres .' - ' . $precios . ' - '. $startPage .' - <br>';
                });
                $startPage++;
            }
        }
        while (!empty($validate) );
        return view('scrapings.index');
    }

    public function scrapingLinio(){
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
            $crawler = Goutte::request('GET', 'https://www.linio.com.pa/c/belleza-y-cuidado-personal?page='.$startPage);
            // $vaidate variable para verificar que el contenedor principal exita
            $validate = $crawler->filter('#catalogue-product-container .catalogue-product')->count();
            if (!empty($validate)) {
                $nextPageUrl = $crawler->filter('.pagination li:nth-last-child(2) a')->eq(0)->attr('href');
                $nextPageNumber = substr($nextPageUrl, -1); // returns "#pagina"
                $crawler->filter('#catalogue-product-container .catalogue-product')->each(function ($liNode) use ($startPage) {
                    $urlNode = $liNode->filter('a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('a .image-container  img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.detail-container p  span')->first();
                    $nombres = $nombreNode->text();
                    //$precioNode = $liNode->filter('.s-item__price > span')->first();
                    $precioNode='';
                    $precios='';
                    //count the node precioNode before you try to get that attribute:
                        if ($liNode->filter('.detail-container .price-section .price-secondary')->count() > 0 ) {
                            $precioNode = $liNode->filter('.detail-container .price-section .price-secondary')->first();
                             $precios = $precioNode->text();
                        }
                    echo $nombres .' - ' . $precios . ' - '. $startPage .' - <br>';
                });
                $startPage++;
            }
        }
        while (!empty($validate) );
        return view('scrapings.index');
    }

    public function scrapingEbay(){
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
            $crawler = Goutte::request('GET', 'https://co.ebay.com/b/Mens-Shoes/93427/bn_61999?rt=nc&_pgn='.$startPage);
            // $vaidate variable para verificar que el contenedor principal exita
            $validate = $crawler->filter('.b-list__items_nofooter li')->count();
            if (!empty($validate)) {
                $nextPageUrl = $crawler->filter('.ebayui-pagination ol + a')->eq(0)->attr('href');
                $nextPageNumber = substr($nextPageUrl, -1); // returns "#pagina"
                $crawler->filter('.b-list__items_nofooter li')->each(function ($liNode) use ($startPage) {
                    $urlNode = $liNode->filter('.s-item__image a')->eq(0)->attr('href');
                    $imagenNode = $liNode->filter('.s-item__image-wrapper img')->eq(0)->attr('src');
                    $nombreNode = $liNode->filter('.s-item__info a > h3')->first();
                    $nombres = $nombreNode->text();
                    //$precioNode = $liNode->filter('.s-item__price > span')->first();
                    $precioNode='';
                    $precios='';
                    //count the node precioNode before you try to get that attribute:
                        if ($liNode->filter('.s-item__price span')->count() > 0 ) {
                            $precioNode = $liNode->filter('.s-item__price span')->first();
                             $precios = $precioNode->text();
                        }
                    echo $nombres .' - ' . $precios . ' - '. $startPage .' - <br>';
                });
                $startPage++;
            }
        }
        while (!empty($validate) );
        return view('scrapings.index');
    }





}

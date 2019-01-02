const Xray=require('x-ray');

const xray=new Xray();

var dataList='';

module.exports = {
    xraywebscraping: function (pagina, selector, image, title, url) {
        return xray(pagina, selector, [{
            image: image,
            title: title,
            url: url
        }])(function (err, results) {

            results.forEach(function (result, index) {
                datos={
                    'image': result.image,
                    'title': result.title,
                    'url': result.url
                }
                dataList+='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';

                //$('.xray ul').html(dataList);
                //console.log(dataList);
            });

        }).write('resultados3.json');
       //return dataList;
    }
 }



/*export function xraywebscraping(pagina, selector, image, title, url) {
    xray(pagina, selector, [{
        image: image,
        title: title,
        url: url
    }])(function (err, results) {
        let dataList='';
        results.forEach(function (result, index) {
            datos={
                'image': result.image,
                'title': result.title,
                'url': result.url
            }
            //console.log(datos)

            dataList+='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';

            //$('.xray ul').html(dataList);
            //console.log(dataList);
        });

    }).write('public/js/resultados3.json');
}/*


/* XrayWebsSraping = function xraywebscraping(pagina, selector, image, title, url) {
    xray(pagina, selector, [{
        image: image,
        title: title,
        url: url
    }])(function (err, results) {
        let dataList='';
        results.forEach(function (result, index) {
            datos={
                'image': result.image,
                'title': result.title,
                'url': result.url
            }
            //console.log(datos)

            dataList+='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';

            //$('.xray ul').html(dataList);
            //console.log(dataList);
        });

    }).write('public/js/resultados3.json');
} */

/* XrayWebsSraping('https://www.buy-online.es/', '#subcategories li', 'img@src', 'h5' , 'h5 a@href');



function xraywebscraping(pagina, selector, image, title, url) {
    console.log(pagina + selector+ image+ title+ url)
    const Xray=require('x-ray');
    const request=require('request');
    const fs=require('fs');
    const xray=new Xray();

    xray(pagina, selector, [{
        image:  image,
        title:  title,
        url:    url
    }])(function (err, results) {
        let dataList='';
        results.forEach(function (result, index) {
            datos={
                'image': result.image,
                'title': result.title,
                'url': result.url
            }
            //console.log(datos)

            dataList+='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';

            //$('.xray ul').html(dataList);
            //console.log(dataList);
        });

    }).write('public/js/resultadosdesdelafuncion.json');
} */

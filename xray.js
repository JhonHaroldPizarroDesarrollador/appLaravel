const Xray=require('x-ray');
const request=require('request');
const fs=require('fs');

const xray=new Xray();

xray('https://www.buy-online.es/', '#subcategories li', [{
    image:  'img@src',
    title:  'h5',
    url:    'h5 a@href'
}])(function (err, results) {

    results.forEach(function (result, index) {
        datos={
            'image': result.image,
            'title': result.title,
            'url': result.url
        }
        console.log(datos)

        dataList='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';
        console.log(dataList);
    })

}).write('resultados.json');

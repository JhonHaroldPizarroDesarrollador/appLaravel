var express = require('express');
var fs = require('fs');
var request = require('request');
var cheerio = require('cheerio');
var app     = express();

const Xray=require('x-ray');
//const request=require('request');
//const fs=require('fs');
const xray=new Xray();

//Scraping start
app.get('/scrape', function(req, res){

	request('https://news.ycombinator.com', function (error, response, html) {
	  	if (!error && response.statusCode == 200) {
	    	var $ = cheerio.load(html);
	    	var parsedResults = [];
	    	$('span.comhead').each(function(i, element){
	      		// Select the previous element
	      		var a = $(this).prev();
		      	// Get the rank by parsing the element two levels above the "a" element
		      	var rank = a.parent().parent().text();
		      	// Parse the link title
		      	var title = a.text();
		      	// Parse the href attribute from the "a" element
		      	var url = a.attr('href');
		      	// Get the subtext children from the next row in the HTML table.
		      	var subtext = a.parent().parent().next().children('.subtext').children();
		      	// Extract the relevant data from the children
		      	var points = $(subtext).eq(0).text();
		      	var username = $(subtext).eq(1).text();
		      	var comments = $(subtext).eq(2).text();
		      	// Our parsed meta data object
	      		var metadata = {
	        		rank: parseInt(rank),
	        		title: title,
	        		url: url,
	        		points: parseInt(points),
	        		username: username,
	        		comments: parseInt(comments)
	      		};
	      		// Push meta-data into parsedResults array
	      		parsedResults.push(metadata);
	    	});
	    	// Log our finished parse results in the terminal
	    	console.log(parsedResults);
	  	}

	  	fs.writeFile('output.json', JSON.stringify(parsedResults, null, 4), function(err){
	    	console.log('Sraping data successfully written! - Check your project public/output.json file');
            });







	  	res.send('Scraping Done...');
	});
});

XrayWebsSraping = function xraywebscraping(pagina, selector, image, title, url) {
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
}
//xraywebscraping('https://www.buy-online.es/', '#subcategories li', 'img@src', 'h5' , 'h5 a@href');
app.listen('8001');

console.log('Your node server start successfully....');

exports = module.exports = app;


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

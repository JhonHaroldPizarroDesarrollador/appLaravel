jQuery(document).ready(function ($) {






	//////   RELOAD DISPONIBILIDAD   //////
		var xrayData = 'xrayData';
/* 		$.imageMapProInitialized = function(imageMapName) {
			if(imageMapName==disponibilidad){

			}
			//console.log(arguments);
		} */
	var dataList="";
        (function () {
            $( "#makeScraping" ).click(function() {
                //$("#target").click();
                var datos = "/js/resultados.json";
                $.getJSON( datos, {
                format: "json"
                }).done(function( data ) {
                    data.forEach(function (result) {
                        datos={
                        'image': result.image,
                        'title': result.title,
                        'url': result.url
                        }
                        //console.log(datos)

                        dataList+='<li><div class="image"><a href="'+datos.image+'" title="'+datos.title+'" class="img"><img class="replace-2x" src="'+datos.image+'" alt="" width="" height=""></a></div><h5><a class="subcategory-name" href="'+result.url+'">'+result.title+'</a></h5></li>';

                        console.log(dataList);

                    })
                    $('.xray ul').html(dataList);
                });

            });

            /* $("#makeScraping").on('click',function(){
                var php = " <?php exec('node app.js', $out, $result) ; ?>";
                console.log($result);
                window.location = 'http://127.0.0.1:8080/';
            }); */


		})();

				//jQuery("#modalSpinner").modal("show");






});

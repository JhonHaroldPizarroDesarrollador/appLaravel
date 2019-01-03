# appLaravel
App Laravel- Web Scraping -  Goutter 


1. Clonar el Repositorio
2. Para iniciar debes ingresar atravez de consola a la carperta del proyecto y ejecutar  el comando:  composer install  
3. Crear una base de datos llamada applaravel con un usuario exclusivo para esa base de datos : appLaravel  y password lwtFvIs5v7z4FBGK.Tambien se puede crear la base de datos que queramos con un usuario exclusivo para esa base de datos y la configuramos en el archivo .env . Luego creamos las migraciones con el comando :  php artisan migrate
4. Para iniciar la app debes ejecutar el comando: php artisan serve ,  o el comando :  npm start
5. Para hacer scraping en una web que los productos de la categoria salgan en una sola pagina Ingresar a la url: http://127.0.0.1:8000/create-single , aqui encontramos el fomulario donde se hay que pasar los parametros neccesarios para hacer el scraping.
5. Para hacer scraping en una web que los productos de la categoria salgan en una varias paginas Ingresar a la url: http://127.0.0.1:8000/create-pagination , aqui encontramos el fomulario donde se hay que pasar los parametros neccesarios para hacer el scraping.
6. El parametro para la paginacion se toma del enlace del boton next page en la paginacion
7. Queda pendiente validar que solo un usuario registrado pueda hacer el sacraping

# Notbook

Un servicio de notas que soporta Markdown, exportar en PDF (limitado), con soporte para guardar en XML, compartir y comentarios.


### Instalación

Para instalar, asegúrate de tener lo siguiente:

+ NGINX
+ PHP-FPM (v5 o v7, probado con ambos)
+ PDO para MySQL y PSQL
+ Composer

Primero, clona el repo:
```
git clone https://github.com/apexJCL/Notbook.git
```

Después, configura tu archivo de rutas de manera similar al incluido en el repo, bajo el nombre `notbook.com`.
O bien, puedes agregar el archivo a tu carpeta de `sites-enabled`

Una vez configurado, hay que dar de alta la base de datos.

Para MySQL|MaríaDB, use el archivo `mysql.sql`  
Para PostGreSQL, use el archivo `psql.sql`

Una vez creada la base de datos, configure los datos (en caso de no ejecutar la creación de usuario para la base de datos),
en el archivo **config.php** ubicado en la raíz.

Para actualizar dependencias, ejecute `php composer install`.

### Acerca de

¬book se encuentra alojado en [Openshift](http://notbook-oswebapp.rhcloud.com)
¬book usa las siguientes librerías:

+ [PHPActiveRecord](http://www.phpactiverecord.org/)
+ [Smarty](http://www.smarty.net/)
+ [ParseDown](parsedown.org)
+ [DOMPDF](dompdf.github.com)
+ [NuSOAP](https://sourceforge.net/projects/nusoap/)
+ [jQuery](https://jquery.com/)
+ [MaterializeCSS](materializecss.com/)

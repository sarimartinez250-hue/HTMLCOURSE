<?php
//PHP es un lenguaje que se ejecuta en el servidor y permite:
//-Leer datos enviados desde el navegador
//-Tomar decisiones
//-Enviar al navegador la pagina que tu quieras
//-O redirigir a otras paginas
//PHP NO ES HTML PERO PUEDE GENERAR HTML, por eso un archivo se escribe: mi_archivo.php
//-Dentro de un archivo php se escribe:
//<?php -> apertura
//aca va el codigo
//? > -> cierre de codigo php (van juntos ambos signos pero si se coloca junto el editor piensa que aca es el cierre.)
//Y lo que se escribe fuera de esas etiquetas es HTML normal.

//En este caso solo lo estamos estudiando para poder entender el uso de ismap, mas adelante lo veremos muy a fondo.

//Entonces, como escribimos las coordenadas que ismap le envia?
//Vimos que cuando solo teniamos ismap, sin ningun php o algun otro lenguaje que se ejecuta en el servidor por medio de datos enviados desde el navegador,
// al clicar la imagen nos enviaba a una pagina en la cual decia que no habia sido encontrada, luego al crear una rchivo .php aca mismo en nuestra carpeta, al clicar cualquier parte del mapa
//si nos dirigia ya a una pagina en blanco pero en el titulo aparecia algo como por ejemplo: procesar_region.php?381,348.
//Se preguntaran que significa esos numeros despues del signo ?, pues son las coordenadas X e Y que el navegador le envio al servidor, comunicandole:
//Ey, el usuario hizo clic en las coordenadas x=381 e y=348, que pocede?, php verifica su codigo, las lee y decide donde lo enviara mediante los limites o parametros que nosotros 
//desarrolladores le hemos dado.
//El servidor las recibe mediante la indicacion:
//$query=$_SERVER[QUERY_STRING];
//Ahora nosotros como desarrolladores procedemos a separarlas mediante:
//$list($x, $y)=explode(",",$query)
//Ahora tenemos que:
//$x -> es la coordenada horizontal
//$y -> es la coordenada vertical
//OJO! NOSOTROS NO DEFINIMOS LAS COORDENADAS, NO ES COMO EN USEMAP Y MAP QUE NOSOTROS MEDIANTE UNA APLICACION O POR NOSOTROS DEFINIAMOS LAS COORDENADAS DE LAS AREAS
//CLICABLES, ACA NO! ES EL SERVIDOR QUIEN LAS CALCULA Y DEFINE Y VERIFICA SI ESTAN DENTRO DE ALGUN PARAMETRO QUE YA CASI DEFINIMOS.

//Ahora, ¿Cómo definir a donde enviar al usuario?
//ATENCION!
//Esto se hace con IF luego de haber creado los archivos HTML nosotros.
//Entonces ahora procedemos:

$query=$_SERVER["QUERY_STRING"];
list($x, $y)=explode(",",$query);

//Logica de regiones donde nosotros decidimos el rango, dividimos el mapa en las regiones que querramos
//BRASIL
if(
    $x >= 21 && $x <= 201 &&
    $y >= 345 && $y <= 438
){
    header("Location: brazil.html");
    exit;
}

//REGION NORTE
elseif(
    $x >= 49 && $x <= 497 &&
    $y >= 22 && $y <= 324 &&
    !($x >= 241 && $x <= 497 &&
    $y >= 223 && $y <= 324)
){
    header("Location: norte.html");
    exit;
}

//REGION CENTRO-OESTE
elseif(
    $x >= 241 && $x <= 517 &&
    $y >= 223 && $y <= 511 && 
    !($x >= 464 && $x <= 517 &&
    $y >= 223 && $y <= 405)
){
    header("Location: centro-oeste.html");
    exit;
}

//REGION NORDESTE
elseif(
    $x >= 464 && $x <= 689 && 
    $y >= 125 && $y <= 405 &&
    !($x >= 464 && $x <= 608 &&
    $y >= 348 && $y <= 405)
){
    header("Location: nordeste.html");
    exit;
}

//REGION SUDESTE
elseif(
    $x >= 388 && $x <= 608 &&
    $y >= 348 && $y <= 538 &&
    !($x>= 388 && $x <= 465 &&
    $y >= 491 && $y <=538)
){
    header("Location: sudeste.html");
    exit;
}

//REGION SUL
elseif(
    $x >= 316 && $x <= 465 &&
    $y >= 491 && $y <= 695
){
    header("Location: sur.html");
    exit;
}

//Si toca fuera del mapa
else{
    header("Location: sin_informacion.html");
exit;
}
?>
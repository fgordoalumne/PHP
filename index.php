<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Comparador de facturas</title>
    </head>
    <body>
       <!-- <form action="" id="nametelform">
            
            Energia Consumida: <input type="text" name="energia" id="energia" style="margin-right: 10px">
            Potencia Contratada: <input type="text" name="potencia" id="potencia" style="margin-right: 20px">
            Período de consumo: <input type="text" name="dias" id="dias" style="margin-right: 20px">
            <input type="submit" name="enviar" id="enviar" value="enviar"> <br> <br> -->
            
            <?php
                //phpinfo();
               include_once("Factura1.php");
               include_once("Factura2.php");
                /*//session_start(['cookie_lifetime' => 86400]);
                
                
                function runMyFunction($energia, $potencia, $dias) {
                    echo "hola mundo 1";
                    $factura1 = new Factura1($energia, $potencia, $dias);
                }
                
                if (isset($_GET['enviar'])) {
                    if(empty($_GET['energia']) || empty($_GET['potencia']) || 
                            empty($_GET['dias'])){
                        echo "hola mundo 2";
                    } else {
                        runMyFunction($_GET['energia'], $_GET['potencia'], 
                                $_GET['dias']);
                    }
                }*/
               
               $factura1 = new Factura1(176, 2.54, 30);
               $factura2 = new Factura2(176, 2.54, 30);
               $factura1->calcular_factura();
               echo "<br>";
               $factura2->calcular_factura();
               echo "<br>";
               if ($factura1->coste_kilovatio($factura1->calcular_subtotal1($factura1->calcular_importe_energia(), $factura1->calcular_importe_potencia()),
                       21) == $factura2->coste_kilovatio()) {
                   // considero que hay un error por el redondeo en las operaciones.
                   echo "No importa cual elijas, te costarán lo mismo";                   
               }else if($factura1->coste_kilovatio($factura1->calcular_subtotal1($factura1->calcular_importe_energia(), $factura1->calcular_importe_potencia()),
                       21) > $factura2->coste_kilovatio()){
                   echo "Elija el tipo de factura segundo";
               } else {
                   "Elija el tipo de factura primero";
               }
            ?>
           
        <!--</form>-->
    </body>
</html>
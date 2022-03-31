<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php 
    $numero_items=count($items_compra);
    print_r($factura[0]);
    echo "<br>";  
    echo "<br>"; 
    print_r($clinica[0]);
    echo "<br>";  
    echo "<br>";  
    print_r($cliente[0]);
    echo "<br>";  
    echo "<br>";  
    print_r($items_compra);
    ?>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <img src="storage/img/logo.jpeg"  />
                        </td>
                        <td>
                            <?php echo $clinica[0]->nombre_s ?><br />
                            Fecha de compra: <?php echo $factura[0]->fecha_ft ?><br />
                            ID Factura: <?php echo $clinica[0]->id_s; echo " - ".$factura[0]->id_ft ?><br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <h3><?php echo $clinica[0]->nombre_s ?></h3><br/>
                            <?php echo $clinica[0]->nombre_di; echo ", ".$clinica[0]->numero_di; echo ", ".$clinica[0]->cp_di; ?><br/>
                            <?php echo "Piso: ".$clinica[0]->piso_di; echo ", Puerta: ".$clinica[0]->puerta_di; ?><br/>
                            <?php echo "NIF: ".$clinica[0]->nif_s; ?><br/>
                            <?php echo "Telf: ".$clinica[0]->contacto1_tel; ?><br/>
                            
                        </td>
                        
                        <td>
                            <?php echo $cliente[0]->nombre_us; echo " ".$cliente[0]->apellido1_us;  ?><br />
                            <?php echo $cliente[0]->email_us ?><br />
                            <?php echo "Telf: ".$cliente[0]->contacto1_tel ?><br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Fecha de compra</td>
            <td></td>
            <td></td>
            <td><?php echo $factura[0]->fecha_ft ?></td>
            
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr class="heading">
            <td>Articulo</td>
            <td>Cantidad</td>
            <td>Precio unitario</td>
            <td>Precio total</td>
        </tr>
        @for ($i = 0; $i < $numero_items-1; $i++)
        <tr class="item">
            <td><?php echo $items_compra[$i]->nombre_art ?></td>
            <td><?php echo $items_compra[$i]->cantidad_dft ?></td>
            <td><?php echo $items_compra[$i]->precio_art ?>€</td>
            <td><?php echo ($items_compra[$i]->precio_art*$items_compra[$i]->cantidad_dft) ?>€</td>
        </tr>
        @endfor
        <tr class="item last">
            <td><?php echo $items_compra[$numero_items-1]->nombre_art ?></td>
            <td><?php echo $items_compra[$numero_items-1]->cantidad_dft ?></td>
            <td><?php echo $items_compra[$numero_items-1]->precio_art ?></td>
            <td><?php echo ($items_compra[$numero_items-1]->precio_art*$items_compra[$numero_items-1]->cantidad_dft) ?>€</td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td><b> Subtotal: <?php echo $factura[0]->total_ft ?>€</b></td>
        </tr>
        <tr class="heading">
            <td>Descuento</td>
            <td></td>
            <td>Porcentaje</td>
            <td>Precio descontado</td>
        </tr>
        <tr class="item">
            <td><?php echo $factura[0]->promocion_pro ?></td>
            <td></td>
            <td><?php echo $factura[0]->porcentaje_pro ?>%</td>
            <?php $descuento = bcdiv($factura[0]->total_ft*($factura[0]->porcentaje_pro/100),1,2);?>
            <td><?php echo "-"; echo $descuento;?>€</td>

        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td><b> Total: <?php echo $factura[0]->total_ft-($descuento) ?>€</b></td>
        </tr>
    </table>
    Estimado, <?php echo $cliente[0]->nombre_us;?>:<br>
    Nunca habría sido posible crecer, ni llegar hasta donde estamos, sin tu apoyo. 
    Gracias a tu confianza en nuestra tienda online, nos hemos convertido en uno de los ecommerce de referencia en nuestro sector. <br></br>
    <?php echo $clinica[0]->nombre_s ?>.
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <style>
        .invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid rgb(255, 255, 255);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: rgb(0, 0, 0);
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: rgb(241, 21, 21);
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: rgb(195, 248, 247);
    border-bottom: 1px solid rgb(45, 74, 73);
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid rgb(255, 255, 255);
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid rgb(255, 255, 255);
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }
    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}


/** RTL **/

.invoice-box.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.invoice-box.rtl table {
    text-align: right;
}

.invoice-box.rtl table tr td:nth-child(2) {
    text-align: left;
}

img {
    border-radius: 100%;
    height: 200px;
    width: 200px;
}
    </style>
    
    <?php 

    $numero_items=count($items_compra);
    $subtotal=0
    /*
    
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
    */
    ?>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <?php if (isset($download)) {
                                echo "<img src='https://cdn.discordapp.com/attachments/958393240795644014/960558200464228432/Logo.png' >";
                            }else {
                                echo "<img src='https://cdn.discordapp.com/attachments/958393240795644014/960558200464228432/Logo.png' >";
                            }
                            ?>
                            
                        </td>
                        <td>
                            <?php echo $clinica[0]->nombre_s ?><br />
                            Fecha de compra: <?php echo $factura[0]->fecha_ft ?><br />
                            ID Factura: <?php echo 'Compra '; echo " - ".$factura[0]->id_ft ?><br />
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
            <?php $subtotal=$subtotal+($items_compra[$i]->cantidad_dft*$items_compra[$i]->precio_art)?>
        </tr>
        @endfor
        <tr class="item last">
            <td><?php echo $items_compra[$numero_items-1]->nombre_art ?></td>
            <td><?php echo $items_compra[$numero_items-1]->cantidad_dft ?></td>
            <td><?php echo $items_compra[$numero_items-1]->precio_art ?></td>
            <td><?php echo ($items_compra[$numero_items-1]->precio_art*$items_compra[$numero_items-1]->cantidad_dft) ?>€</td>
            <?php $subtotal=$subtotal+($items_compra[$numero_items-1]->cantidad_dft*$items_compra[$numero_items-1]->precio_art)?>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td><b> Subtotal: <?php echo $subtotal ?>€</b></td>
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
            <?php $descuento = $factura[0]->porcentaje_pro/100*$subtotal?>
            <td><?php echo "-"; echo bcdiv($descuento,1,2);?>€</td>

        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td><b> Total: <?php echo $factura[0]->total_ft ?>€</b></td>
        </tr>
    </table>
    Estimado, <?php echo $cliente[0]->nombre_us;?>:<br>
    Nunca habría sido posible crecer, ni llegar hasta donde estamos, sin tu apoyo. 
    Gracias a tu confianza en nuestra tienda online, nos hemos convertido en uno de los ecommerce de referencia en nuestro sector. <br></br>
    <?php echo $clinica[0]->nombre_s ?>.
    <br>
    <?php if (isset($download)) {
        # code...
    }else{

    ?>
    <br>
    <form action="/FacturaTienda/download" method="post">
        @csrf
        <input type="hidden" name="id_factura_tienda" value="<?php echo $factura[0]->id_ft?>">
        <input type="submit" value="Descargar">
    </form>
    <?php } ?>
</div>
</body>
</html>
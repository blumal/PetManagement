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
                            <?php echo $clinica[0]->name_clinic ?><br />
                            Fecha de compra: <?php echo $factura[0]->date_shop_invoice ?><br />
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
                            <h3><?php echo $clinica[0]->name_clinic ?></h3><br/>
                            <?php echo $clinica[0]->street_address; echo ", ".$clinica[0]->number_address; echo ", ".$clinica[0]->cp_address; ?><br/>
                            <?php echo $clinica[0]->floor_address; echo ", ".$clinica[0]->door_address; ?><br/>
                            <?php echo "NIF: ".$clinica[0]->nif_clinic; ?><br/>
                            <?php echo "Telf: ".$clinica[0]->number1_phone; ?><br/>
                            
                        </td>
                        
                        <td>
                            <?php echo $cliente[0]->firstname_user; echo " ".$cliente[0]->lastname1_user;  ?><br />
                            <?php echo $cliente[0]->mail_user ?><br />
                            <?php echo "Telf: ".$cliente[0]->number1_phone ?><br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Fecha de compra</td>
            <td></td>
            <td></td>
            <td><?php echo $factura[0]->date_shop_invoice ?></td>
            
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
            <td><?php echo $items_compra[$i]->name_product ?></td>
            <td><?php echo $items_compra[$i]->quantity_product_shop_invoice ?></td>
            <td><?php echo $items_compra[$i]->price_product ?>€</td>
            <td><?php echo ($items_compra[$i]->price_product*$items_compra[$i]->quantity_product_shop_invoice) ?>€</td>
        </tr>
        @endfor
        <tr class="item last">
            <td><?php echo $items_compra[$numero_items-1]->name_product ?></td>
            <td><?php echo $items_compra[$numero_items-1]->quantity_product_shop_invoice ?></td>
            <td><?php echo $items_compra[$numero_items-1]->price_product ?></td>
            <td><?php echo ($items_compra[$numero_items-1]->price_product*$items_compra[$numero_items-1]->quantity_product_shop_invoice) ?>€</td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td><b> Total compra: <?php echo $factura[0]->total_shop_invoice ?>€</b></td>
        </tr>
    </table>
    Estimado, <?php echo $cliente[0]->firstname_user;?>:<br>
    Nunca habría sido posible crecer, ni llegar hasta donde estamos, sin tu apoyo. 
    Gracias a tu confianza en nuestra tienda online, nos hemos convertido en uno de los ecommerce de referencia en nuestro sector. <br></br>
    <?php echo $clinica[0]->name_clinic ?>.
</div>
</body>
</html>
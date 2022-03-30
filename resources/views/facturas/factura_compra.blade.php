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
    print_r($factura[0]);
    echo "<br>";  
    echo "<br>"; 
    print_r($clinica[0]);
    echo "<br>";  
    echo "<br>";  
    print_r($cliente[0]);
    ?>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="storage/img/logo.jpeg" style="width: 100%; max-width: 300px" />
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
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <?php echo $clinica[0]->name_clinic ?><br/>
                            <?php echo $clinica[0]->street_address; echo ", ".$clinica[0]->number_address; echo ", ".$clinica[0]->cp_address; ?><br/>
                            <?php echo $clinica[0]->floor_address; echo ", ".$clinica[0]->door_address; ?><br/>
                        </td>

                        <td>
                            <?php echo $cliente[0]->firstname_user; echo " ".$cliente[0]->lastname1_user;  ?><br />
                            <?php echo $cliente[0]->mail_user ?><br />
                            john@example.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>

            <td>Check #</td>
        </tr>

        <tr class="details">
            <td>Check</td>

            <td>1000</td>
        </tr>

        <tr class="heading">
            <td>Item</td>

            <td>Price</td>
        </tr>

        <tr class="item">
            <td>Website design</td>

            <td>$300.00</td>
        </tr>

        <tr class="item">
            <td>Hosting (3 months)</td>

            <td>$75.00</td>
        </tr>

        <tr class="item last">
            <td>Domain name (1 year)</td>

            <td>$10.00</td>
        </tr>

        <tr class="total">
            <td></td>

            <td>Total: $385.00</td>
        </tr>
    </table>
</div>
</body>
</html>
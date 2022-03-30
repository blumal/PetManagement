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

    
    {{$factura}}
    <br>
    <br>

    <?php 
    print_r($factura[0]);
    echo "<br>";  
    echo "<br>"; 
    print_r($factura[0]->date_shop_invoice);
    echo "<br>";  
    echo "<br>";  
    print_r($clinica[0]->name_clinic);
    ?>

    <div class="row-c padding-s">
        <div class="column-2">
            <h2 class="padding-text">Factura</h2>
        </div>
        <div class="column-2">
            <center>
            <img src="storage/img/logo.jpeg"  alt="">
            </center>
        </div>
    </div>
    <div class="row-c padding-s">
        <div class="column-2">
            <h4 class="padding-text"><?php echo $clinica[0]->name_clinic ?></h6>
        </div>
    
    </div>
</body>
</html>
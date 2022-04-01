<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>
    

    
    @for ($i = 0; $i < count($facturas); $i++)

        <form action="FacturaClinica/view" method="post">
            @csrf
            Factura 1
            <input type="hidden" name="id_factura_clinica" value="<?php echo $facturas[$i]->id_fc?>">
            <input type="submit" value="Ver factura">
        </form>
        <br>

    @endfor
</body>
</html>
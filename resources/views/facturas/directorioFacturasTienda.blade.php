<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    
    @for ($i = 0; $i < count($facturas); $i++)
        
        <a href="{{url('Factura/view/'.$facturas[$i]->id_ft)}}" class="btn btn-primary" >Ver Factura <?php echo $facturas[$i]->id_ft ?></a>
        <br>
    @endfor
</body>
</html>
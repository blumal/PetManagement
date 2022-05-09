<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi cesta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style_cesta.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<div class="row">
    <h1 class="titulo">Su carrito</h1>
</div>
<div class="row">   
    <div style="padding: 0px 0px 20px 12%">
        @php
        $suma=0;
        if (is_null($array3)){
            return redirect()->to('/vistaprueba')->send();
        }
        $numbb = count($array3);
        print_r('Productos añadidos: '.$numbb);
        @endphp
    </div>
    <a href="{{ url('vistaprueba')}}" class="seguir">
        <p><b>Seguir comprando ></b></p>
    </a>
    <div class="row">
        <div class="box">
        <table class="tabla">
            <div class="one-column-top"></div>
            @foreach ($array3 as $datosprod)
            <?php
            $listainfo = DB::table('tbl_articulo_tienda')->select('*')->where('id_art','=',$datosprod)->get();
            // $cnt = DB::select('select count(id_art) as repetidos, id_art from tbl_articulo_tienda as E where id_art=? group by id_art',[$datosprod]);
            
            foreach ($listainfo as $info){
                ?>
                <div class="one-column">
                    {{-- <div class="three-column">
                        <p><img src="{{asset('storage').'/'.$info->foto_cami}}" width="100" class="zoom"></p>
                    </div> --}}

                    <div class="three-column">
                        <p style="padding-top: 50px"><b><?php echo $info->nombre_art;?></b></p>
                    </div>

                    <div class="three-column">
                        <p style="color: red; font-size:20px; padding: 50px 75px 0px 0px;"><b><?php echo $info->precio_art;?>€</b></p>
                    </div> 
                </div>
                <?php 
                
                $suma = $suma + $info->precio_art; ?>
                <?php } ?>
            @endforeach
            <?php $precio = $suma;
            ?>
        </table>
        </div>
    </div>
    <div class="row">
        <div class="total"><?php echo ('Total: '.$precio.'€');?></div>
    </div>

    <div class="one-column-bottom">
        <div class="pay">
            <form action="{{url('enviarDinero/'.$precio)}}" method="GET">
                <button class= "pagar" id="logout" type="submit" name="Pagar" value="Pagar"><i class="far fa-shopping-cart"> </i> Pagar</button>
            </form>
        </div>
        <div class="delete">
            <form action="{{url('carritovaciar')}}" method="GET">
                <button class= "vaciar" id="logout" type="submit" name="Clear" value="Clear">Vaciar Carrito</button>
            </form>
        </div>
    </div>


</div>

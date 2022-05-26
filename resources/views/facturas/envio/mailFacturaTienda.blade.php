<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<style>
    .previous_visits_button {
    padding: 10px 24px;
    border-radius: 30px;
    background-color: #1f2cc4;
    color: #ffffff;
    margin: 0 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.5s;
    border-color: #1f2cc4;
    }

    .previous_visits_button:hover {
    color: #ffffff;
    background-color: #000000;
    border-color: black;
    }
</style>
<body>
    <h1>Confirmación de compra</h1>
    <ul>
        <li>Fecha de compra: {{$datas[1]}}</li>
        <li>Hora de compra: {{$datas[0]}}</li>
        <li>Total de la compra: {{$datas[2]}}</li>
        
        @if ($datas[4]==1)
            <h3>Con esta compra has ganado un descuento en tu próxima visita</h3>
            <a href="http://localhost:8000/login/1">Haz click aqui para descubrir tu recompensa</a>
        @endif
        
    </ul>

    <form action="http://localhost:8000/FacturasTienda" method="get">
        Revisa tus últimas facturas en nuestra tienda
        <input class="previous_visits_button" type="submit" value="Ver factura">
    </form>

    <center>
        <h3>Gracias por la confianza</h3>
    </center>
    <TABLE style="WIDTH: 414px" cellSpacing="0" cellPadding="0" border="0">
        <TBODY>
            <TR>
                <TD width="300" style="FONT-SIZE: 10pt; FONT-FAMILY: Arial, sans-serif;line-height:14pt;" vAlign="bottom">
                    <STRONG><SPAN style="FONT-SIZE: 18pt; FONT-FAMILY: Arial, sans-serif; COLOR: #125aa3">Pet Management</SPAN></STRONG>
                    <BR>
                    <SPAN style="FONT-SIZE: 14pt; FONT-FAMILY: Arial, sans-serif; COLOR: #037edd">Animal Services</SPAN>
                </TD>
            </TR>

            <TR>
                <TD style="FONT-SIZE: 9pt; FONT-FAMILY: Arial, sans-serif; " align="top" colSpan="2">

                    <table style="WIDTH: 414px" cellSpacing="0" cellPadding="0" border="0">
                        <tr>
                            <td style="padding-right:0px" valign="top">
                                <a href="{logoURL}" target="_blank" rel="noopener"></a>
                            </td>
                            <td width="30" valign="top" style="FONT-SIZE: 9pt; FONT-FAMILY: Arial, sans-serif; line-height:11pt ">

                                <span style="color:#101010;"><strong style="color:#101010; display:table-cell; width:30px;">Telefono:</strong><BR></span>
                                <span style="color:#101010;"><strong style="color:#101010; display:table-cell; width:30px;">Movil:</strong><br></span>
                                <span style="color:#101010;"><strong style="color:#101010; display:table-cell; width:30px;">Email:</strong></span>
                                <span style="color:#101010;"><strong style="color:#101010; display:table-cell; width:30px;">Creditos:</strong></span>
                                <span style="color:#101010;">
                    <br><strong  style="color:#101010; display:table-cell; width:30px;"></strong></span>
                                </span>

                            </td>
                            <td valign="top" style="FONT-SIZE: 9pt; FONT-FAMILY: Arial, sans-serif; line-height:11pt ">

                                <span style="color:#101010;">+34 937 101 283<BR></span>
                                <span style="color:#101010;">+34 607 812 297<br></span>
                                <span style="color:#101010;">grouppetmanagement@gmail.com</span><br>
                                <span style="color:#101010;"> Ivan Aguinaga - Alfredo Blum<br></span>
                                <span style="color:#101010;"> Marc Diaz - Raul García<br></span>
                                <span style="color:#101010;"> Daniel Ruano - Gerard Gómez<br></span>
                                
                                
                                <br><a href="http://localhost:8000" target="_blank" rel="noopener" style=" text-decoration:none;"><strong style="color:#037edd; font-family:Arial, sans-serif;">www.petmanagement.com</strong></a>

                            </td>
                        </tr>
                    </table>

                </TD>
            </TR>
            <span style="color:#101010;">
                <br>Avenida America 3, 08371, Barcelona	
            </span>

        </TBODY>
    </TABLE>
</body>
</html>
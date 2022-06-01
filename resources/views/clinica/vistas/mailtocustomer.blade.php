<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>Mail</title>
</head>
<body>
    <h1>Recordatorio de cita </h1>
    <ul>
        <li>Nº cita: 000{{$lastid}}</li>
        <li>Fecha agendada: {{$datas['fecha_vi']}}</li>
        <li>Hora de visita: {{$datas['hora_vi']}}</li>
        <li>Motivo de la visita: {{$datas['asunto_vi']}}</li>
        <br/><br/>
    </ul><br/><br/><br/><br/><br/><br/><br/><br/>
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
                                <a href="{{asset('logoURL')}}" target="_blank" rel="noopener"></a>
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
                                
                                
                                <br><a href="https://animalservices.x10.mx/petman/public/" target="_blank" rel="noopener" style=" text-decoration:none;"><strong style="color:#037edd; font-family:Arial, sans-serif;">www.petmanagement.com</strong></a>

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
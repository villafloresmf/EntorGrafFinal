<?php 
    // comprobar usuario
//     boolean 
    $puede_alquilar = true;
//     boolean 
    $logueado = true;
//     ContenidoLogica 
    $cont = null;
    try {
//         HttpSession sesion = request.getSession();
//         UsuarioLogica 
        //$ul = (UsuarioLogica) sesion.getAttribute("usuario");
        //verificar que pueda alquilar o redirigir
//         String 
        $id = (String) request.getParameter("id");
//         int 
        $id_contenido = intval($id);
        $cont = ContenidoLogica::Buscar($id_contenido);
        if (is_null($cont)) {
            // contenido no encontrado
            throw new \Exception();
        }
        try {
            $ul.alquilar($cont);
        } catch (\Exception $ex) {
            //no puedo alquilar por falta de alquileres
            $puede_alquilar = false;
            if (is_null($ul)) {
                $logueado = false;
            }
        }
    } catch (\Exception $e) {
        header("Location: http://localhost/ECinemaFinal/Pages/index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Alquiler</title>
        <link rel='stylesheet' type='text/css' href='css/stylesWeb2.css'>
    </head>

    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- < ? include('cabecera.php'); ?>  -->
                <div id='cont_central'>
                    <!-- < ?php include("navBar.php") ?> -->
                    <div id='ventana_ver_contenido' align='center' class='columnaDer'>
            <div class='seccion'>
                <h2>Ver <?= cont.getNombre() ?></h2>
                <%
                    if (puede_alquilar) { //Puedo hacer un nuevo alquiler
                %>
                <div id='trailerpeli' class='detallesContenido'>
                    <div id='videocontenido' class='video'>
                        <% //url que contiene la localizacion del contenido multimedia para visualizar
                            String url = cont.getUrl();
                        %>
                        <object style="width:480px;height:270px;">
                            <param name='movie' value='<%= url %>?version=3&amp;hl=en_US'></param>
                            <param name='allowFullScreen' value='true'></param>
                            <param name='allowscriptaccess' value='always'></param>
                            <embed src='<%= url %>?version=3&amp;hl=en_US' type='application/x-shockwave-flash'
                                   width='480px' height='270px' allowscriptaccess='always'
                                   allowfullscreen='true'>
                            </embed>
                        </object>                                    
                    </div>
                </div>
                <%
                } else { //mensaje de no puedo alquilar por falta de alquileres
                    if (logueado) {
                %>
                <div class='recuadroMensaje'>
                    <h2>NUMERO MAXIMO DE ALQUILERES ALCANZADOS.</h2>
                    <h2>No cuenta con mas disponibilidad de alquileres.</h2>
                    <p style='text-align:center;'><br /><a href='index.jsp'>Ir a la paginas principal</a></p>
                </div>
                <% } else {%>
                <div class='recuadroMensaje'>
                    <h2>Debe iniciar sesion para alquilar un contenido.</h2>
                    <h2>Si no esta registrado, <a href='registrarUsuario.jsp'>haga click aqui</a></h2>
                    <p style='text-align:center;'><br /><a href='index.jsp'>Ir a la paginas principal</a></p>
                </div>
                <%
                    }
                   }
                %>
            </div>
                    </div>
                </div>
            </div>
            <? include('footer.php'); ?>
        </div>
    </body>
</html>
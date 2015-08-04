<?php
// comprobar usuario administrador

// $logOk = false;
// $usuariorLogica = new Negocio.UsuarioLogica();
// $sesion = request.getSession();
// if (sesion != null) {
// 	$object = sesion.getAttribute("usuario");
// 	if ($object != null) {
// 		$usuariorLogica = (java.Negocio.UsuarioLogica) $object;
// 		$logOk = true;
// 	}
// }
$logOk = false;
?>

<div id='login' class='columnaIzq'>

    <?php if ($logOk) { ?>
    <div class='recuadrosIzq' align='center'>
        <span class='listTops'>
        <h3>Datos De Usuario</h3>
        <p>Nombre: <b><?php //$usuariorLogica.getNombre() ?> </b></p>
        <?php // if ( !( $usuariorLogica.es_admin() ) ) { ?>
            <p>Plan Elegido: <b><?php // $usuariorLogica.getPlan().getDescripcion() ?></b></p>
            <p>» Uds tiene <b>disponbilidad</b> para:        
                <?php 
//                     $peliculaLogica = new PeliculaLogica();
//                     out.print("<br />- Ver <b>" + $usuariorLogica.getAlquileresRestantes($peliculaLogica) + "</b> Peliculas");
//                     $serieLogica = new SerieLogica();
//                     out.print("<br />- Ver <b>" + $usuariorLogica.getAlquileresRestantes($serieLogica) + "</b> Capitulos de Series");
                ?>
            </p>
        <? //} ?>
        <p> » <a href='registrarUsuario.jsp?proceso=modificar'>Modificar mis datos.</a></p>
        <p> » <a href='login' >Desconectar</a></p>
        </span>
    </div>
    <div class='recuadrosIzq' align='center'>
        <span class='listTops'>
        <h3>Menu</h3>
        <?php //if ($usuariorLogica.es_admin()) {?>
        <p> » <a href='seleccion_nuevo_contenido.jsp' >Alta Nuevo Contenido</a></p>
        <p> » <a href='estadisticas_planes.jsp' >Ver Estadisticas</a></p>
        <?php //} ?> 
        <p> » <a href='lista_de_contenidos.jsp?tipo=pelicula' >Ver Peliculas Disponibles</a></p>
        <p> » <a href='lista_de_contenidos.jsp?tipo=serie' >Ver Series Disponibles</a></p>
        </span>
    </div>
    <?php } else { ?>

    <div class='recuadrosIzq' align='center'>
        <a href="registrarUsuario.jsp" >
            <input type='submit' value='Registrarme' align='center' class='botns' />
        </a>
    </div>

    <div id='login' class='recuadrosIzq'>
        <span class='listTops'><h3>Login</h3></span>
        <form id='log_usuario' action='login'  method='post'>
            <p><b>Correo Electronico:</b></p>
            <p><input id='usuario' name='usuario' size='24' type='text' class='campo'/></p>
            <p><b>Password:</b></p>
            <p><input id='pass' name='pass' size='24' type='password' class='campo'/></td></tr>
            <p><input type='submit' value='Entrar' align='left' class='botns' /></p>
        </form>
    </div>
    <div class='recuadrosIzq' align='center'>
        <span class='listTops'>
         <h3>Menu</h3>
<!--         <p> » <a href='lista_de_contenidos.jsp?tipo=pelicula' >Ver Peliculas Disponibles</a></p> -->
<!--         <p> » <a href='lista_de_contenidos.jsp?tipo=serie' >Ver Series Disponibles</a></p> -->
        </span>
    </div>
    <?php } ?>
    <div id='topPeliculas' class='recuadrosIzq'>
        <span class='listTops'>
            <h3>Top 5 Peliculas Mas vistas</h3>
            <?php
//                 Collection<PeliculaLogica> peliculas = PeliculaLogica.GetAll();
//                 $limit = 1;
//                 foreach ( $peliculaLogica : peliculas) {
//                     out.println("<p>" + $limit + ". <a href='ver_contenido.jsp?id=" + $peliculaLogica.getID() + "'>" + $peliculaLogica.getNombre() + "</a></p>");
//                     $limit++;
//                     if ($limit == 6) {
//                         break;
//                     }
//                 }
            ?>
        </span>
    </div>
    <div id='topSeries' class='recuadrosIzq'>
        <span class='listTops'>
            <h3>Top 5 Series Mas vistas</h3>
            <?php
//                 Collection<SerieLogica> series = SerieLogica.GetAll();
//                 $limit = 1;
//                 for (SerieLogica sl : series) {
//                     out.println("<p>" + $limit + ". <a href='ver_contenido.jsp?id=" + sl.getID() + "'>" + sl.getNombre() + "</a></p>");
//                     $limit++;
//                     if ($limit == 6) {
//                         break;
//                     }
//                 }
            ?>
        </span>
    </div>
</div>
<?php 
//     boolean 
    $logOk = false;
//     Negocio.UsuarioLogica 
    $ul = new Negocio.UsuarioLogica();
//     HttpSession sesion = request.getSession();
/*
    if (sesion != null) {
        Object o = sesion.getAttribute("usuario");
        if (o != null) {
            ul = (java.Negocio.UsuarioLogica) o;
            logOk = true;
        }
    }
*/
//     String 
    $tipo = request.getParameter("tipo");
    
//     String 
    $titulo = null;
//     String 
    $modo = request.getParameter("modo");
    if (modo == null){
        $modo = "listado";
        $titulo = "Lista de " + $tipo + " disponibles";
    }else{
        $titulo = "Resultados de busqueda: " + request.getParameter("busqueda");
    }
//     String 
    $busqueda = request.getParameter("busqueda");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><%= titulo %></title>
        <link rel='stylesheet' type='text/css' href='css/stylesWeb2.css'>
    </head>
    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- < ? include('cabecera.php'); ?>  -->
                <div id='cont_central'>
                    <!-- < ?php include("navBar.php") ?> -->
                    <div id='ventana_lista_de_contenido' align='center' class='columnaDer'>

                        <div class='seccion'>

                            <h2><%= titulo %></h2>

                            <div id='detallesContenido' class='detallesContenido' align='center'>
                                <div id='lista_de_contenidos' class='lista_links'>
                                    <%
                                        // uso generics para reutilizar el codigo
                                        Collection< ? extends ContenidoLogica> contenidos;
                                        if (tipo.equalsIgnoreCase("pelicula")) {
                                                if (modo.equalsIgnoreCase("busqueda")) {
                                                    contenidos = PeliculaLogica.GetAll(busqueda);
                                                } else {
                                                    contenidos = PeliculaLogica.GetAll();
                                                }
                                            } else {
                                                if (modo.equalsIgnoreCase("busqueda")) {
                                                    contenidos = SerieLogica.GetAll(busqueda);
                                                } else {
                                                    contenidos = SerieLogica.GetAll();
                                                }                                           
                                            }

                                            if (contenidos != null && !contenidos.isEmpty()) {
                                                for (ContenidoLogica cont : contenidos) {
                                                    //si es administrador agrega la opcion para editar dicho contenido
                                                    if (logOk && ul.es_admin()) {
                                                        out.print("<a href='editar_contenido.jsp?id=" + cont.getID() + "' class='editar' title='Editar'></a>");
                                                    }
                                                    //obtener id, imagen, titulo y fecha estreno del contenido
                                                    out.print("<a href='ver_contenido.jsp?id=" + cont.getID() + "' title='Ver " + cont.getNombre() + "' ><img src='" + cont.getImagen() + "' />" + cont.getNombre() + "<br />");
                                                    Date fechaEstreno = cont.getFechaEstreno();
                                                    GregorianCalendar calendar = new GregorianCalendar();
                                                    calendar.setTime(fechaEstreno);
                                                    out.print("Fecha estreno: " + calendar.get(Calendar.DAY_OF_MONTH) + " / " + calendar.get(Calendar.MONTH) + " / " + calendar.get(Calendar.YEAR) + " </a>");
                                                }
                                            } else {
                                                out.print("<p>No se encontraron " + tipo + " disponibles</p>");
                                            }
                                    %>                    									
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <? include('footer.php'); ?>
        </div>
    </body>
</html>
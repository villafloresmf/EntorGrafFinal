<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-Cinema and TV Web</title>
<link rel='stylesheet' type='text/css' href='css/stylesWeb2.css' />
</head>
    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <jsp:include page="cabecera.jsp" />
                <div id='cont_central'>
                    <jsp:include page="menucostado.jsp" />
                    <div id='mas_vistos' class='columnaDer'>
                        <div id='top_titulo'>
                            Extrenos Peliculas
                        </div>

                        <div id='top' class='tops'>
                            <%
                                //obtengo e imprimo los extrenos de peliculas
                                Collection<PeliculaLogica> pels = PeliculaLogica.GetAll(new Date(), 4);
                                for (PeliculaLogica pl : pels){
                            %>
                            <div class='pelitops'>
                                    <a href='ver_contenido.jsp?id=<%= pl.getID() %>'>
                                    <img src='<%= pl.getImagen() %>' alt='<%= "img-" + pl.getNombre() %>' />
                                    <div class='cont transp'></div>
                                    <div class='titulo'><%= pl.getNombre() %></div>
                                    </a>
                            </div>
                            <% } %>
                        </div>
                    </div>
                </div>
            </div>
            <jsp:include page="copyright.html" />
        </div>
    </body>
</html>

<?php
namespace ECinema\Negocio {
	include_once ('PeliculaLogica.php');
	include_once ('CategoriaLogica.php');
	
	use ECinema\Negocio\PeliculaLogica;
	use ECinema\Negocio\CategoriaLogica;
	use ECinema\CrossCutting\ArrayCollection;

	// $input = json_decode(file_get_contents("php://input"));
	// doPost($input);
	
	class AltaContenido {
		
		public function doPost($input){
			$accion = $input->accion;

			//if (accion.equals("alta_cont")) {
			if ($accion == "alta_cont") {
				//$t_cont = request.getParameter("tipo");
				$t_cont = $input->tipo;
		
				// valido los campos
				/*
				 if (request.getParameter("titulo").isEmpty()) {
					String msjE = "El contenido debe tener un titulo";
					enviar_error(t_cont, msjE, "/alta_contenido.jsp", request, response);
					return;
					}
					*/
		
				//ContenidoLogica $contenidoLogica;
				if($t_cont == "pelicula") {
					// creo una pelicula
					try {
						$contenidoLogica = new PeliculaLogica();
						$contenidoLogica->setUrl($input->url);
					} catch (Exception $e) {
						$mensaje = $e->getMessage();
					}
				} else {
					$contenidoLogica = new SerieLogica();
				}
		
				$this->completar_contenido($input, $contenidoLogica);
		
				if ($t_cont == "serie"){
					// 			SerieLogica serie = (SerieLogica) $contenidoLogica;
					$serie = $contenidoLogica;
					try {
						$serie->validarMetadatos();
					} catch (\Exception $ex) {
						// 				enviar_error(t_cont, ex.getMessage(), "/alta_contenido.jsp", request, response);
						return;
					}
					// lo guardo temporalmente en la session
					// 			HttpSession sesion = request.getSession(true);
					// 			sesion.setAttribute("serie", serie);
					$_SESSION["serie"] = $serie; 
					// 			getServletContext().getRequestDispatcher("/alta_capitulo.jsp").forward(request, response);
				} else {
					//guardar_contenido($contenidoLogica, "/alta_contenido.jsp", request, response);
					$this->guardar_contenido($contenidoLogica);
				}
		
			}
			
			if ($accion === "alta_cap") {
// 				SerieLogica 
				$serie = null;
// 				HttpSession 
				$sesion = request.getSession();
				if (isset($sesion)) {
					//Recupera la serie guardada temporalmente en la session
					//$serie = (SerieLogica) $sesion.getAttribute("serie");
					$serie = $_SESSION["serie"];
				}
				if (is_null($serie)) {
					try {
// 						int 
						$id_padre = $input->titulo_serie_id;//Integer.parseInt(request.getParameter("ID_serie"));
// 						SerieLogica 
						$padre = SerieLogica::Buscar($id_padre);
						$serie = new SerieLogica($padre);
					} catch (\Exception $ex) {
// 						String 
						$msjE = "Serie no valida";
// 						String 
						$t_cont = request.getParameter("tipo");
						enviar_error($t_cont);//, msjE, "/alta_capitulo.jsp", request, response);
						return;
					}
				}
			
				//$this->completar_capitulo(request.getParameter("tipo"), "/alta_capitulo.jsp", $serie);//, request, response);
				$this->completar_capitulo($input, $serie);
				
				//quito el objeto temporal de la session
				$this->guardar_contenido($serie);//, "/alta_capitulo.jsp", request, response);
// 				$sesion.removeAttribute("serie");
				unset($_SESSION["serie"]);
			}
			
			if ($accion === "editar") {
// 				String 
				$t_cont = $input->tipo;//request.getParameter("tipo");
// 				int 
				$id_cont = intval($input->id); //Integer.parseInt(request.getParameter("id"));
// 				ContenidoLogica 
				$cont = null;
				if ($t_cont == "pelicula") {
					$cont = PeliculaLogica::Buscar($id_cont);
					$cont->setUrl($input->url /*request.getParameter("url")*/);
				} else {
					$cont = SerieLogica::Buscar($id_cont);
				}
				$this->completar_contenido($t_cont);//, "/editar_contenido.jsp", cont, request, response);
				$this->guardar_contenido($cont);//, "/editar_contenido.jsp", request, response);
			}
			
			if ($accion === "editar_cap") {
// 				String 
				$t_cont = $input->tipo;//request.getParameter("tipo");
// 				int 
				$id_cont = intval($input->id);//Integer.parseInt(request.getParameter("id"));
// 				ContenidoLogica 
				$cont = SerieLogica::Buscar($id_cont);
				$this->completar_capitulo($t_cont, "/editar_capitulo.jsp", $cont, request, response);
				$this->guardar_contenido($cont, "/editar_capitulo.jsp", request, response);
			}
			
			if ($accion === "borrar") {
// 				String 
				$t_cont = $input->tipo;//request.getParameter("tipo");
// 				int 
				$id_cont = intval($input->id);//Integer.parseInt(request.getParameter("id"));
// 				ContenidoLogica 
				$cont = null;
// 				boolean 
				$parent_delete = false;
// 				String 
				$target= "/editar_contenido.jsp";
				if (t_cont.equals("pelicula")) {
					$cont = PeliculaLogica::Buscar($id_cont);
				} else {
					if ($t_cont !== "capitulo") {
						$parent_delete = true;
						$target = "/editar_capitulo.jsp";
					}
					$cont = SerieLogica::Buscar($id_cont);
				}
				$cont->borrar($parent_delete);
				$this->guardar_contenido($cont, target, request, response);
			}

			//echo json_encode(array("resultado"=> $resultado));
			return;
		}
		
		
		// 	function completar_contenido(String t_cont, String target, ContenidoLogica cont, HttpServletRequest request, HttpServletResponse response)
		function completar_contenido($jsonObject,$cont)
		{
			try {
				$cont->setNombre($jsonObject->titulo);
				$cont->setSinopsis($jsonObject->sinopsis);
				try {
					// 				cont.setFechaEstreno(formatear_fecha(request.getParameter("dia"), request.getParameter("mes"), request.getParameter("anio")));
					$cont->setFechaEstreno(formatear_fecha($jsonObject->fechaEstreno));
				} catch (NumberFormatException $ex) {
					$msjE = "fecha de estreno no valida";
					$this->enviar_error(t_cont, msjE, target, request, response);
					return;
				}
				$cont->setImagen($jsonObject->img_portada);
				try {
					// 				cont.setDuracion(Integer.parseInt(request.getParameter("min")));
					$cont->setDuracion(intval($jsonObject->duracion));
				} catch (NumberFormatException $ex) {
					$msjE = "duracion no valida";
					$this->enviar_error(t_cont, msjE, target, request, response);
					return;
				}
					
				$cont->setTrailer($jsonObject->trailer);
				$cont->setActores($jsonObject->actores);
				$cont->setCategorias($this->formatear_categorias($jsonObject->categorias));
			} catch (\Exception $e) {
				throw $e;
			}
		}
		
		// 	function completar_capitulo(String $t_cont, String $target, ContenidoLogica serie, HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		function completar_capitulo($jsonObject,$serie) {
			try {
				$serie->setNombreCapitulo($jsonObject->titulo_cap);
				try {
					// 				serie.setFechaEstreno(formatear_fecha(request.getParameter("dia"), request.getParameter("mes"), request.getParameter("anio")));
					$serie->setFechaEstreno($this->formatear_fecha($jsonObject->fechaEstreno));
				} catch (NumberFormatException $ex) {
					$msjE = "fecha de estreno no valida";
					enviar_error(t_cont, msjE, target, request, response);
					return;
				}
				$serie->setImagen($jsonObject->img_cap);
				$serie->setTrailer($jsonObject->trailer);
				$serie->setUrl($jsonObject->url);
			} catch (\Exception $e) {
					
			}
		}
		
		// 	function guardar_contenido(ContenidoLogica cont, String target, HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		function guardar_contenido($cont) {
			$resultado = false;
			try {
				try {
					$cont->Save();
					//request.setAttribute("t_cont", $cont->getTipo().toString().toLowerCase());
					//redireccionar?
					//getServletContext().getRequestDispatcher("/mensaje_operacion_exitosa.jsp").forward(request, response);
					$resultado = true;
				} catch (\Exception $ex) {
					$msjE = $ex->getMessage();
					$ex.printStackTrace();
					if (is_null($msjE))
					{
						$msjE = "Error desconocido\n";
					}
					// 				enviar_error($cont->getTipo().toString().toLowerCase(), msjE, target, request, response);
				}
			} catch (\Exception $e) {
				throw $e;
			}
			return $resultado;
		}
		
		//return Date
		// 	private function formatear_fecha(String dia, String mes, String anio) {
		function formatear_fecha($date) {
			try {
				return DateTime::createFromFormat('d/m/Y',$date);
					
				// 			list($m, $d, $y) = explode("/", $date);
					
				// 			$cal = GregorianCalendar.getInstance();
				// 			$day = Integer.parseInt(dia);
				// 			$month = Integer.parseInt(mes);
				// 			$year = Integer.parseInt(anio);
				// 			$cal->set(year, month, day);
				// 			return cal->getTime();
					
			} catch (Exception $e) {
				throw new NumberFormatException();
			}
		}
		
		// 	private Collection<CategoriaLogica> formatear_categorias(String[] cats) {
		function formatear_categorias($cats) {
			// 		Collection<CategoriaLogica> categorias = new ArrayList<CategoriaLogica>();
			$categorias = new ArrayCollection();
			if ($cats != null){
				// 			for (String cat : cats) {
				foreach ($cats as $cat){
					try {
						$id_cat = intval($cat);
						$categoria = CategoriaLogica::Buscar($id_cat);
						$categorias->set($categoria->getID(),$categoria);
							
					} catch (NumberFormatException $ex) {
						print_r("Error agregando categoria\n");
					}
				}
			}
			return $categorias;
		}
		
		// 	function enviar_error(String t_cont, String msjE, String target, HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		function enviar_error($t_cont, $msjE, $target, $request, $response) {
			request.setAttribute("error", msjE);
			request.setAttribute("t_cont", t_cont);
			// 		RequestDispatcher rd = getServletContext().getRequestDispatcher(target);
			$rd = getServletContext().getRequestDispatcher(target);
			if (rd != null){
				if (!response.isCommitted()){
					response.resetBuffer();
					rd.forward(request, response);
				} else {
					System.err.printf("error en redireccion. target: %s Error original: %s\n", target, msjE);
				}
			} else {
				System.err.printf("error en redireccion. El RequestDispatcher es nulo. target: %s Error original: %s\n", target, msjE);
			}
		}
		
	}
}

?>
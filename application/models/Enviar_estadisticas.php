<?php

	class Enviar_estadisticas extends CI_Model {
		
		function __construct(){
			$this->load->database();
			date_default_timezone_set("America/Monterrey");
		}

		function registrar_visita(){
			// PaginaWeb de la Base de Datos
			$data_page_id = '';
			if (!$data_page_id == '') {
				// Se crean los datos a registrar
				$datestring = '%Y-%m-%d  %H:%i:%s';
				$fecha = mdate($datestring, now());
				$data = array(
					'date' => $fecha,
					'ip' => $_POST['user']['ip'],
					'pagina' => $_POST['user']['paginaActual'],
					'screenWidth' => $_POST['user']['screenWidth'],
					'screenHeight' => $_POST['user']['screenHeight'],
					'language' => $_POST['user']['language'],
					'vendor' => $_POST['user']['vendor'],
					'userAgent' => $_POST['user']['userAgent']
				);
				$this->db->insert($data_page_id.'_visitas', $data);
			}
		}

		function registrar_frecuencia(){
			// PaginaWeb de la Base de Datos
			$data_page_id = '';
			if (!$data_page_id == '') {
				// Creo el identificador de la visita
				$identificador = $_POST['user']['ip'].'(res:'.$_POST['user']['screenWidth'].'x'.$_POST['user']['screenHeight'].')'.$_POST['user']['userAgent'];

				// Traemos id si el usuario ya visitó anteriormente
				$query = 'SELECT idvisitas_frecuencia, cantidad_visitas FROM '.$data_page_id.'_frecuencia where key_visita = \''.$identificador.'\'';
				$consulta = $this->db->query($query)->result_array();
				if (!$consulta) { $es_nuevo = true; } else{ $es_nuevo = false; }
				$datestring = '%Y-%m-%d  %H:%i:%s';
				$fecha = mdate($datestring, now());
				if ($es_nuevo) {
					$data = array(
						'cantidad_visitas' => 1,
						'primera_visita' => $fecha,
						'ultima_pagina' => $_POST['user']['paginaActual'],
						'ip' => $_POST['user']['ip'],
						'screenWidth' => $_POST['user']['screenWidth'],
						'screenHeight' => $_POST['user']['screenHeight'],
						'key_visita' => $identificador
					);
					$this->db->insert($data_page_id.'_frecuencia', $data);
				} else {
					$cantidad_visitas = 
					$this->db->set('cantidad_visitas', intval($consulta[0]['cantidad_visitas']) + 1);
					$this->db->set('ultima_visita', $fecha);
					$this->db->set('ultima_pagina', $_POST['user']['paginaActual']);
					$this->db->where('idvisitas_frecuencia', intval($consulta[0]["idvisitas_frecuencia"]));
					$this->db->update($data_page_id.'_frecuencia');
				}
			}
		}
	}
?>
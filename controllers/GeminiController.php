<?php
/* ----------------------------------------------------------------------
 * app/plugins/ULAN/controllers/ImportController.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */

 require_once(__CA_MODELS_DIR__."/ca_entities.php");
 require_once(__CA_LIB_DIR__."/Search/EntitySearch.php");

class GeminiController extends ActionController {
	# -------------------------------------------------------
	/**
	 *
	 */
	protected $opo_config;		// plugin configuration file

	# -------------------------------------------------------
	# Constructor
	# -------------------------------------------------------
	/**
	 *
	 */
	public function __construct(&$po_request, &$po_response, $pa_view_paths=null) {
		// Set view path for plugin views directory
		if (!is_array($pa_view_paths)) { 
			$pa_view_paths = array(); 
		}
		$pa_view_paths[] = __CA_APP_DIR__."/plugins/gemini/themes/views";

		// Load plugin configuration file
		$this->opo_config = Configuration::load(__CA_APP_DIR__.'/plugins/gemini/conf/gemini.conf');

		parent::__construct($po_request, $po_response, $pa_view_paths);

		/*if (!$this->request->user->canDoAction('can_import_ulan')) {
			$this->response->setRedirect($this->request->config->get('error_display_url').'/n/3000?r='.urlencode($this->request->getFullUrlPath()));
			return;
		}

		// Load plugin stylesheet*/
		//MetaTagManager::addLink('stylesheet', __CA_URL_ROOT__."/app/plugins/gemini/themes/themes/css/gemini.css",'text/css');
		
	}
	# -------------------------------------------------------
	/**
	 *
	 */
	public function Index() {
		$o_search = new EntitySearch();
		$qr_result = $o_search->search('*'); 

		$this->view->setVar('entities', $qr_result);
		$this->view->setVar('labels', $this->opo_config->get('labels'));
		$this->view->setVar('attribute', $this->opo_config->get('attribute'));

		$this->render("index.php");
	}
	
	public function Profile() {
		//$obj = new ca_objects('123');
		//$obj-->setMode(ACCESS_WRITE);
		//$abc = $obj-->replaceAttribute(array('attr'=->'NewValue'), 'attr');
		//$obj-->update();

		//$AUTH_CURRENT_USER_ID = 1; 
		$this->view->setVar('labels', $this->opo_config->get('labels'));
		$this->view->setVar('attribute', $this->opo_config->get('attribute'));

		$id = $this->request->getParameter('idno', pString); 
		$o_entity = new ca_entities($id);

		//$o_entity->setMode(ACCESS_WRITE);	
		
		$this->view->setVar('idno', $id);
		$this->view->setVar('entity', $o_entity);			
		
		$this->render("profile.php");
	}

	public function ModifyBiography() {
		//$obj = new ca_objects('123');
		//$obj-->setMode(ACCESS_WRITE);
		//$abc = $obj-->replaceAttribute(array('attr'=->'NewValue'), 'attr');
		//$obj-->update();

		//$AUTH_CURRENT_USER_ID = 1; 
		$labels = $this->opo_config->get('labels');

		try {
			$attribute = $this->opo_config->get("attribute");

			$o_search = new EntitySearch();
			$qr_result = $o_search->search('*');

			$id = $this->request->getParameter('idno', pString); 
			$newBio = $this->request->getParameter('newBiography', pString); 

			$o_entity = new ca_entities($id);

			//$o_entity->setMode(ACCESS_WRITE);		
			
			$o_entity->replaceAttribute(array("$attribute" => $newBio), "$attribute");
		
			$o_entity->update();			

			$array = array("results" => $labels["t_success"]);
			
			$this->view->setVar('results', $array);

			$this->render("jsonresult.php");
		}
		catch (Exception $e) 
		{
			$array = array("results" => $labels["t_error"]);
			
			$this->view->setVar('results', $array);

			$this->render("jsonresult.php");
		}
		
	}	
	
	public function QueryToGemini() {		
		$APIKEY = $this->opo_config->get('APIKEY');
		$consulta = $this->request->getParameter('consulta', pString);

		$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=$APIKEY";

		$datos = [
		'contents' => [
			[
				'parts' => [
					[
						'text' => $consulta
					]
				]
			]
		]
		];

		$datosJSON = json_encode($datos);

		// Configura las opciones de la solicitud cURL
		$opciones = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => '',
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $datosJSON,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
			),
		);

		// Inicializa cURL y configura las opciones
		$curl = curl_init();
		curl_setopt_array($curl, $opciones);

		// Ejecuta la solicitud cURL
		$respGemini = curl_exec($curl);

		$respuesta = json_decode($respGemini,true);
		// Cierra la sesión cURL
		curl_close($curl);

		// Envia la respuesta en formato JSON		

		$array = array("results" => $respuesta['candidates'][0]['content']['parts'][0]['text']);
		
		$this->view->setVar('results', $array);
		
		$id = $this->request->getParameter('idno', pString); 		

		$o_entity = new ca_entities($id);

		//$o_entity->setMode(ACCESS_WRITE);	

		$this->view->setVar('idno', $id);

		$this->view->setVar('entity', $o_entity);	

		$this->render("jsonresult.php");
	}
}

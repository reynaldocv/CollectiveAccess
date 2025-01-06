<?php
/* ----------------------------------------------------------------------
 * historyMenuPlugin.php : implements editing activity menu - a list of recently edited items
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2009-2018 Whirl-i-Gig
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
 
	class GeminiPlugin extends BaseApplicationPlugin {
		# -------------------------------------------------------
		private $opo_config;
		# -------------------------------------------------------
		public function __construct($ps_plugin_path) {
			$this->description = _t('Acesso ao AI (gemini) do google para preencher dados (biografia) dos artistas.');
			$this->opo_config = Configuration::load($ps_plugin_path . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'consulthor.conf');

			parent::__construct();
			
		}
		# -------------------------------------------------------
		/**
		 * Override checkStatus() to return true - the history Menu plugin always initializes ok
		 */
		public function checkStatus() {
			return array(
				'description' => $this->getDescription(),
				'errors' => array(),
				'warnings' => array(),
				'available' => true
			);
		}
		# -------------------------------------------------------
		/**
		 * Record editing activity
		 */
		
		public function hookRenderMenuBar($pa_menu_bar) {
			if ($o_req = $this->getRequest()) {
			
				$va_menu_items['consulthor_query'] = array(
					'displayName' => 'Entidades',
					"default" => array(
						'module' => 'gemini', 
						'controller' => 'Gemini', 
						'action' => 'Index'
					)
				);	
				
				if (isset($pa_menu_bar['Gemini'])) {
					$pa_menu_bar['Gemini']['navigation'] = $va_menu_items;
				} else {
					$pa_menu_bar['Gemini'] = array(
						'displayName' => 'Gemini',
						'navigation' => $va_menu_items
					);
				}
			} 			
			return $pa_menu_bar;
		}
		# -------------------------------------------------------
		static function getRoleActionList() {
			
			return array();
		}
		
		# --
	}

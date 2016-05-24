<?php
class ControllerExtensionPrintingMethod extends Controller {
	private $error = array();


	public function index() {
		$this->load->language('extension/printing_method');
		 
		$this->document->setTitle($this->language->get('heading_title')); 

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_autoselect'] = $this->language->get('button_autoselect');

		$data['link_autoselect'] = $this->url->link('extension/printing_method/autoselect', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
		
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}

		$this->load->model('extension/extension');

		$extensions = $this->model_extension_extension->getInstalled('printing_method');
		
		foreach ($extensions as $key => $value) {
			if (!file_exists(DIR_APPLICATION . 'controller/printing_method/' . $value . '.php')) {
				$this->model_extension_extension->uninstall('printing_method', $value);
				
				unset($extensions[$key]);
			}
		}
		
		$data['extensions'] = array();
						
		$files = glob(DIR_APPLICATION . 'controller/printing_method/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				
				$this->load->language('printing_method/' . $extension);
	
				$action = array();
				
				if (!in_array($extension, $extensions)) {
					$action[] = array(
						'text' => $this->language->get('text_install'),
						'href' => $this->url->link('extension/printing_method/install', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL')
					);
				} else {
					$action[] = array(
						'text' => $this->language->get('text_edit'),
						'href' => $this->url->link('printing_method/' . $extension . '', 'token=' . $this->session->data['token'], 'SSL')
					);
								
					$action[] = array(
						'text' => $this->language->get('text_uninstall'),
						'href' => $this->url->link('extension/printing_method/uninstall', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL')
					);
				}
				
				
				
				$data['extensions'][] = array(
					'name'       => $this->language->get('heading_title'),
					'status'     => $this->config->get($extension . '_status') ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
					'sort_order' => $this->config->get($extension . '_sort_order'),
					'action'     => $action
				);
			}
		}

		$template = 'extension/printing_method.tpl';
		
		$data['extra_tabs'] = array();
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
	}

	public function autoselect() {

		$this->load->language('printing_method/autoselect');
		 
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting'); 

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_autoselect()) {

			$this->request->post['opentshirts_autoselect_enabled'] = !empty($this->request->post['enable_autoselect'])?1:0;
			unset($this->request->post['enable_autoselect']);
			$this->request->post['opentshirts_autoselect_quantities'] = $this->request->post['quantities'];
			unset($this->request->post['quantities']);
			$this->request->post['opentshirts_autoselect_descriptions'] = $this->request->post['descriptions'];
			unset($this->request->post['descriptions']);
			$this->request->post['opentshirts_autoselect_pm'] = $this->request->post['pm'];
			unset($this->request->post['pm']);
			$this->request->post['opentshirts_autoselect_title_text'] = $this->request->post['title_text'];
			unset($this->request->post['title_text']);

			$this->model_setting_setting->editSetting('opentshirts_autoselect', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_printing_methods'),
			'href'      => $this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/printing_method/autoselect', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form']	= $this->language->get('text_form');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['action'] = $this->url->link('extension/printing_method/autoselect', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL');	
		

		$data['text_add_quantity'] = $this->language->get('text_add_quantity');
		$data['text_increment'] = $this->language->get('text_increment');
		$data['text_enable_autoselect'] = $this->language->get('text_enable_autoselect');
		$data['text_autoselect_help'] = $this->language->get('text_autoselect_help');
		$data['text_quantity_break'] = $this->language->get('text_quantity_break');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_available_printing_methods'] = $this->language->get('text_available_printing_methods');
		$data['text_popup_title'] = $this->language->get('text_popup_title');

		
		
		$data['printing_methods'] = array();
						
		$files = glob(DIR_APPLICATION . 'controller/printing_method/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				
				$this->load->language('printing_method/' . $extension);
				
				$data['printing_methods'][] = array(
					'name'       => $this->language->get('heading_title'),
					'extension'  => $extension,
					'status'     => $this->config->get($extension . '_status'),
					'sort_order' => $this->config->get($extension . '_sort_order')
				);
			}
		}



		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$data['enable_autoselect'] = $this->request->post['enable_autoselect'];
		} elseif ($this->config->get('opentshirts_autoselect_enabled')!="") { 
			$data['enable_autoselect'] = $this->config->get('opentshirts_autoselect_enabled');
		} else {
			$data['enable_autoselect'] = 'on';
		}

		if (isset($this->request->post['quantities'])) {
			$data['quantities'] = $this->request->post['quantities'];
		} elseif ($this->config->get('opentshirts_autoselect_quantities')) { 
			$data['quantities'] = $this->config->get('opentshirts_autoselect_quantities');
		} else {
			$data['quantities'] = array('0','24');
		}

		if (isset($this->request->post['descriptions'])) {
			$data['descriptions'] = $this->request->post['descriptions'];
		} elseif ($this->config->get('opentshirts_autoselect_descriptions')) { 
			$data['descriptions'] = $this->config->get('opentshirts_autoselect_descriptions');
		} else {
			$data['descriptions'] = array('Less than 24','More than 24');
		}

		if (isset($this->request->post['title_text'])) {
			$data['title_text'] = $this->request->post['title_text'];
		} elseif ($this->config->get('opentshirts_autoselect_title_text')) { 
			$data['title_text'] = $this->config->get('opentshirts_autoselect_title_text');
		} else {
			$data['title_text'] = 'How many products will you need customized?';
		}

		

		if (isset($this->request->post['pm'])) {
			$data['pm'] = $this->request->post['pm'];
		} elseif ($this->config->get('opentshirts_autoselect_pm')) { 
			$data['pm'] = $this->config->get('opentshirts_autoselect_pm');
		} else {
			$data['pm'] = array();
			foreach ($data['printing_methods'] as $key => $value) {
				if($value['extension']=="screenprinting")
					$data['pm'][$value['extension']] = array('','checked');
				else
					$data['pm'][$value['extension']] = array('checked','');
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['quantities'])) {
			$data['error_quantities'] = $this->error['quantities'];
		} else {
			$data['error_quantities'] = '';
		}

		$template = 'printing_method/autoselect.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
	}

	private function validate_autoselect() {
		if (!$this->user->hasPermission('modify', 'extension/printing_method')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!empty($this->request->post['enable_autoselect'])) {

			if(!isset($this->request->post['quantities']) || !is_array($this->request->post['quantities'])) {
				$this->error['quantities'] = $this->language->get('error_quantities');
			} else {
				foreach($this->request->post['quantities'] as $value) {
					if(!preg_match("/^[0-9]+$/",$value)) {
						$this->error['quantities'] = $this->language->get('error_quantities');
					}
				}
			}
			

			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
					
			if (!$this->error) {
				return true;
			} else {
				return false;
			}

		} else {
			return true;
		}

	}
	
	public function install() {
		$this->load->language('extension/printing_method');
		
		if (!$this->user->hasPermission('modify', 'extension/printing_method')) {
			$this->session->data['error'] = $this->language->get('error_permission'); 
			
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$this->load->model('extension/extension');
		
			$this->model_extension_extension->install('printing_method', $this->request->get['extension']);

			$this->load->model('user/user_group');
		
			$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'printing_method/' . $this->request->get['extension']);
			$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'printing_method/' . $this->request->get['extension']);

			require_once(DIR_APPLICATION . 'controller/printing_method/' . $this->request->get['extension'] . '.php');
			
			$class = 'ControllerPrintingMethod' . str_replace('_', '', $this->request->get['extension']);
			$class = new $class($this->registry);
			
			if (method_exists($class, 'install')) {
				$class->install();
			}
			
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	
	public function uninstall() {
		$this->load->language('extension/printing_method');
		
		if (!$this->user->hasPermission('modify', 'extension/printing_method')) {
			$this->session->data['error'] = $this->language->get('error_permission'); 
			
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));
		} else {		
			$this->load->model('extension/extension');
			$this->load->model('setting/setting');
				
			$this->model_extension_extension->uninstall('printing_method', $this->request->get['extension']);
		
			$this->model_setting_setting->deleteSetting($this->request->get['extension']);
		
			require_once(DIR_APPLICATION . 'controller/printing_method/' . $this->request->get['extension'] . '.php');
			
			$class = 'ControllerPrintingMethod' . str_replace('_', '', $this->request->get['extension']);
			$class = new $class($this->registry);
			
			if (method_exists($class, 'uninstall')) {
				$class->uninstall();
			}
		
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));	
		}			
	}
}
?>
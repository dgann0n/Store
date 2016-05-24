<?php   
class ControllerStudioHeader extends Controller {
	public function index() {
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$data['base'] = $this->config->get('config_ssl');
		} else {
			$data['base'] = $this->config->get('config_url');
		}
		
		$data['title'] = $this->document->getTitle();
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();	 
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		
		$this->language->load('studio/header');
		
		$data['theme'] = $this->config->get('opentshirts_theme');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = HTTPS_SERVER . 'image/';
		} else {
			$server = HTTP_SERVER . 'image/';
		}	
				
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}
		
		$data['name'] = $this->config->get('config_name');
		
		if ($this->config->get('opentshirts_config_logo') && file_exists(DIR_IMAGE . $this->config->get('opentshirts_config_logo'))) {
			$data['logo'] = $server . $this->config->get('opentshirts_config_logo');
		} else {
			$data['logo'] = '';
		}
		
		$data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
		$data['logged'] = $this->customer->isLogged();
		
		$data['action'] = $this->url->link('studio/home');

		if (!isset($this->request->get['route'])) {
			$data['redirect'] = $this->url->link('studio/home');
		} else {
			$get_data = $this->request->get;
			
			unset($get_data['_route_']);
			
			$route = $get_data['route'];
			
			unset($get_data['route']);
			
			$url = '';
			
			if ($get_data) {
				$url = '&' . urldecode(http_build_query($get_data, '', '&'));
			}			
			
			$data['redirect'] = $this->url->link($route, $url);
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['language_code'])) {

			$this->session->data['language'] = $this->request->post['language_code'];
		
			if (isset($this->request->post['redirect'])) {
				$this->response->redirect($this->request->post['redirect']);
			} else {
				$this->response->redirect($this->url->link('studio/home'));
			}
		}
				
		$data['text_language'] = $this->language->get('text_language');
		$data['language_code'] = $this->session->data['language'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = array();
		
		$results = $this->model_localisation_language->getLanguages();
		foreach ($results as $result) {
			if ($result['status']) {
				$data['languages'][] = array(
					'name'  => $result['name'],
					'code'  => $result['code'],
					'image' => $result['image']
				);	
			}
		}
		
		$data['menu'] = array();
		$opentshirts_home_button_link = $this->config->get('opentshirts_home_button_link');
		if(!empty($opentshirts_home_button_link)) {
			$data['menu'][] = array('link' => $this->config->get('opentshirts_home_button_link'), 'text' => $this->language->get('text_home'), 'separator' => false);
		} else {
			$data['menu'][] = array('link' => $this->url->link('common/home'), 'text' => $this->language->get('text_home'), 'separator' => false);
		}
		$data['menu'][] = array('link' => $this->url->link('account/account'), 'text' => $this->language->get('text_account'), 'separator' => $this->language->get('menu_separator'));
		$data['menu'][] = array('link' => $this->url->link('opentshirts/account/mydesigns'), 'text' => $this->language->get('text_my_designs'), 'separator' => $this->language->get('menu_separator'));
		$data['menu'][] = array('link' => $this->url->link('checkout/cart'), 'text' => $this->language->get('text_cart'), 'separator' => $this->language->get('menu_separator'));
		$data['menu'][] = array('link' => $this->url->link('checkout/checkout'), 'text' => $this->language->get('text_checkout'), 'separator' => $this->language->get('menu_separator'));
		$data['menu'][] = array('link' => $this->url->link('information/contact'), 'text' => $this->language->get('text_contact'), 'separator' => $this->language->get('menu_separator'));
				

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/header.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/header.tpl';
		} else {
			$template = 'default/template/studio/header.tpl';
		}

		$data['account_bar'] = $this->load->controller('studio/account_bar');
		
    	return $this->load->view($template,$data);
	} 	
}
?>
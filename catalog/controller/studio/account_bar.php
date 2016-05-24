<?php  
class ControllerStudioAccountBar extends Controller {
	
	public function index() {
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/account_bar.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/account_bar.tpl';
		} else {
			$template = 'default/template/studio/account_bar.tpl';
		}
		
		$data = array();
		
		return $this->load->view($template,$data);
	}

	public function refresh() {
		
		$this->language->load('studio/account_bar');
		if(($this->config->get('config_use_ssl') || $this->config->get('config_secure')) && !isset($this->request->server['HTTPS'])) {
			$data['text_welcome'] = sprintf($this->language->get('text_welcome_ssl'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/account', '', 'SSL'));
			$data['text_logged'] = sprintf($this->language->get('text_logged_ssl'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('studio/logout', '', 'SSL'));
		} else {
			$data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('studio/login', '', 'SSL'), $this->url->link('studio/register', '', 'SSL'));
			$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('studio/logout', '', 'SSL'));
		}

		$data['logged'] = $this->customer->isLogged();
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/account_bar_refresh.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/account_bar_refresh.tpl';
		} else {
			$template = 'default/template/studio/account_bar_refresh.tpl';
		}
		
		$this->response->setOutput($this->load->view($template,$data));
	}
	

}
?>
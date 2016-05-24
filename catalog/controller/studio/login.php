<?php 
class ControllerStudioLogin extends Controller {
	private $error = array();
	
	public function index() {

		if ($this->customer->isLogged()) {  
			$this->response->redirect($this->url->link('studio/login/welcome', '', 'SSL')); 
		}
	
		$this->language->load('studio/login');
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['error_login'] = $this->language->get('error_login');
		$data['button_login'] = $this->language->get('button_login');

									
		if (isset($this->request->post['email']) && isset($this->request->post['password']) && $this->validate()) {
			// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) !== false || strpos($this->request->post['redirect'], HTTPS_SERVER) !== false)) {
				$this->response->redirect(str_replace('&amp;', '&', $this->request->post['redirect']));
			} else {
				$this->response->redirect($this->url->link('studio/login/welcome', '', 'SSL')); 
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		
		$data['action'] = $this->url->link('studio/login', '', 'SSL');
		$data['register'] = $this->url->link('studio/register', '', 'SSL');
		$data['forgotten'] = $this->url->link('studio/forgotten', '', 'SSL');

    	// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
		if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) !== false || strpos($this->request->post['redirect'], HTTPS_SERVER) !== false)) {
			$data['redirect'] = $this->request->post['redirect'];
		} elseif (isset($this->session->data['redirect'])) {
      		$data['redirect'] = $this->session->data['redirect'];
			unset($this->session->data['redirect']);		  	
    	} else {
			$data['redirect'] = '';
		}

		if (isset($this->session->data['success'])) {
    		$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/login.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/login.tpl';
		} else {
			$template = 'default/template/studio/login.tpl';
		}
		
						
		$this->response->setOutput($this->load->view($template,$data));
  	}
  
  	private function validate() {
		if (!$this->customer->login($this->request->post['email'], $this->request->post['password'])) {
			$this->error['warning'] = $this->language->get('error_login');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}  	
  	}
	
	public function welcome() {
		
		$this->language->load('studio/login');
		
		if ($this->customer->isLogged()) {  
      		$data['welcome_close'] = $this->language->get('welcome_close');
			$data['welcome_text'] = sprintf($this->language->get('welcome_text'), $this->customer->getFirstName() . ' ' . $this->customer->getLastName());

	
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/welcome.tpl')) {
				$template = $this->config->get('config_template') . '/template/studio/welcome.tpl';
			} else {
				$template = 'default/template/studio/welcome.tpl';
			}
							
			$this->response->setOutput($this->load->view($template,$data));
    	}
		
  	}
}
?>
<?php 
class ControllerStudioSuccess extends Controller {  
	public function index() {
		
    	$this->language->load('studio/success');

    	$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
		
    	$data['button_continue'] = $this->language->get('button_continue');
		
		//$data['continue'] = $this->url->link('account/account', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/success.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/success.tpl';
		} else {
			$template = 'default/template/studio/success.tpl';
		}
						
		$this->response->setOutput($this->load->view($template,$data));				
  	}
}
?>
<?php 
class ControllerXmlSetting extends Controller { 
	public function index() {
		
		$data['settings'] = array();
    	$data['settings'][] = array('name' => 'config_language', 'value' => $this->config->get('config_language'));
		
		$this->response->addHeader("Content-type: text/xml");
		$this->response->setOutput($this->load->view('default/template/xml/setting.tpl',$data));
  	}
}
?>
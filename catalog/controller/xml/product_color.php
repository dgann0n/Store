<?php 
class ControllerXmlProductColor extends Controller { 
	public function index() {
		
		$this->load->language('xml/xml');
		
		$this->load->model('opentshirts/product_color');
		$data['colors'] = $this->model_opentshirts_product_color->getColors();
	
		if(empty($data['colors'])) {
			$error_warning = $this->language->get('no_product_colors');
		}
		
		if(isset($error_warning)) {
			$data['error_warning'] = $error_warning;
		} else {
			$data['error_warning'] = '';
		}
		
		$this->response->addHeader("Content-type: text/xml");
		$this->response->setOutput($this->load->view('default/template/xml/product_color.tpl',$data));
  	}
}
?>
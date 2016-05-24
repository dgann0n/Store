<?php 
class ControllerXmlDesignColor extends Controller { 
	public function index() {
		
		$this->load->language('xml/xml');

		$this->load->model('opentshirts/design_color');
		$data['colors'] = $this->model_opentshirts_design_color->getColors(array('filter_status'=>'1', 'sort' => 'sort', 'order' => 'ASC'));
	
		if(empty($data['colors'])) {
			$error_warning = $this->language->get('no_design_colors');
		}
		
		if(isset($error_warning)) {
			$data['error_warning'] = $error_warning;
		} else {
			$data['error_warning'] = '';
		}
		
		$this->response->addHeader("Content-type: text/xml");
		$this->response->setOutput($this->load->view('default/template/xml/design_color.tpl',$data));
  	}
}
?>
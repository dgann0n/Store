<?php  
class ControllerStudioZoom extends Controller {
	
	public function index() {
		
		$this->language->load('studio/zoom');
		
		$data['zoom_text_zoom_in'] = $this->language->get('zoom_text_zoom_in');
		$data['zoom_text_zoom_out'] = $this->language->get('zoom_text_zoom_out');
		$data['zoom_text_zoom_area'] = $this->language->get('zoom_text_zoom_area');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/zoom.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/zoom.tpl';
		} else {
			$template = 'default/template/studio/zoom.tpl';
		}
		
		return $this->load->view($template,$data);
		//$this->response->setOutput($this->load->view($template,$data));
	}
	

}
?>
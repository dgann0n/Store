<?php  
class ControllerStudioFooter extends Controller {
	protected function index() {

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/footer.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/footer.tpl';
		} else {
			$template = 'default/template/studio/footer.tpl';
		}
		
		$data = array();
		
		return $this->load->view($template,$data);
	}
}
?>
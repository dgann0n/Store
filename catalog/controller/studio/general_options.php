<?php  
class ControllerStudioGeneralOptions extends Controller {
	
	public function index() {
		
		$this->language->load('studio/general_options');
		
		$data['general_options_text_select_all'] = $this->language->get('general_options_text_select_all');
		$data['general_options_text_clear_selection'] = $this->language->get('general_options_text_clear_selection');
		$data['general_options_text_duplicate'] = $this->language->get('general_options_text_duplicate');
		$data['general_options_text_undo'] = $this->language->get('general_options_text_undo');
		$data['general_options_text_redo'] = $this->language->get('general_options_text_redo');
		$data['general_options_text_fit_to_area'] = $this->language->get('general_options_text_fit_to_area');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/general_options.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/general_options.tpl';
		} else {
			$template = 'default/template/studio/general_options.tpl';
		}
		
		return $this->load->view($template,$data);
	}
	

}
?>
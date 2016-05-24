<?php
class ControllerStudioToolbar extends Controller {

	public function index() {

		$this->language->load('studio/toolbar');

		$data['toolbar_text_add_clipart'] = $this->language->get('toolbar_text_add_clipart');
		$data['toolbar_text_add_text'] = $this->language->get('toolbar_text_add_text');
		$data['toolbar_text_select_product'] = $this->language->get('toolbar_text_select_product');
		$data['toolbar_text_save'] = $this->language->get('toolbar_text_save');
		$data['toolbar_text_export_image'] = $this->language->get('toolbar_text_export_image');
		$data['toolbar_text_import_template'] = $this->language->get('toolbar_text_import_template');

		if ( ! class_exists( 'User' ) ) {
			$this->load->library('user');
		}
		$this->user = new User($this->registry);
		$data['show_export_image'] = $this->user->isLogged();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/toolbar.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/toolbar.tpl';
		} else {
			$template = 'default/template/studio/toolbar.tpl';
		}

		return $this->load->view($template,$data);
	}

}
?>
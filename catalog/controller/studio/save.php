<?php
class ControllerStudioSave extends Controller {
	public function index() {

		if ( ! class_exists( 'User' ) ) {
			$this->load->library('user');
		}
		$this->user = new User($this->registry);

		$this->language->load('studio/save');

		if(!$this->customer->isLogged() && !$this->user->isLogged())
		{
			if(($this->config->get('config_use_ssl') || $this->config->get('config_secure')) && !isset($this->request->server['HTTPS'])) {
				$this->response->setOutput($this->language->get('text_ssl_log_in_first'));
				return;
			} else {

				$query_string = "1=1";

				if(isset($this->request->get['studio_id'])) {
					$query_string .= '&studio_id=' . $this->request->get['studio_id'];
				}

				if(isset($this->request->get['add'])) {
					$query_string .= '&add=' . $this->request->get['add'];
				}

				if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
					$this->session->data['redirect'] = $this->url->link('studio/save',$query_string,'SSL');
				} else {
					$this->session->data['redirect'] = $this->url->link('studio/save',$query_string);
				}

				$this->response->redirect($this->url->link('studio/login', '', 'SSL'));
			}
		}

		$data['entry_design_name'] = $this->language->get('entry_design_name');
		$data['text_save_design'] = $this->language->get('text_save_design');
		$data['text_saving_design'] = $this->language->get('text_saving_design');

		if($this->user->isLogged()) {
			$data['text_saved_successfully'] = $this->language->get('text_design_idea_saved_successfully');
		} else {
			$data['text_saved_successfully'] = $this->language->get('text_design_saved_successfully');
		}
		$data['text_saved_error'] = $this->language->get('text_saved_error');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/image/loading.gif')) {
			$data['loading_image'] = 'catalog/view/theme/'.$this->config->get('config_template') . '/image/loading.gif';
		} else {
			$data['loading_image'] = 'image/loading.gif';
		}

		$data['design_name'] = $this->language->get('text_my_custom_design'); //default name

		if(isset($this->request->get['studio_id']) && isset($this->session->data['studio_data'][$this->request->get['studio_id']]['id_composition'])) {
			$idc = $this->session->data['studio_data'][$this->request->get['studio_id']]['id_composition'];
			$this->load->model('opentshirts/composition');
			$total = $this->model_opentshirts_composition->getTotalCompositions(array('filter_id_composition' => $idc));
			if($total) {
				$idc_data = $this->model_opentshirts_composition->getComposition($idc);
				$data['design_name'] = $idc_data['name'];
			}
		}

		if(isset($this->request->get['add'])) {
			$data['add_after_save'] = true;
		} else {
			$data['add_after_save'] = false;
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/save.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/save.tpl';
		} else {
			$template = 'default/template/studio/save.tpl';
		}

		$this->response->setOutput($this->load->view($template,$data));
	}

	public function save_container() {

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/save_container.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/save_container.tpl';
		} else {
			$template = 'default/template/studio/save_container.tpl';
		}
		$data = array();

		return $this->load->view($template,$data);

	}
}
?>
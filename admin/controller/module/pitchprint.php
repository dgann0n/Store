<?php
class ControllerModulePitchprint extends Controller {
	private $error = array(); 

	public function index() {   
		$this->language->load('module/pitchprint');
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
			$this->model_setting_setting->editSetting('pitchprint', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/pitchprint', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['action'] = $this->url->link('module/pitchprint', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['api_label'] = $this->language->get('api_label');
		$data['secret_label'] = $this->language->get('secret_label');

		$data['inline_label'] = $this->language->get('inline_label');
		$data['maintain_images_label'] = $this->language->get('maintain_images_label');
		$data['show_onstartup_label'] = $this->language->get('show_onstartup_label');
		$data['custom_js_label'] = $this->language->get('custom_js_label');
		$data['enabled_label'] = $this->language->get('enabled_label');
		$data['disabled_label'] = $this->language->get('disabled_label');
		
		
		$data['button_save'] = $this->language-> get('button_save');
		
		if (isset($this->request->post['pitchprint_api_value'])) {
			$data['pitchprint_api_value'] = $this->request->post['pitchprint_api_value'];
		} else {
			$data['pitchprint_api_value'] = $this->config->get('pitchprint_api_value');
		}
		
		if (isset($this->request->post['pitchprint_secret_value'])) {
			$data['pitchprint_secret_value'] = $this->request->post['pitchprint_secret_value'];
		} else {
			$data['pitchprint_secret_value'] = $this->config->get('pitchprint_secret_value');
		}
		
		if (isset($this->request->post['pitchprint_inline_value'])) {
			$data['pitchprint_inline_value'] = $this->request->post['pitchprint_inline_value'];
		} else {
			$data['pitchprint_inline_value'] = $this->config->get('pitchprint_inline_value');
		}
		
		if (isset($this->request->post['pitchprint_maintain_images_value'])) {
			$data['pitchprint_maintain_images_value'] = $this->request->post['pitchprint_maintain_images_value'];
		} else {
			$data['pitchprint_maintain_images_value'] = $this->config->get('pitchprint_maintain_images_value');
		}
		
		if (isset($this->request->post['pitchprint_showonstartup_value'])) {
			$data['pitchprint_showonstartup_value'] = $this->request->post['pitchprint_showonstartup_value'];
		} else {
			$data['pitchprint_showonstartup_value'] = $this->config->get('pitchprint_showonstartup_value');
		}
		
		if (isset($this->request->post['pitchprint_custom_js_value'])) {
			$data['pitchprint_custom_js_value'] = $this->request->post['pitchprint_custom_js_value'];
		} else {
			$data['pitchprint_custom_js_value'] = $this->config->get('pitchprint_custom_js_value');
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_code'] = $this->language->get('help_code');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language-> get('button_cancel');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/pitchprint.tpl', $data));
	}

	public function install() {
		$this->load->model('setting/setting');
		$this->load->model('pitchprint/process');
		$this->model_pitchprint_process->install();

		$settings = $this->model_setting_setting->getSetting('pitchprint');
		$settings['installed'] = 1;
		$settings['pitchprint_api_value'] = "";
		$settings['pitchprint_secret_value'] = "";
		
		$settings['pitchprint_inline_value'] = "";
		$settings['pitchprint_maintain_images_value'] = true;
		$settings['pitchprint_showonstartup_value'] = false;
		$settings['pitchprint_custom_js_value'] = "";
		$this->model_setting_setting->editSetting('pitchprint', $settings);
	}

	public function uninstall() {
		$this->load->model('setting/setting');
		$settings = $this->model_setting_setting->getSetting('pitchprint');
		$settings['installed'] = 0;
		$this->model_setting_setting->editSetting('pitchprint', $settings);
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/pitchprint')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
}
?>
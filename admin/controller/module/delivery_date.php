<?php
class ControllerModuleDeliveryDate extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/delivery_date');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('delivery_date', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		$data['text_sunday'] = $this->language->get('text_sunday');
		$data['text_saturday'] = $this->language->get('text_saturday');
		$data['text_monday'] = $this->language->get('text_monday');
		$data['text_tuesday'] = $this->language->get('text_tuesday');
		$data['text_wednesday'] = $this->language->get('text_wednesday');
		$data['text_thursday'] = $this->language->get('text_thursday');
		$data['text_friday'] = $this->language->get('text_friday');
		$data['text_holiday'] = $this->language->get('text_holiday');
		
		$data['entry_skip_days'] = $this->language->get('entry_skip_days');
		$data['entry_shipping_link'] = $this->language->get('entry_shipping_link');
		$data['entry_days_rush'] = $this->language->get('entry_days_rush');
		$data['entry_days_free'] = $this->language->get('entry_days_free');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_holiday_day'] = $this->language->get('entry_holiday_day');
		$data['entry_holiday_month'] = $this->language->get('entry_holiday_month');
		$data['entry_reason'] = $this->language->get('entry_reason');
		$data['entry_rush_title'] = $this->language->get('entry_rush_title');
		$data['entry_free_title'] = $this->language->get('entry_free_title');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
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
			'href'      => $this->url->link('module/delivery_date', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/delivery_date', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['modules'] = array();
		
		if (isset($this->request->post['delivery_date_module'])) {
			$data['modules'] = $this->request->post['delivery_date_module'];
		} elseif ($this->config->get('delivery_date_module')) { 
			$data['modules'] = $this->config->get('delivery_date_module');
		}

		$data['delivery_date_skip'] = array();
		if (isset($this->request->post['delivery_date_skip'])) {
			$data['delivery_date_skip'] = $this->request->post['delivery_date_skip'];
		} elseif ($this->config->get('delivery_date_skip')) { 
			$data['delivery_date_skip'] = $this->config->get('delivery_date_skip');
		}
		
		$data['delivery_date_holidays'] = array();
		if (isset($this->request->post['delivery_date_holidays'])) {
			$data['delivery_date_holidays'] = $this->request->post['delivery_date_holidays'];
		} elseif ($this->config->get('delivery_date_holidays')) { 
			$data['delivery_date_holidays'] = $this->config->get('delivery_date_holidays');
		}

		
		if (isset($this->request->post['delivery_date_rush_title'])) {
			$data['delivery_date_rush_title'] = $this->request->post['delivery_date_rush_title'];
		} elseif ($this->config->get('delivery_date_rush_title')) { 
			$data['delivery_date_rush_title'] = $this->config->get('delivery_date_rush_title');
		} else {
			$data['delivery_date_rush_title'] = '<b><i>Rush</i></b> Shipping by';
		}

		if (isset($this->request->post['delivery_date_free_title'])) {
			$data['delivery_date_free_title'] = $this->request->post['delivery_date_free_title'];
		} elseif ($this->config->get('delivery_date_free_title')) { 
			$data['delivery_date_free_title'] = $this->config->get('delivery_date_free_title');
		} else {
			$data['delivery_date_free_title'] = '<b><i>Free</i></b> Shipping by';
		}
						
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		$template = 'module/delivery_date.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/delivery_date')) {
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
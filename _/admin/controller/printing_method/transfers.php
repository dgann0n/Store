<?php 
class ControllerPrintingMethodTransfers extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('printing_method/transfers');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('transfers', $this->request->post['data']);

			$this->load->model('printing_method/transfers');
			
			$this->model_printing_method_transfers->savePrice($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = $this->language->get('text_form');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['text_data_tab'] = $this->language->get('text_data_tab');

		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      =>  $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_printing_method'),
			'href'      => $this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('printing_method/transfers', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('printing_method/transfers', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/printing_method', 'token=' . $this->session->data['token'], 'SSL');	
				
		if (isset($this->request->post['data']['transfers_status'])) {
			$data['data']['transfers_status'] = $this->request->post['data']['transfers_status'];
		} else {
			$data['data']['transfers_status'] = $this->config->get('transfers_status');
		}
		
		if (isset($this->request->post['data']['transfers_sort_order'])) {
			$data['data']['transfers_sort_order'] = $this->request->post['data']['transfers_sort_order'];
		} else {
			$data['data']['transfers_sort_order'] = $this->config->get('transfers_sort_order');
		}

		if (isset($this->request->post['data']['transfers_description'])) {
			$data['data']['transfers_description'] = $this->request->post['data']['transfers_description'];
		} elseif ($this->config->get('transfers_description')) {
			$data['data']['transfers_description'] = $this->config->get('transfers_description');
		} else {
			$data['data']['transfers_description'] = $this->language->get('default_description');
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
						
		$template = 'printing_method/transfers.tpl';
		
		$data['extra_tabs'][] = $this->load->controller('printing_method/transfers/price_tab');
		$data['extra_tabs'][] = $this->load->controller('printing_method/transfers/colors_tab');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
			
		$this->response->setOutput($this->load->view($template,$data));
	}

	public function price_tab() {

		$this->load->language('printing_method/transfers');

		$this->load->model('printing_method/transfers');

		$price = $this->model_printing_method_transfers->getPrice();
		$quantities = $this->model_printing_method_transfers->getQuantities();
		
		$data['text_add_quantity'] = $this->language->get('text_add_quantity');
		$data['text_add_area'] = $this->language->get('text_add_area');
		$data['symbol_right'] = $this->currency->getSymbolRight();
		$data['symbol_left'] = $this->currency->getSymbolLeft();
		$data['text_minimum_quantity'] = $this->language->get('text_minimum_quantity');
		$data['text_increment'] = $this->language->get('text_increment');
		$data['text_areas'] = $this->language->get('text_areas');
		$data['text_error_row'] = $this->language->get('text_error_row');
		$data['text_sort'] = $this->language->get('text_sort');


		if (isset($this->request->post['quantities'])) {
			$data['quantities'] = $this->request->post['quantities'];
		} elseif (!empty($quantities)) { 
			$data['quantities'] = $quantities;
		} else {
			$data['quantities'] = array('0','12');
		}
		
		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($price)) { 
			$data['price'] = $price;
		} else {
			$data['price'] = array();
			$data['price'][0][0] = 1.5;
			$data['price'][0][1] = 1.4;
		}

		$data['areas'] = array();
		foreach($data['price']as $key=>$value) {
			$data['areas'][] = $key;
		}

		if (isset($this->session->data['error_quantities'])) {
			$data['error_quantities'] = $this->session->data['error_quantities'];

			unset($this->session->data['error_quantities']);
		} else {
			$data['error_quantities'] = '';
		}

		if (isset($this->session->data['error_price'])) {
			$data['error_price'] = $this->session->data['error_price'];

			unset($this->session->data['error_price']);
		} else {
			$data['error_price'] = '';
		}

		if (isset($this->session->data['error_areas'])) {
			$data['error_areas'] = $this->session->data['error_areas'];

			unset($this->session->data['error_areas']);
		} else {
			$data['error_areas'] = '';
		}
        
        $data['length_unit'] = $this->length->getUnit($this->config->get('config_length_class_id'));
		$template = 'printing_method/transfers_price.tpl';
			
		return array(
			'id'			=> 'tab-prices',
			'label'		=> $this->language->get('text_price_tab'),
			'content'	=> $this->load->view($template,$data)
		);

	}

	public function colors_tab() {

		$this->load->language('printing_method/transfers');
		
		$this->load->language('design_color/list');

		$this->load->model('design_color/design_color');

		$filters = array();
		$filters['sort'] = 'sort';
		$filters['order'] = 'ASC';
		

		$data['column_id_design_color'] = $this->language->get('column_id_design_color');
		$data['column_name'] = $this->language->get('column_name');
    	$data['column_hexa'] = $this->language->get('column_hexa');
    	$data['column_code'] = $this->language->get('column_code');
    	$data['column_sort'] = $this->language->get('column_sort');
		$data['column_status'] = $this->language->get('column_status');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_default'] = $this->language->get('text_default');

		$data['text_help_colors'] = $this->language->get('text_help_colors');

		if (isset($this->request->post['data']['transfers_colors'])) {
			$data['data']['transfers_colors'] = $this->request->post['data']['transfers_colors'];
		} elseif ($this->config->get('transfers_colors')) {
			$data['data']['transfers_colors'] = $this->config->get('transfers_colors');
		} else {
			$data['data']['transfers_colors'] = array();
		}
		
		
		$data['colors'] = array();

		$color_total = $this->model_design_color_design_color->getTotalColors($filters);

		$results = $this->model_design_color_design_color->getColors($filters);
		
    	foreach ($results as $result) {
			$data['colors'][] = array(
				'id_design_color'    => $result['id_design_color'],
				'name'      	=> $result['name'],
				'code'      	=> $result['code'],
				'isdefault'      	=> $result['isdefault'],
				'status'      	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'hexa'      	=> $result['hexa'],
				'sort'      	=> $result['sort'],
				'selected'      => in_array($result['id_design_color'], $data['data']['transfers_colors'])
			);
		}

		$template = 'printing_method/transfers_colors.tpl';
			
		return array(
			'id'			=> 'colors_tab',
			'label'		=> $this->language->get('text_colors_tab'),
			'content'	=> $this->load->view($template,$data),
		);

	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'printing_method/transfers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!isset($this->request->post['quantities']) || !is_array($this->request->post['quantities'])) {
			$this->error['error_quantities'] = $this->language->get('error_quantities');
			$this->session->data['error_quantities'] = $this->language->get('error_quantities');
		} else {
			foreach($this->request->post['quantities'] as $value) {
				if(!preg_match("/^[0-9]+$/",$value)) {
					$this->error['error_quantities'] = $this->language->get('error_quantities');
					$this->session->data['error_quantities'] = $this->language->get('error_quantities');
				}
			}
		}
		
		if(!isset($this->request->post['price']) || !is_array($this->request->post['price'])) {
			$this->error['error_price'] = $this->language->get('error_price');
			$this->session->data['error_price'] = $this->language->get('error_price');
		} else {
			foreach($this->request->post['price'] as $prices) {
				foreach($prices as $key=>$value) {
					if(!preg_match("/^[0-9]+(.[0-9]+)?$/",$value)) {
						$this->error['error_price'] = $this->language->get('error_price');
						$this->session->data['error_price'] = $this->language->get('error_price');
					}
					if(!preg_match("/^[0-9]+(.[0-9]+)?$/",$key)) {
						$this->error['error_areas'] = $this->language->get('error_areas');
						$this->session->data['error_areas'] = $this->language->get('error_areas');
					}
				}
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}

	}
	public function install() {

		$this->load->model('printing_method/transfers');
		
		$this->model_printing_method_transfers->install();

	}

	public function uninstall() {

		$this->load->model('printing_method/transfers');
		
		$this->model_printing_method_transfers->uninstall();

	}
}
?>
<?php
class ControllerProductManufacturer extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();
  	}
	
	public function insert() {
		$this->load->language('product/manufacturer');
		
		$this->load->model('product/manufacturer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_product_manufacturer->addManufacturer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('product/manufacturer');
		
		$this->load->model('product/manufacturer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_product_manufacturer->editManufacturer($this->request->get['id_manufacturer'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('product/manufacturer');
		
		$this->load->model('product/manufacturer');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id_manufacturer) {
				$this->model_product_manufacturer->deleteManufacturer($id_manufacturer);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}
	
	private function getList() {
		$this->load->language('product/manufacturer');
		
		$this->load->model('product/manufacturer');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_product_administration'),
			'href'      => $this->url->link('product/product', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);


		if (isset($this->request->post['selected'])) {
			$data['selected'] = $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		$results = $this->model_product_manufacturer->getManufacturers();
		$data['manufacturers'] = array();
		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('product/manufacturer/update', 'token=' . $this->session->data['token'] . '&id_manufacturer=' . $result['id_manufacturer'] , 'SSL')
			);

			$data['manufacturers'][] = array(
				'id_manufacturer'    => $result['id_manufacturer'],
				'name'      	=> $result['name'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_manufacturer'], $this->request->post['selected']),
				'action'        => $action
			);
		}

		
		$data['delete'] = $this->url->link('product/manufacturer/delete', 'token=' . $this->session->data['token'], 'SSL');
		$data['add_manufacturer'] = $this->url->link('product/manufacturer/insert', 'token=' . $this->session->data['token'] , 'SSL');
		
		$data['column_name'] = $this->language->get('column_name');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_add_manufacturer'] = $this->language->get('button_add_manufacturer');
		$data['text_no_results'] = $this->language->get('text_no_results');

		
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

		$data['token'] = $this->session->data['token'];

		$template = 'product/manufacturer/list.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
		
	}
		
	private function getForm() {
		$this->load->language('product/manufacturer');
		
		$this->load->model('product/manufacturer');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_product_administration'),
			'href'      => $this->url->link('product/product', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['entry_name'] = $this->language->get('entry_name');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
	
 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		
		if (!isset($this->request->get['id_manufacturer'])) {
			$data['action'] = $this->url->link('product/manufacturer/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('product/manufacturer/update', 'token=' . $this->session->data['token'] . '&id_manufacturer=' . $this->request->get['id_manufacturer'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('product/manufacturer', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['id_manufacturer']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$manufacturer_info = $this->model_product_manufacturer->getManufacturer($this->request->get['id_manufacturer']);
    	}
		

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($manufacturer_info)) {
			$data['name'] = $manufacturer_info['name'];
		} else {
			$data['name'] = '';
		}
						
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view('product/manufacturer/form.tpl',$data));
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'product/manufacturer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
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

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'product/manufacturer')) {
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
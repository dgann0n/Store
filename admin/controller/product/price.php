<?php
class ControllerProductPrice extends Controller {
	private $error = array();
	
  	public function price_tab() {
		
		$this->load->language('product/price');
		
		$this->load->model('product/color');
		$this->load->model('product/size');

		$data['price'] = array();
		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$this->load->model('product/product');
			$price = $this->model_product_product->getPrice($this->request->get['product_id']);
			
			$quantities = $this->model_product_product->getQuantities($this->request->get['product_id']);
			$upcharge = $this->model_product_product->getUpcharge($this->request->get['product_id']);
			
		}
		
		$data['text_matrix'] = $this->language->get('text_matrix');
		$data['text_add_quantity'] = $this->language->get('text_add_quantity');
		$data['color_groups'] = $this->model_product_color->getColorGroups();
		$data['sizes_upcharge'] = $this->model_product_size->getSizes(array('filter_apply_additional_cost' => '1', 'sort' => 'sort, description'));
		
		$data['symbol_right'] = $this->currency->getSymbolRight();
		$data['symbol_left'] = $this->currency->getSymbolLeft();
		$data['text_minimum_quantity'] = $this->language->get('text_minimum_quantity');
		$data['text_upcharge'] = $this->language->get('text_upcharge');
		$data['text_increment'] = $this->language->get('text_increment');


		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($price)) { 
			$data['price'] = $price;
		} else {
			$data['price'] = array();
		}

		if (isset($this->request->post['quantities'])) {
			$data['quantities'] = $this->request->post['quantities'];
		} elseif (!empty($quantities)) { 
			$data['quantities'] = $quantities;
		} else {
			$data['quantities'] = array();
		}
		
		if (isset($this->request->post['upcharge'])) {
			$data['upcharge'] = $this->request->post['upcharge'];
		} elseif (!empty($upcharge)) { 
			$data['upcharge'] = $upcharge;
		} else {
			$data['upcharge'] = array();
		}
		
		if (isset($this->session->data['error_quantities'])) {
			$data['error_quantities'] = $this->session->data['error_quantities'];
			unset($this->session->data['error_quantities']);
		} else {
			$data['error_quantities'] = '';
		}

		if (isset($this->session->data['error_upcharge'])) {
			$data['error_upcharge'] = $this->session->data['error_upcharge'];
			unset($this->session->data['error_upcharge']);
		} else {
			$data['error_upcharge'] = '';
		}

		if (isset($this->session->data['error_price'])) {
			$data['error_price'] = $this->session->data['error_price'];
			unset($this->session->data['error_price']);
		} else {
			$data['error_price'] = '';
		}
		
		return $this->load->view('product/price.tpl',$data);
  	}
			
}
?>
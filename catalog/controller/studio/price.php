<?php
class ControllerStudioPrice extends Controller {
	private $error = array();

	public function index() {

		$this->language->load('studio/price');

		$this->load->model('opentshirts/composition');
		$this->load->model('opentshirts/product_size');
		$this->load->model('opentshirts/product_color');
		$this->load->model('opentshirts/product');
		$this->load->model('opentshirts/price_product');
		$this->load->model('opentshirts/price_quote');


		$all_sizes = $this->model_opentshirts_product_size->getSizes();
		$all_colors = $this->model_opentshirts_product_color->getColors();

		$filters = array();

		if($this->validateStudioID()) {

			$studio_data = &$this->session->data['studio_data'][$this->request->post['price_studio_id']]; //make it short

			if (($this->request->server['REQUEST_METHOD'] == 'POST') &&  $this->validateAvailableProduct()) {

				//get distinct products sizes availables for this product
				$distinct_product_sizes = $this->model_opentshirts_product->getSizes($studio_data['id_product']);
				//get distinct products colors availables for this product
				$distinct_product_colors = $this->model_opentshirts_product->getColors($studio_data['id_product']);

				/* HEADER SIZES */
				//get upcharges by sizes for this product
				$product_sizes_upcharge = $this->model_opentshirts_price_product->getSizesUpcharge($studio_data['id_product']);
				//sizes header with upcharge
				$product_sizes_header = array();
				foreach($distinct_product_sizes as $id_product_size) {
					$upcharge = (isset($product_sizes_upcharge[$id_product_size]))?$this->currency->format($product_sizes_upcharge[$id_product_size]):0;
					$product_sizes_header[] = array(
						'name' => $all_sizes[$id_product_size]['initials'],
						'upcharge' => $upcharge
					);
				}
				/* END SIZES HEADER */


				if(isset($this->request->post['quantity_s_c'])) {
					$studio_data['quantity_s_c'] = $this->model_opentshirts_price_quote->cleanMatrix($this->request->post['quantity_s_c'],$studio_data['id_product']);
				} else {
					$studio_data['quantity_s_c'] = $this->model_opentshirts_price_quote->cleanMatrix(array(),$studio_data['id_product']);
				}

				/* start working with money $$$ */
				$product_total = 0;
				$product_upcharge_total = 0;
				if ($this->validateOrder()) {
					$amount_products = $this->model_opentshirts_price_quote->countProductsInMatrix($studio_data['quantity_s_c']);

					$color_groups_prices = $this->model_opentshirts_price_product->getColorGroupsPriceFromQuantity($studio_data['id_product'], $amount_products);
					foreach($studio_data['quantity_s_c'] as $id_product_color=>$array_sizes) {
						foreach($array_sizes as $id_product_size=>$quantity) {
							if($quantity) { //Only colors and sizes available for this product.

								//add to product price
								$product_total += $color_groups_prices[$all_colors[$id_product_color]["id_product_color_group"]] * $quantity;

								//add upcharge for larger sizes if needed
								if(isset($product_sizes_upcharge[$id_product_size])) {
									$product_total += $product_sizes_upcharge[$id_product_size] * $quantity;
									$product_upcharge_total += $product_sizes_upcharge[$id_product_size] * $quantity;
								}
							}
						}
					}

					$data['printing_html'] = $this->load->controller('printing_method/' . $studio_data['printing_method'].'/getHTML');

					$printing_total = $this->{'model_printing_method_' . $studio_data['printing_method']}->getPrintingTotal($this->request->post['price_studio_id']);

					$total_price = $product_total + $printing_total;
					$unit_price = $total_price / $amount_products;
				}
			}
		}


		if (isset($this->request->post['price_studio_id'])) {
			$data['price_studio_id'] = $this->request->post['price_studio_id'];
		} else {
			$data['price_studio_id'] = '';
		}

		if (isset($this->request->post['price_module_collapsed'])) {
			$data['price_module_collapsed'] = $this->request->post['price_module_collapsed'];
		} else {
			$data['price_module_collapsed'] = '1';
		}

		if (isset($total_price)) {
			$data['total_price'] =  $this->currency->format($total_price);
		} else {
			$data['total_price'] = $this->currency->format(0);
		}

		if (isset($amount_products)) {
			$data['amount_products'] = $amount_products;
		} else {
			$data['amount_products'] = 0;
		}

		if (isset($unit_price)) {
			$data['unit_price'] = $this->currency->format($unit_price);
		} else {
			$data['unit_price'] = $this->currency->format(0);
		}

		if (isset($product_upcharge_total)) {
			$data['product_upcharge_total'] = $this->currency->format($product_upcharge_total);
		} else {
			$data['product_upcharge_total'] = $this->currency->format(0);
		}

		if (isset($product_total)) {
			$data['product_total'] = $this->currency->format($product_total);
		} else {
			$data['product_total'] = $this->currency->format(0);
		}

		if (isset($studio_data['quantity_s_c'])) {
			$data['matrix_color_size_quantity'] = $studio_data['quantity_s_c'];
		} else {
			$data['matrix_color_size_quantity'] = array();
		}

		if (isset($distinct_product_sizes)) {
			$data['product_sizes'] = $distinct_product_sizes;
		} else {
			$data['product_sizes'] = array();
		}

		if (isset($distinct_product_colors)) {
			$data['product_colors'] = $distinct_product_colors;
		} else {
			$data['product_colors'] = array();
		}

		if (isset($product_sizes_header)) {
			$data['product_sizes_header'] = $product_sizes_header;
		} else {
			$data['product_sizes_header'] = array();
		}

		$data['all_colors'] = $all_colors;
		$data['all_sizes'] = $all_sizes;

		$data['text_total_price'] = $this->language->get('text_total_price');
		$data['text_product_price'] = $this->language->get('text_product_price');
		$data['text_number_products'] = $this->language->get('text_number_products');
		$data['text_price_per_product'] = $this->language->get('text_price_per_product');
		$data['text_upcharge_larger_size'] = $this->language->get('text_upcharge_larger_size');
		$data['text_product_total'] = $this->language->get('text_product_total');
		$data['text_total_price'] = $this->language->get('text_total_price');
		$data['text_save'] = $this->language->get('text_save');
		$data['text_sizes_and_colors'] = $this->language->get('text_sizes_and_colors');
		$data['text_quick_quote'] = $this->language->get('text_quick_quote');
		$data['text_select_sizes_and_colors'] = $this->language->get('text_select_sizes_and_colors');
		$data['text_dialog_title'] = $this->language->get('text_dialog_title');
		$data['text_quote_details'] = $this->language->get('text_quote_details');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_no_save'] = $this->language->get('button_no_save');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_recalculate'] = $this->language->get('button_recalculate');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['hide_matrix'])) {
			$data['hide_matrix'] = true;
		} else {
			$data['hide_matrix'] = false;
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/price.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/price.tpl';
		} else {
			$template = 'default/template/studio/price.tpl';
		}

		$output = $this->load->view($template,$data);
		if ( $this->request->server['REQUEST_METHOD'] == 'POST' ) {
			$this->response->setOutput($output);
		} else {
			return $output;
		}
	}

	public function add_to_cart() {
		$this->language->load('studio/price');

		$this->load->model('catalog/product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateAddCart()) {

			$studio_data = &$this->session->data['studio_data'][$this->request->post['price_studio_id']]; //make it short

			$product_id = $studio_data["id_product"];

			$product_info = $this->model_catalog_product->getProduct($product_id);

			foreach ($studio_data['quantity_s_c'] as $id_product_color => $sizes) {
				foreach ($sizes as $id_product_size => $quantity) {
					if($quantity) {

						$option = array(
						    'id_product_color' => $id_product_color,
						    'id_product_size' => $id_product_size,
						    'printing_method' => $studio_data['printing_method'],
						    'views' => $studio_data['views']
						);


						$this->cart->addPrintable($product_id, $quantity, $option, 0, $studio_data['id_composition']);

						$success = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $product_id), $product_info['name'], $this->url->link('checkout/cart'));
					}
				}
			}
		}

		if(!empty($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if(!empty($success)) {
			$data['success'] = $success;
		} else {
			$data['success'] = '';
		}

		$data['continue'] =  $this->url->link('checkout/cart');
		$data['button_continue'] =  $this->language->get('button_continue');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/cart.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/cart.tpl';
		} else {
			$template = 'default/template/studio/cart.tpl';
		}

		$json = array();
		$json['output'] = $this->load->view($template,$data);
		//$json['redirect'] =  $this->url->link('checkout/cart');

		$this->response->setOutput(json_encode($json));
		//$this->response->setOutput($this->load->view($template,$data));
	}

	private function validateAddCart() {
		//if price_studio_id is empty
		if (empty($this->request->post['price_studio_id']) || !isset($this->session->data['studio_data'][$this->request->post['price_studio_id']])) {
			$this->error['warning'] = $this->language->get('error_studio_id');
		} elseif (empty($this->session->data['studio_data'][$this->request->post['price_studio_id']]["id_product"])) {
			$this->error['warning'] = $this->language->get('error_product');
		} elseif (!is_array($this->session->data['studio_data'][$this->request->post['price_studio_id']]["views"])) {
			$this->error['warning'] = $this->language->get('error_printing_empty');
		} elseif (!is_array($this->session->data['studio_data'][$this->request->post['price_studio_id']]["quantity_s_c"])) {
			$this->error['warning'] = $this->language->get('error_matrix');
		} elseif (empty($this->session->data['studio_data'][$this->request->post['price_studio_id']]["printing_method"])) {
			$this->error['warning'] = $this->language->get('error_printing_method');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}



	private function validateStudioID() {
		//if price_studio_id is empty
		if (empty($this->request->post['price_studio_id']) || !isset($this->session->data['studio_data'][$this->request->post['price_studio_id']])) {
			$this->error['warning'] = $this->language->get('error_studio_id');
			$this->error['hide_matrix'] = true;
		} elseif (empty($this->session->data['studio_data'][$this->request->post['price_studio_id']]['printing_method'])) {
			$this->error['warning'] = $this->language->get('error_printing_method');
			$this->error['hide_matrix'] = true;
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	//validate if product is available to be ordered
	private function validateAvailableProduct() {

		$studio_data = &$this->session->data['studio_data'][$this->request->post['price_studio_id']]; //make it short

		//if price_id_product is not empty
		if (!isset($studio_data['id_product'])) {
			$this->error['warning'] = $this->language->get('error_product');
			$this->error['hide_matrix'] = true;
		///if product exists
		} elseif (!$this->model_opentshirts_product->getTotalProductsByID($studio_data['id_product'])) {
			$this->error['warning'] = $this->language->get('error_product');
			$this->error['hide_matrix'] = true;
		//if product price is setted up
		}else if ($this->model_opentshirts_price_product->getMinQuantity($studio_data['id_product'])===false) {
			$this->error['warning'] = $this->language->get('error_not_available');
			$this->error['hide_matrix'] = true;
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateOrder() {


		$studio_data = &$this->session->data['studio_data'][$this->request->post['price_studio_id']]; //make it short

		$this->load->model('printing_method/'.$studio_data['printing_method']);

		$amount_products = $this->model_opentshirts_price_quote->countProductsInMatrix($studio_data['quantity_s_c']);
		$product_minimum = $this->model_opentshirts_price_product->getMinQuantity($studio_data['id_product']);
		if ($amount_products==0) {
			$this->error['warning'] = $this->language->get('error_matrix');
		} elseif ($product_minimum>$amount_products) {
			$this->error['warning'] = sprintf($this->language->get('error_min_quantity'), $product_minimum);
		} elseif (!is_array($this->model_opentshirts_price_product->getColorGroupsPriceFromQuantity($studio_data['id_product'],$amount_products))) {
			$this->error['warning'] = $this->language->get('error_not_available');
		} else {
			$return_data = $this->{'model_printing_method_' . $studio_data['printing_method']}->validatePrinting($this->request->post['price_studio_id']);
			if(!empty($return_data)) {
				$this->language->load('printing_method/'.$studio_data['printing_method']);

				$this->error['warning'] = $this->language->get($return_data['warning_code']);

				if(isset($return_data['warning_code_params'])) {
					$params = array_merge(array(0 => $this->language->get($return_data['warning_code'])), $return_data['warning_code_params']);
					$this->error['warning'] = call_user_func_array('sprintf', $params);
				}
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function price_container() {

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/price_container.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/price_container.tpl';
		} else {
			$template = 'default/template/studio/price_container.tpl';
		}

		$data['price'] = $this->load->controller('studio/price');

		return $this->load->view($template,$data);

	}

}
?>
<?php  
class ControllerStudioProductColors extends Controller {
	private $error = array();

	public function index() {
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/product_colors_cont.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/product_colors_cont.tpl';
		} else {
			$template = 'default/template/studio/product_colors_cont.tpl';
		}
		
		$data['color_list'] = $this->load->controller('studio/product_colors/color_list');

		return $this->load->view($template,$data);
	}

	public function color_list() {

		$this->language->load('studio/product_colors');

		$data['product_colors'] = array();

		$data['text_product_colors'] = $this->language->get('text_product_colors');

		if($this->validateProductID()) {

			$this->load->model('opentshirts/product_color');
			$data['all_colors'] = $this->model_opentshirts_product_color->getColors();

			$this->load->model('opentshirts/product');
			//get distinct products colors availables for this product
			$data['product_colors'] = $this->model_opentshirts_product->getColors($this->request->post['product_id']);

		}
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/product_colors.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/product_colors.tpl';
		} else {
			$template = 'default/template/studio/product_colors.tpl';
		}

		$this->response->setOutput($this->load->view($template,$data));
	}

	private function validateProductID() {
		//if price_studio_id is empty
		if (empty($this->request->post['product_id'])) {
			return false;
		}
		return true;
	}


}
?>
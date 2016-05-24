<?php
class ControllerStudioHome extends Controller {
	public function index() {

		$this->language->load('studio/home');


		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/studio.swf')) {
			$data['studio_swf'] = 'catalog/view/theme/'.$this->config->get('config_template') . '/template/studio/studio.swf';
		} else {
			$data['studio_swf'] = 'catalog/view/theme/default/template/studio/studio.swf';
		}


		$data['idc'] = false;
		if (isset($this->request->get['idc']) && ( $this->customer->isLogged() ) ) {
			$this->load->model('opentshirts/composition');
			$filters = array();
			$filters['filter_editable'] = 1; //validate editable status
			$filters['filter_id_composition'] = $this->request->get['idc'];
			$filters['filter_id_author'] = $this->customer->getId();
			$total = $this->model_opentshirts_composition->getTotalCompositions($filters);
			if($total>=1) {
				$data['idc'] = $this->request->get['idc'];
			} else {
				$data['idc_error'] = $this->language->get('idc_error');
			}
    	}

		$data['import_idc'] = false;
		if (isset($this->request->get['import_idc'])) {
			$this->load->model('opentshirts/composition');
			$filters = array();
			$filters['filter_id_composition'] = $this->request->get['import_idc'];
			$total = $this->model_opentshirts_composition->getTotalCompositions($filters);
			if($total>=1) {
				$data['import_idc'] = $this->request->get['import_idc'];
			}
    	}

		$data['default_product'] = false;
		if($data['import_idc']===false && $data['idc']===false && isset($this->request->get['product_id']))
		{
			$this->load->model('opentshirts/product');
			$total = $this->model_opentshirts_product->getTotalProductsByID($this->request->get['product_id']);
			if($total>=1) {
				$data['default_product'] = $this->request->get['product_id'];
			}
		}


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/image/loading.gif')) {
			$data['loading_image'] = 'catalog/view/theme/'.$this->config->get('config_template') . '/image/loading.gif';
		} else {
			$data['loading_image'] = 'image/loading.gif';
		}

		$data['text_loading'] = $this->language->get('text_loading');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/home.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/home.tpl';
		} else {
			$template = 'default/template/studio/home.tpl';
		}

		$opentshirts_video_tutorial_embed = $this->config->get('opentshirts_video_tutorial_embed');
		if (empty($opentshirts_video_tutorial_embed)) {
			$data['opentshirts_video_tutorial_embed'] = '';
		} else {
			$data['opentshirts_video_tutorial_embed'] = $this->config->get('opentshirts_video_tutorial_embed');
		}

		$data['header'] = $this->load->controller('studio/header');
		$data['product_colors'] = $this->load->controller('studio/product_colors');
		$data['price_container'] = $this->load->controller('studio/price/price_container');
		$data['save_container'] = $this->load->controller('studio/save/save_container');
		$data['get_printing_methods'] = $this->load->controller('printing_method/modules/get_printing_methods');
		$data['list_clipart'] = $this->load->controller('studio/list_clipart');
		$data['list_template'] = $this->load->controller('studio/list_template');
		$data['list_product'] = $this->load->controller('studio/list_product');
		$data['toolbar'] = $this->load->controller('studio/toolbar');
		$data['zoom'] = $this->load->controller('studio/zoom');
		$data['footer'] = $this->load->controller('studio/footer');

		$data['general_options'] = $this->load->controller('studio/general_options');

		$this->response->setOutput($this->load->view($template,$data));
	}
}
?>
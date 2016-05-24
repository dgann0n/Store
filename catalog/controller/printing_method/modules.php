<?php  
class ControllerPrintingMethodModules extends Controller {

	public function get_printing_methods() {

		$this->load->model('extension/extension');

		$this->load->language('printing_method/modules');
		
		$sort_order = array(); 
		
		$results = $this->model_extension_extension->getExtensions('printing_method');
		
		foreach ($results as $key => $value) {
			$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
		}
		
		array_multisort($sort_order, SORT_ASC, $results);
		$data["printing_methods"] = array();

		$data["popup_title"] = $this->language->get('popup_title');
		$data["popup_title_autoselect"] = $this->language->get('popup_title_autoselect');
		

		$this->load->model('tool/image');

		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {

				$this->load->language('printing_method/' . $result['code']);
				//$this->load->model('printing_method/' . $result['code']);

				//print($result['code']);

				$data["printing_methods"][] = array(
					'code' => $result['code'],
					'title' => $this->language->get('title'),
					'description' => $this->config->get($result['code'] . '_description'),
					'image' => $this->model_tool_image->resize('data/printing_methods/' . $result['code'] . '/button.png', 200, 200)
				);
			}
		}

		$data["autoselect"] = false;

		if($this->config->get('opentshirts_autoselect_enabled')) {
			$data["autoselect"] = true;
			$data["quantities"] = $this->config->get('opentshirts_autoselect_quantities');
			$data["descriptions"] = $this->config->get('opentshirts_autoselect_descriptions');
			$data["pm"] = $this->config->get('opentshirts_autoselect_pm');
			$data["popup_title_autoselect"] = $this->config->get('opentshirts_autoselect_title_text');
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/printing_method/modules.tpl')) {
			$template = $this->config->get('config_template') . '/template/printing_method/modules.tpl';
		} else {
			$template = 'default/template/printing_method/modules.tpl';
		}

		
		return $this->load->view($template,$data);
	}
}
?>
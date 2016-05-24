<?php  
class ControllerStudioListTemplate extends Controller {
	
	public function index() {
		
		$this->language->load('studio/template');
		
		$data['template_text_categories'] = $this->language->get('template_text_categories');
		$data['template_text_search'] = $this->language->get('template_text_search');
		$data['template_text_title'] = $this->language->get('template_text_title');
		$data['link_more_template'] = $this->url->link('studio/list_template/getMore');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/image/loading.gif')) {
			$data['loading_image'] = 'front/view/theme/'.$this->config->get('config_template') . '/image/loading.gif';
		} else {
			$data['loading_image'] = 'image/loading.gif';
		}
		
		
		$data['template_keyword'] = '';
		
		$this->load->model('opentshirts/composition_category');	
		$categories = $this->model_opentshirts_composition_category->getCategoriesByParentId();
		$data['template_category'] = '';
		$data['categories'] = $categories;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/list_template.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/list_template.tpl';
		} else {
			$template = 'default/template/studio/list_template.tpl';
		}
		
		return $this->load->view($template,$data);
	}
	
	public function getMore() {
		
		$this->language->load('studio/template');
			
		$data['template_text_empty'] = $this->language->get('template_text_empty');	
		$data['template_text_show_more'] = $this->language->get('template_text_show_more');	
		
		$filters['sort'] = "RAND()";
		$filters['order'] = "ASC";
		$filters['filter_id_author'] = 0;
		$filters['filter_status'] = 1;

		//keyword
		if (!empty($this->request->request['template_keyword'])) {
      		$filters['filter_keyword'] = $this->request->request['template_keyword'];
			$filters['sort'] = "c.date_added";
		}		
		
		//category
		$categories = array();
		if (!empty($this->request->request['template_category'])) {
      		$filters['filter_id_category'] = $this->request->request['template_category'];
			$filters['sort'] = "c.date_added";
		}
		
		
		$this->load->model('opentshirts/composition');
		$templates = array();
		///get all template matching filters for pagination with no limits
		$total = $this->model_opentshirts_composition->getTotalCompositions($filters);
		
		$template_page = 1;
		if (isset($this->request->request['template_page'])) {
      		$template_page = $this->request->request['template_page'];
		}
		$data['template_page'] = $template_page;
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $template_page;
		$pagination->limit = 10;
		
		$filters['start'] = ( $pagination->page * $pagination->limit ) - $pagination->limit + 1;
		$filters['limit'] = $pagination->limit;
		
		$results = $this->model_opentshirts_composition->getCompositions($filters);
		$this->load->model('opentshirts/design');
		$this->load->model('tool/image');
		$data['templates'] = array();
		
    	foreach ($results as $result) {
			$design_results = $this->model_opentshirts_design->getDesigns(array("filter_id_composition" => $result['id_composition']));
			foreach ($design_results as $design_result) {
				
				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 140, 140);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', 140, 140);
				}
				
				$data['templates'][] = array(
					'id_template'    => $design_result['id_design'],
					'name'      	=> $result['name'],
					'image'      	=> 	$image
				);			
			}
		}
		
		$data['show_more'] = (bool)(($pagination->page * $pagination->limit) < $pagination->total);
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/more_template.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/more_template.tpl';
		} else {
			$template = 'default/template/studio/more_template.tpl';
		}
		
		$this->response->setOutput($this->load->view($template,$data));
	}
}
?>
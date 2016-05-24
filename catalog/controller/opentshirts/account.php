<?php
class ControllerOpentshirtsAccount extends Controller {
	private $error = array();

	public function mydesigns() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('opentshirts/account/mydesigns', '', 'SSL');

	  		$this->response->redirect($this->url->link('account/login', '', 'SSL'));
    	}

		$this->language->load('opentshirts/account');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_all'] = $this->language->get('text_all');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_empty_templates'] = $this->language->get('text_empty_templates');
		$data['text_empty_ordered'] = $this->language->get('text_empty_ordered');
		$data['text_edit_design'] = $this->language->get('text_edit_design');
		$data['text_new_design'] = $this->language->get('text_new_design');
		$data['text_remove'] = $this->language->get('text_remove');
		$data['text_promp_delete'] = $this->language->get('text_promp_delete');
		$data['text_templates'] = $this->language->get('text_templates');
		$data['text_ordered'] = $this->language->get('text_ordered');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['label_filter'] = $this->language->get('label_filter');

		$data['continue'] = $this->url->link('account/account', '', 'SSL');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_templates'),
			'href'      => $this->url->link('opentshirts/account/mydesigns', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

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

		$this->load->model('opentshirts/composition');
		$this->load->model('opentshirts/design');
		$this->load->model('tool/image');

		$filters = array();
		$filters['filter_id_author'] = $this->customer->getId();
		$filters['filter_editable'] = 1;
		$filters['sort'] = 'c.date_added';
		$filters['order'] = 'DESC';

		$results = $this->model_opentshirts_composition->getCompositions($filters);

		$data['templates'] = array();
		foreach ($results as $result) {

			$images = array();
			$design_results = $this->model_opentshirts_design->getDesigns(array("filter_id_composition" => $result['id_composition']));
			foreach ($design_results as $design_result) {

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['thumb'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 40, 40);
				} else {
					$image['thumb'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['large'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 200, 200);
				} else {
					$image['large'] = $this->model_tool_image->resize('no_image.jpg', 200, 200);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['original'] = HTTP_SERVER . 'image/data/designs/design_' . $design_result['id_design']. '/snapshot.png';
				} else {
					$image['original'] = '';
				}

				$images[] = $image;

			}
			$data['templates'][] = array(
				'link_remove'      => $this->url->link('opentshirts/account/delete_design', 'idc='.$result['id_composition']),
				'link_edit'      => $this->url->link('studio/home', 'idc='.$result['id_composition']),
				'link_import'      => $this->url->link('studio/home', 'import_idc='.$result['id_composition']),
				'name' => $result['name'],
				'images' => $images
				//'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$filters['filter_editable'] = 0;
		$results = $this->model_opentshirts_composition->getCompositions($filters);

		$data['ordered'] = array();
		foreach ($results as $result) {

			$images = array();
			$design_results = $this->model_opentshirts_design->getDesigns(array("filter_id_composition" => $result['id_composition']));
			foreach ($design_results as $design_result) {

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['thumb'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 40, 40);
				} else {
					$image['thumb'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['large'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 200, 200);
				} else {
					$image['large'] = $this->model_tool_image->resize('no_image.jpg', 200, 200);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['original'] = HTTP_SERVER . 'image/data/designs/design_' . $design_result['id_design']. '/snapshot.png';
				} else {
					$image['original'] = '';
				}

				$images[] = $image;

			}
			$data['ordered'][] = array(
				'link_import'      => $this->url->link('studio/home', 'import_idc='.$result['id_composition']),
				'name' => $result['name'],
				'images' => $images
				//'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}




		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/opentshirts/mydesigns.tpl')) {
			$template = $this->config->get('config_template') . '/template/opentshirts/mydesigns.tpl';
		} else {
			$template = 'default/template/opentshirts/mydesigns.tpl';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['footer'] = $this->load->controller('common/footer');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');

		$this->response->setOutput($this->load->view($template,$data));
	}

	public function delete_design() {

		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('opentshirts/account/mydesigns', '', 'SSL');

	  		$this->response->redirect($this->url->link('account/login', '', 'SSL'));
    	}

		$this->language->load('opentshirts/account');

		$this->load->model('opentshirts/composition');

		if (isset($this->request->get['idc']) && $this->validateDelete()) {

			$this->model_opentshirts_composition->deleteComposition($this->request->get['idc']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('opentshirts/account/mydesigns', '', 'SSL'));
		}

		$this->index();
  	}

	private function validateDelete() {
		if($this->model_opentshirts_composition->getTotalCompositions(array('filter_id_author' => $this->customer->getId(), 'filter_id_composition' => $this->request->get['idc']))!=1) {
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
<?php
class ControllerOpentshirtsCompositionCategory extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();
  	}
	
	public function insert() {
		$this->load->language('opentshirts/composition_category');
		
		$this->load->model('opentshirts/composition_category');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_opentshirts_composition_category->addCategory($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('opentshirts/composition_category');
		
		$this->load->model('opentshirts/composition_category');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_opentshirts_composition_category->editCategory($this->request->get['id_category'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('opentshirts/composition_category');
		
		$this->load->model('opentshirts/composition_category');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id_category) {
				$this->model_opentshirts_composition_category->deleteCategory($id_category);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}
	
	private function getList() {
		$this->load->language('opentshirts/composition_category');
		
		$this->load->model('opentshirts/composition_category');
		
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_composition_administration'),
			'href'      => $this->url->link('opentshirts/composition', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);


		if (isset($this->request->post['selected'])) {
			$data['selected'] = $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		$data['categories'] = $this->recursiveCategories($this->model_opentshirts_composition_category->getCategoriesByParentId());
		
		$data['delete'] = $this->url->link('opentshirts/composition_category/delete', 'token=' . $this->session->data['token'], 'SSL');
		$data['add'] = $this->url->link('opentshirts/composition_category/insert', 'token=' . $this->session->data['token'] , 'SSL');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_add'] = $this->language->get('button_add_category');
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

		$template = 'opentshirts/composition_category_list.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
		
	}
	
	private function recursiveCategories($categories, $level=0) {
		$category_data = array();
		foreach ($categories as $category) {
			$action = array();
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('opentshirts/composition_category/update', 'token=' . $this->session->data['token'] . '&id_category=' . $category['id_category'] , 'SSL')
			);		
			$indent = '';
			for($i=0; $i<$level; $i++) { 
				$indent .= "&nbsp;---&nbsp;"; 
			}

			$category_data[] = array(	
				'id_category' => $category['id_category'],
				'description' => $indent.$category['description'],
				'selected'    => isset($this->request->post['selected']) && in_array($category['id_category'], $this->request->post['selected']),
				'action' 	  => $action
			);
		
			$category_data = array_merge($category_data, $this->recursiveCategories($category['children'], $level+1));
		}	
		return $category_data;
	}
	
	private function getForm() {
		$this->load->language('opentshirts/composition_category');
		
		$this->load->model('opentshirts/composition_category');
		
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_composition_administration'),
			'href'      => $this->url->link('opentshirts/composition', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['text_root'] = $this->language->get('text_root');
		$data['text_form'] = $this->language->get('text_form');
		$data['tab_data'] = $this->language->get('tab_data');
				
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_parent'] = $this->language->get('entry_parent');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
	
 		if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = '';
		}

		
		if (!isset($this->request->get['id_category'])) {
			$data['action'] = $this->url->link('opentshirts/composition_category/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('opentshirts/composition_category/update', 'token=' . $this->session->data['token'] . '&id_category=' . $this->request->get['id_category'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('opentshirts/composition_category', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['id_category']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$category_info = $this->model_opentshirts_composition_category->getCategory($this->request->get['id_category']);
    	}
		
		$categories = $this->recursiveCategories($this->model_opentshirts_composition_category->getCategoriesByParentId(), 1);

		// Remove own id from list
		if (!empty($category_info)) {
			foreach ($categories as $key => $category) {
				if ($category['id_category'] == $category_info['id_category']) {
					unset($categories[$key]);
				}
			}
		}

		$data['categories'] = $categories;

		if (isset($this->request->post['parent_category'])) {
			$data['parent_category'] = $this->request->post['parent_category'];
		} elseif (!empty($category_info)) {
			$data['parent_category'] = $category_info['parent_category'];
		} else {
			$data['parent_category'] = '';
		}
		
		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (!empty($category_info)) {
			$data['description'] = $category_info['description'];
		} else {
			$data['description'] = '';
		}
						
		$template = 'opentshirts/composition_category_form.tpl';
		
		// for developer extensions that add additional tabs
		// expects an array objects of 'id', 'label', and 'content'
		$data['extra_tabs'] = array();
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
				
		$this->response->setOutput($this->load->view($template,$data));
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'opentshirts/composition_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if ((utf8_strlen($this->request->post['description']) < 2) || (utf8_strlen($this->request->post['description']) > 255)) {
			$this->error['description'] = $this->language->get('error_description');
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
		if (!$this->user->hasPermission('modify', 'opentshirts/composition_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	

  	public function category_tab() {
		
		$this->load->language('opentshirts/composition_category_tab');
		
		$this->load->model('opentshirts/composition_category');

		$data['selected'] = array();
		if (isset($this->request->get['id_composition']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$this->load->model('opentshirts/composition');

			$selected_categories = $this->model_opentshirts_composition->getCompositionCategories($this->request->get['id_composition']);
		}
		
		if (isset($this->request->post['selected_categories'])) {
			$data['selected_categories'] = $this->request->post['selected_categories'];
		} elseif (!empty($selected_categories)) { 
			$data['selected_categories'] = $selected_categories;
		} else {
			$data['selected_categories'] = array();
		}

		$data['categories'] = $this->model_opentshirts_composition_category->getCategoriesByParentId();
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_autoselect_parent'] = $this->language->get('text_autoselect_parent');
		$data['text_root'] = $this->language->get('text_root');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');

		$data['token'] = $this->session->data['token'];

		$template = 'opentshirts/composition_category_tab.tpl';
		
		return array (
			'id' => 'tab-categories',
			'label' => $this->language->get('text_tab_categories'),
			'content' => $this->load->view($template,$data)
		);
  	}
			
}
?>
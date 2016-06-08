<?php
class ControllerOpentshirtsComposition extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();

  	}
	
  	public function _list() {

    	$this->getList();
  	}
	
  	public function insert() {
		$this->load->language('opentshirts/composition_form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('opentshirts/composition');
		
		/*if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	
			$id_composition = $this->model_composition_composition->addComposition($this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
			
			if (isset($this->request->get['filter_id_composition'])) {
				$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
			}
			
			if (isset($this->request->get['filter_id_category'])) {
				$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
												
			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
			}
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->response->redirect($this->url->link('composition/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}*/
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('opentshirts/composition_form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('opentshirts/composition');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_opentshirts_composition->editComposition($this->request->get['id_composition'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_id_composition'])) {
				$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_id_category'])) {
				$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
												
			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
			}
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


			$this->response->redirect($this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		
		$this->load->language('opentshirts/composition_form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			$this->load->model('opentshirts/composition');
			
			foreach ($this->request->post['selected'] as $id_composition) {
				$this->model_opentshirts_composition->deleteComposition($id_composition);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_id_composition'])) {
				$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_id_category'])) {
				$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
												
			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
			}
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->response->redirect($this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {
		
		$this->load->language('opentshirts/composition_list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('opentshirts/composition');

		$filters = array();
		$filters['filter_id_author'] = 0;
		
		if (isset($this->request->get['filter_id_composition'])) {
			$filter_id_composition = $this->request->get['filter_id_composition'];
			$filters['filter_id_composition'] = $filter_id_composition;
		} else {
			$filter_id_composition = null;
		}
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
			$filters['filter_name'] = $filter_name;
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_id_category'])) {
			$filter_id_category = $this->request->get['filter_id_category'];
			$filters['filter_id_category'] = $filter_id_category;
		} else {
			$filter_id_category = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
			$filters['filter_status'] = $filter_status;
		} else {
			$filter_status = '';
		}

		if (isset($this->request->get['filter_keyword'])) {
			$filter_keyword = $this->request->get['filter_keyword'];
			$filters['filter_keyword'] = $filter_keyword;
		} else {
			$filter_keyword = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.date_added';
		}
		$filters['sort'] = $sort;

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		$filters['order'] = $order;
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit =  $this->config->get('config_limit_admin');
		}
		$filters['start'] = ($page - 1) * $limit;
		$filters['limit'] = $limit;
				
				
				
		$url = '';

		if (isset($this->request->get['filter_id_composition'])) {
			$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_id_category'])) {
			$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
											
		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
   		);
		$data['delete'] = $this->url->link('opentshirts/composition/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['insert'] = $this->url->link('opentshirts/composition/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['compositions'] = array();

		$composition_total = $this->model_opentshirts_composition->getTotalCompositions($filters);

		$results = $this->model_opentshirts_composition->getCompositions($filters);
		$this->load->model('opentshirts/composition_category');
		$this->load->model('opentshirts/design');
		$this->load->model('tool/image');
		
    	foreach ($results as $result) {
			$edit = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('opentshirts/composition/update', 'token=' . $this->session->data['token'] . '&id_composition=' . $result['id_composition'] . $url, 'SSL')
			);
			
			$cats = array();
			foreach($this->model_opentshirts_composition->getCompositionCategories($result['id_composition']) as $id_category)
			{
				$cats[] = $this->model_opentshirts_composition_category->getCategory($id_category);
			}
			
			$images = array();
			$design_results = $this->model_opentshirts_design->getDesigns(array("filter_id_composition" => $result['id_composition']));
			foreach ($design_results as $design_result) {
				
				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['thumb'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 40, 40);
				} else {
					$image['thumb'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['large'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 100, 100);
				} else {
					$image['large'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['original'] = HTTPS_CATALOG . 'image/data/designs/design_' . $design_result['id_design']. '/snapshot.png';
				} else {
					$image['original'] = '';
				}

				$images[] = $image;
				
			}

			
			$data['compositions'][] = array(
				'id_composition'    => $result['id_composition'],
				'name'      	=> $result['name'],
				'link'		=> HTTP_CATALOG."?route=studio/home&idc=".$result['id_composition'],
				'status'      	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'images'      	=> 	$images,
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'categories'    => $cats,
				'keywords'      => $this->model_opentshirts_composition->getCompositionKeywords($result['id_composition']),
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_composition'], $this->request->post['selected']),
				'edit'        => $edit
			);
		}
		
		$language_items = array(
			'text_list',
			'text_edit',
			'text_confirm_delete',
			'entry_name',
			'entry_id',
			'entry_status',
			'entry_keyword',
			'entry_category',
		);
		
		foreach ( $language_items as $language_item ) {
			$data[$language_item] = $this->language->get($language_item);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_id_composition'] = $this->language->get('column_id_composition');
		$data['column_name'] = $this->language->get('column_name');
    	$data['column_status'] = $this->language->get('column_status');
		$data['column_thumb'] = $this->language->get('column_thumb');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_categories'] = $this->language->get('column_categories');
		$data['column_keywords'] = $this->language->get('column_keywords');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_none'] = $this->language->get('text_none');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_insert'] = $this->language->get('button_add_composition');

		$data['token'] = $this->session->data['token'];

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

		$url = '';

		if (isset($this->request->get['filter_id_composition'])) {
			$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_id_category'])) {
			$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
											
		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=' .  'DESC';
		} else {
			$url .= '&order=' .  'ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['sort_composition'] = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . '&sort=c.id_composition' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . '&sort=c.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_id_composition'])) {
			$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_id_category'])) {
			$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
											
		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $composition_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($pagination->total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($pagination->total - $limit)) ? $pagination->total : ((($page - 1) * $limit) + $limit), $pagination->total, ceil($pagination->total / $limit));

		
		$data['filter_id_composition'] = $filter_id_composition;
		$data['filter_name'] = $filter_name;
		$data['filter_id_category'] = $filter_id_category;
		$data['filter_status'] = $filter_status;
		$data['filter_keyword'] = $filter_keyword;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$this->load->model('opentshirts/composition_category');

    	$data['categories'] = $this->model_opentshirts_composition_category->getCategoriesByParentId();
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'', 'description'=>$this->language->get('text_none'));
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		$template = 'opentshirts/composition_list.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view($template,$data));
  	}

  	private function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		 
		$data['text_form'] = $this->language->get('text_form');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_wait'] = $this->language->get('text_wait');
		$data['text_freq_keywords'] = $this->language->get('text_freq_keywords');
		$data['text_clear'] = $this->language->get('text_clear');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_keywords'] = $this->language->get('entry_keywords');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
			
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_data'] = $this->language->get('tab_data');

		$data['token'] = $this->session->data['token'];

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
		
 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
				
		$url = '';

		if (isset($this->request->get['filter_id_composition'])) {
			$url .= '&filter_id_composition=' . $this->request->get['filter_id_composition'];
		}
		
		if (isset($this->request->get['filter_id_category'])) {
			$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
											
		if (isset($this->request->get['filter_keyword'])) {
			$url .= '&filter_keyword=' . $this->request->get['filter_keyword'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
		
		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_composition_list'),
			'href'      => $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => '',				
			'separator' => ' :: '
		);

		if (!isset($this->request->get['id_composition'])) {
			$data['action'] = $this->url->link('opentshirts/composition/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('opentshirts/composition/update', 'token=' . $this->session->data['token'] . '&id_composition=' . $this->request->get['id_composition'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('opentshirts/composition/_list', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['id_composition'])) {
			
			$this->load->model('opentshirts/composition');
			$this->load->model('opentshirts/design');
			$this->load->model('product/product');
			$this->load->model('tool/image');
			
			$result = $this->model_opentshirts_composition->getComposition($this->request->get['id_composition']);	
			
			$images = array();
			$design_results = $this->model_opentshirts_design->getDesigns(array("filter_id_composition" => $this->request->get['id_composition']));
			foreach ($design_results as $design_result) {
				
				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['thumb'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 60, 60);
				} else {
					$image['thumb'] = $this->model_tool_image->resize('no_image.jpg', 60, 60);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['large'] = $this->model_tool_image->resize('data/designs/design_' . $design_result['id_design']. '/snapshot.png', 300, 300);
				} else {
					$image['large'] = $this->model_tool_image->resize('no_image.jpg', 300, 300);
				}

				if (file_exists(DIR_IMAGE . 'data/designs/design_' . $design_result['id_design']. '/snapshot.png')) {
					$image['original'] = HTTPS_CATALOG . 'image/data/designs/design_' . $design_result['id_design']. '/snapshot.png';
				} else {
					$image['original'] = '';
				}

				$images[] = $image;
			}
			
			$composition_info = array(
				'id_composition'    => $result['id_composition'],
				'name'    	   => $result['name'],
				'status'      	=> $result['status'],
				'keywords'      => implode(",",$this->model_opentshirts_composition->getCompositionKeywords($result['id_composition'])),
				'product'	   => $this->model_product_product->getProduct($result['product_id']),
				'images'		=> $images,
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}
				
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($composition_info)) {
			$data['name'] = $composition_info['name'];
		} else {
			$data['name'] = '';
		}
				
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($composition_info)) { 
			$data['status'] = $composition_info['status'];
		} else {
			$data['status'] = '';
		}	
		
		if (isset($this->request->post['keywords'])) {
			$data['keywords'] = $this->request->post['keywords'];
		} elseif (!empty($composition_info)) { 
			$data['keywords'] = $composition_info['keywords'];
		} else {
			$data['keywords'] = '';
		}	
		
		if (!empty($composition_info)) { 
			$data['images'] = $composition_info['images'];
		} else {
			$data['images'] = array();
		}	
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		$template = 'opentshirts/composition_form.tpl';
		
		$data['extra_tabs'] = array();
		
		$data['extra_tabs'][] = $this->load->controller('opentshirts/composition_category/category_tab');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view($template,$data));
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'opentshirts/composition')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
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
		if (!$this->user->hasPermission('modify', 'opentshirts/composition')) {
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
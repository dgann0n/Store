<?php
class ControllerDesignColorDesignColor extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();
  	}
	
  	public function _list() {

    	$this->getList();
  	}

  	public function insert() {
		$this->load->language('design_color/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design_color/design_color');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	
			$this->model_design_color_design_color->addColor($this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
			
			if (isset($this->request->get['filter_id_design_color'])) {
				$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
			}
			
			if (isset($this->request->get['filter_code'])) {
				$url .= '&filter_code=' . $this->request->get['filter_code'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('design_color/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design_color/design_color');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_design_color_design_color->editColor($this->request->get['id_design_color'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_id_design_color'])) {
				$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
			}
			
			if (isset($this->request->get['filter_code'])) {
				$url .= '&filter_code=' . $this->request->get['filter_code'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		
		$this->load->language('design_color/form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			$this->load->model('design_color/design_color');
			
			foreach ($this->request->post['selected'] as $id_design_color) {
				$this->model_design_color_design_color->deleteColor($id_design_color);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_id_design_color'])) {
				$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
			}
			
			if (isset($this->request->get['filter_code'])) {
				$url .= '&filter_code=' . $this->request->get['filter_code'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}
  	public function sorting() {
		
		$this->load->language('design_color/form');

		if (isset($this->request->post['sorting'])) {
			
			$this->load->model('design_color/design_color');
			
			$this->model_design_color_design_color->saveOrder($this->request->post['sorting']); 

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_id_design_color'])) {
				$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
			}
			
			if (isset($this->request->get['filter_code'])) {
				$url .= '&filter_code=' . $this->request->get['filter_code'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {
		
		$this->load->language('design_color/list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design_color/design_color');

		$filters = array();
		
		if (isset($this->request->get['filter_id_design_color'])) {
			$filter_id_design_color = $this->request->get['filter_id_design_color'];
			$filters['filter_id_design_color'] = $filter_id_design_color;
		} else {
			$filter_id_design_color = null;
		}
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
			$filters['filter_name'] = $filter_name;
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_code'])) {
			$filter_code = $this->request->get['filter_code'];
			$filters['filter_code'] = $filter_code;
		} else {
			$filter_code = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
			$filters['filter_status'] = $filter_status;
		} else {
			$filter_status = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'sort';
		}
		$filters['sort'] = $sort;

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
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

		if (isset($this->request->get['filter_id_design_color'])) {
			$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_code'])) {
			$url .= '&filter_code=' . $this->request->get['filter_code'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			'href'      => $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
   		);
		
		$langItems = array(
			'entry_id',
			'entry_code',
			'entry_name',
			'entry_status',
		);
		
		foreach ( $langItems as $langItem ) {
			$data[$langItem] = $this->language->get($langItem);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_id_design_color'] = $this->language->get('column_id_design_color');
		$data['column_name'] = $this->language->get('column_name');
    	$data['column_need_white_base'] = $this->language->get('column_need_white_base');
    	$data['column_hexa'] = $this->language->get('column_hexa');
    	$data['column_code'] = $this->language->get('column_code');
    	$data['column_sort'] = $this->language->get('column_sort');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_list'] = $this->language->get('text_list');
		
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_save_order'] = $this->language->get('button_save_order');
		$data['button_add'] = $this->language->get('button_add_color');
		$data['button_filter'] = $this->language->get('button_filter');
		
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['delete'] = $this->url->link('design_color/design_color/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['save_order'] = $this->url->link('design_color/design_color/sorting', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('design_color/design_color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		if (isset($this->request->get['filter_id_design_color'])) {
			$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_code'])) {
			$url .= '&filter_code=' . $this->request->get['filter_code'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['sort_id_design_color'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . '&sort=id_design_color' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_code'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$data['sort_need_white_base'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . '&sort=need_white_base' . $url, 'SSL');
		$data['sort_sort'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . '&sort=sort' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_id_design_color'])) {
			$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_code'])) {
			$url .= '&filter_code=' . $this->request->get['filter_code'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
		
		$data['colors'] = array();

		$color_total = $this->model_design_color_design_color->getTotalColors($filters);

		$results = $this->model_design_color_design_color->getColors($filters);
		
    	foreach ($results as $result) {
						
			$edit = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('design_color/design_color/update', 'token=' . $this->session->data['token'] . '&id_design_color=' . $result['id_design_color'] . $url, 'SSL')
			);
			
			
			$data['colors'][] = array(
				'id_design_color'    => $result['id_design_color'],
				'name'      	=> $result['name'],
				'code'      	=> $result['code'],
				'isdefault'      	=> $result['isdefault'],
				'status'      	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'need_white_base'      	=> ($result['need_white_base'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'hexa'      	=> $result['hexa'],
				'sort'      	=> $result['sort'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_design_color'], $this->request->post['selected']),
				'edit'        => $edit
			);
		}

		$pagination = new Pagination();
		$pagination->total = $color_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($pagination->total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($pagination->total - $limit)) ? $pagination->total : ((($page - 1) * $limit) + $limit), $pagination->total, ceil($pagination->total / $limit));

		$data['filter_id_design_color'] = $filter_id_design_color;
		$data['filter_name'] = $filter_name;
		$data['filter_code'] = $filter_code;
		$data['filter_status'] = $filter_status;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'', 'description'=>$this->language->get('text_none'));
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));
		

		$template = 'design_color/list.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view($template,$data));
  	}

  	private function getForm() {
		
		$this->document->addScript('view/javascript/jscolor/jscolor.js');
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = $this->language->get('text_form'); 
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_hexa'] = $this->language->get('entry_hexa');
		$data['entry_need_white_base'] = $this->language->get('entry_need_white_base');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['tab_data'] = $this->language->get('tab_data');
			
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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

 		if (isset($this->error['status'])) {
			$data['error_status'] = $this->error['status'];
		} else {
			$data['error_status'] = '';
		}

 		if (isset($this->error['hexa'])) {
			$data['error_hexa'] = $this->error['hexa'];
		} else {
			$data['error_hexa'] = '';
		}
				
		$url = '';

		if (isset($this->request->get['filter_id_design_color'])) {
			$url .= '&filter_id_design_color=' . $this->request->get['filter_id_design_color'];
		}
		
		if (isset($this->request->get['filter_code'])) {
			$url .= '&filter_code=' . $this->request->get['filter_code'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_design_color_list'),
			'href'      => $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);


		if (!isset($this->request->get['id_design_color'])) {
			$data['action'] = $this->url->link('design_color/design_color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('design_color/design_color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
		
		} else {
			$data['action'] = $this->url->link('design_color/design_color/update', 'token=' . $this->session->data['token'] . '&id_design_color=' . $this->request->get['id_design_color'] . $url, 'SSL');
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('design_color/design_color/update', 'token=' . $this->session->data['token'] . '&id_design_color=' . $this->request->get['id_design_color'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
		
		}
		
		$data['cancel'] = $this->url->link('design_color/design_color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['id_design_color']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$color = $this->model_design_color_design_color->getColor($this->request->get['id_design_color']);	
			
			$color_info = array(
				'id_design_color'	=> $color['id_design_color'],
				'name'      	=> $color['name'],
				'status'      	=> $color['status'],
				'need_white_base'      	=> $color['need_white_base'],
				'code'      	=> $color['code'],
				'hexa'   => $color['hexa']
			);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($color_info)) {
			$data['name'] = $color_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($color_info)) {
			$data['status'] = $color_info['status'];
		} else {
			$data['status'] = '0';
		}
		
		if (isset($this->request->post['need_white_base'])) {
			$data['need_white_base'] = $this->request->post['need_white_base'];
		} elseif (!empty($color_info)) {
			$data['need_white_base'] = $color_info['need_white_base'];
		} else {
			$data['need_white_base'] = '1';
		}

		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif (!empty($color_info)) {
			$data['code'] = $color_info['code'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->request->post['hexa'])) {
			$data['hexa'] = $this->request->post['hexa'];
		} elseif (!empty($color_info)) { 
			$data['hexa'] = $color_info['hexa'];
		} else {
			$data['hexa'] = 'FFFFFF';
		}
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		$template = 'design_color/form.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view($template,$data));
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'design_color/design_color')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if(empty($this->request->post['hexa']) || !preg_match("/^[a-fA-F0-9]{6}$/",$this->request->post['hexa'])) {
			$this->error['hexa'] = $this->language->get('error_hexa');
		}
		
		if($this->request->post['status']=="0" && $this->model_design_color_design_color->isDefault($this->request->get['id_design_color'])=="1") {
			$this->error['status'] = $this->language->get('error_status');
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
		if (!$this->user->hasPermission('modify', 'design_color/design_color')) {
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
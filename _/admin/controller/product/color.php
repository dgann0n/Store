<?php
class ControllerProductColor extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();
  	}
	
  	public function _list() {

    	$this->getList();
  	}
	
  	public function insert() {
		$this->load->language('product/color/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('product/color');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	
			$this->model_product_color->addColor($this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
			
			if (isset($this->request->get['filter_id_product_color'])) {
				$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
			}
			
			if (isset($this->request->get['filter_num_colors'])) {
				$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
			}
			
			if (isset($this->request->get['filter_id_product_color_group'])) {
				$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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

			$this->response->redirect($this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('product/color/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('product/color');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_product_color->editColor($this->request->get['id_product_color'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_id_product_color'])) {
				$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
			}
			
			if (isset($this->request->get['filter_num_colors'])) {
				$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
			}
			
			if (isset($this->request->get['filter_id_product_color_group'])) {
				$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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

			$this->response->redirect($this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		
		$this->load->language('product/color/form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			$this->load->model('product/color');
			
			foreach ($this->request->post['selected'] as $id_product_color) {
				$this->model_product_color->deleteColor($id_product_color);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_id_product_color'])) {
				$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
			}
			
			if (isset($this->request->get['filter_num_colors'])) {
				$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
			}
			
			if (isset($this->request->get['filter_id_product_color_group'])) {
				$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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

			$this->response->redirect($this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {
		
		$this->load->language('product/color/list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('product/color');

		$filters = array();
		
		if (isset($this->request->get['filter_id_product_color'])) {
			$filter_id_product_color = $this->request->get['filter_id_product_color'];
			$filters['filter_id_product_color'] = $filter_id_product_color;
		} else {
			$filter_id_product_color = null;
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
			$filters['filter_name'] = $filter_name;
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['filter_num_colors'])) {
			$filter_num_colors = $this->request->get['filter_num_colors'];
			$filters['filter_num_colors'] = $filter_num_colors;
		} else {
			$filter_num_colors = null;
		}

		if (isset($this->request->get['filter_id_product_color_group'])) {
			$filter_id_product_color_group = $this->request->get['filter_id_product_color_group'];
			$filters['filter_id_product_color_group'] = $filter_id_product_color_group;
		} else {
			$filter_id_product_color_group = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pc.name';
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
			$limit = $this->config->get('config_limit_admin');
		}
		$filters['start'] = ($page - 1) * $limit;
		$filters['limit'] = $limit;
					
		$url = '';

		if (isset($this->request->get['filter_id_product_color'])) {
			$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_num_colors'])) {
			$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
		}
		
		if (isset($this->request->get['filter_id_product_color_group'])) {
			$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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
			'href'      => $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
   		);

		$language_items = array(
			'text_list',
			'entry_id',
			'entry_name',
			'entry_num_colors',
			'entry_color_group',
		);
		
		foreach ( $language_items as $language_item ) {
			$data[$language_item] = $this->language->get($language_item);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_id_product_color'] = $this->language->get('column_id_product_color');
		$data['column_name'] = $this->language->get('column_name');
    	$data['column_num_colors'] = $this->language->get('column_num_colors');
    	$data['column_need_white_base'] = $this->language->get('column_need_white_base');
    	$data['column_hexa'] = $this->language->get('column_hexa');
		$data['column_id_product_color_group'] = $this->language->get('column_id_product_color_group');
		$data['column_action'] = $this->language->get('column_action');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_limit'] = $this->language->get('text_limit');
		
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_add'] = $this->language->get('button_add_color');
		$data['text_confirm'] = $this->language->get('text_confirm_delete');
		
		$data['delete'] = $this->url->link('product/color/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('product/color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		if (isset($this->request->get['filter_id_product_color'])) {
			$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_num_colors'])) {
			$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
		}
		
		if (isset($this->request->get['filter_id_product_color_group'])) {
			$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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

		$data['sort_id_product_color_group'] = $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . '&sort=pc.id_product_color_group' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . '&sort=pc.name' . $url, 'SSL');
		$data['sort_num_colors'] = $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . '&sort=pc.num_colors' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_id_product_color'])) {
			$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_num_colors'])) {
			$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
		}
		
		if (isset($this->request->get['filter_id_product_color_group'])) {
			$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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

		$color_total = $this->model_product_color->getTotalColors($filters);

		$results = $this->model_product_color->getColors($filters);
		
    	foreach ($results as $result) {
						
			$action = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('product/color/update', 'token=' . $this->session->data['token'] . '&id_product_color=' . $result['id_product_color'] . $url, 'SSL')
			);
			
			
			$data['colors'][] = array(
				'id_product_color'    => $result['id_product_color'],
				'name'      	=> $result['name'],
				'num_colors'      	=> $result['num_colors'],
				'id_product_color_group'      	=> $result['id_product_color_group'],
				'need_white_base'      	=> ($result['need_white_base'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'hexa'      	=> $result['hexa'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_product_color'], $this->request->post['selected']),
				'edit'        => $action
			);
		}

		$pagination = new Pagination();
		$pagination->total = $color_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('product/color', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($color_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($color_total - $this->config->get('config_limit_admin'))) ? $color_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $color_total, ceil($color_total / $this->config->get('config_limit_admin')));

		$data['filter_id_product_color'] = $filter_id_product_color;
		$data['filter_name'] = $filter_name;
		$data['filter_num_colors'] = $filter_num_colors;
		$data['filter_id_product_color_group'] = $filter_id_product_color_group;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;
		
    	$data['color_groups'] = $this->model_product_color->getColorGroups();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('product/color/list.tpl', $data));
  	}

  	private function getForm() {
		
		$this->document->addScript('view/javascript/jscolor/jscolor.js');
		
		$data['heading_title'] = $this->language->get('heading_title');
		 
		$data['text_form']	= $this->language->get('text_form');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_color_group'] = $this->language->get('entry_color_group');
		$data['entry_num_colors'] = $this->language->get('entry_num_colors');
		$data['entry_hexa'] = $this->language->get('entry_hexa');
		$data['entry_need_white_base'] = $this->language->get('entry_need_white_base');

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

 		if (isset($this->error['hexa'])) {
			$data['error_hexa'] = $this->error['hexa'];
		} else {
			$data['error_hexa'] = '';
		}
				
		$url = '';

		if (isset($this->request->get['filter_id_product_color'])) {
			$url .= '&filter_id_product_color=' . $this->request->get['filter_id_product_color'];
		}
		
		if (isset($this->request->get['filter_num_colors'])) {
			$url .= '&filter_num_colors=' . $this->request->get['filter_num_colors'];
		}
		
		if (isset($this->request->get['filter_id_product_color_group'])) {
			$url .= '&filter_id_product_color_group=' . $this->request->get['filter_id_product_color_group'];
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
       		'text'      => $this->language->get('text_product_color_list'),
			'href'      => $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);


		if (!isset($this->request->get['id_product_color'])) {
			$data['action'] = $this->url->link('product/color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('product/color/insert', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
		
		} else {
			$data['action'] = $this->url->link('product/color/update', 'token=' . $this->session->data['token'] . '&id_product_color=' . $this->request->get['id_product_color'] . $url, 'SSL');
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('product/color/update', 'token=' . $this->session->data['token'] . '&id_product_color=' . $this->request->get['id_product_color'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
		
		}
		
		$data['cancel'] = $this->url->link('product/color/_list', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['id_product_color']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$color = $this->model_product_color->getColor($this->request->get['id_product_color']);	
			
			$color_info = array(
				'id_product_color'	=> $color['id_product_color'],
				'name'      	=> $color['name'],
				'num_colors'      	=> $color['num_colors'],
				'need_white_base'      	=> $color['need_white_base'],
				'id_product_color_group'      	=> $color['id_product_color_group'],
				'hexa'   => $color['hexa']
			);
		}
		
		if (isset($this->request->get['id_product_color'])) {
			
			$color = $this->model_product_color->getColor($this->request->get['id_product_color']);	
			
			$non_editable_num_colors = $color['num_colors'];
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($color_info)) {
			$data['name'] = $color_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['need_white_base'])) {
			$data['need_white_base'] = $this->request->post['need_white_base'];
		} elseif (!empty($color_info)) {
			$data['need_white_base'] = $color_info['need_white_base'];
		} else {
			$data['need_white_base'] = '1';
		}

		if (isset($non_editable_num_colors)) {
			$data['num_colors'] = $non_editable_num_colors;
		} elseif (isset($this->request->post['num_colors'])) {
			$data['num_colors'] = $this->request->post['num_colors'];
		} elseif (!empty($color_info)) {
			$data['num_colors'] = $color_info['num_colors'];
		} else {
			$data['num_colors'] = '1';
		}
		
		if (isset($non_editable_num_colors)) {
			$data['editable_num_colors'] = false;
		} else {
			$data['editable_num_colors'] = true;
		} 
						
		if (isset($this->request->post['id_product_color_group'])) {
			$data['id_product_color_group'] = $this->request->post['id_product_color_group'];
		} elseif (!empty($color_info)) { 
			$data['id_product_color_group'] = $color_info['id_product_color_group'];
		} else {
			$data['id_product_color_group'] = '';
		}

		if (isset($this->request->post['hexa'])) {
			$data['hexa'] = $this->request->post['hexa'];
		} elseif (!empty($color_info)) { 
			$data['hexa'] = $color_info['hexa'];
		} else {
			$data['hexa'] = array('FFFFFF');
		}

    	$data['color_groups'] = $this->model_product_color->getColorGroups();
		$this->load->model('tool/image');
		$data['color_numbers_images'] = array();
		for($i=1; $i<=$this->config->get('opentshirts_max_product_color_combination'); $i++)
		{
			$data['color_numbers_images'][$i] = $this->model_tool_image->resize('colors/tshirt'.$i.'.png', 32, 32);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('product/color/form.tpl',$data));
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'product/color')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if(empty($this->request->post['hexa']) || !is_array($this->request->post['hexa'])) {
			$this->error['hexa'] = $this->language->get('error_hexa');
		} else { 
			foreach($this->request->post['hexa'] as $hexa) {
				if(!preg_match("/^[a-fA-F0-9]{6}$/",$hexa)) {
					$this->error['hexa'] = $this->language->get('error_hexa');
				}
			}
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
		if (!$this->user->hasPermission('modify', 'product/color')) {
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
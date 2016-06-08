<?php
class ControllerFontFont extends Controller {
	private $error = array();

  	public function index() {
		$this->getList();
  	}
	
  	public function _list() {

    	$this->getList();
  	}
	
  	public function insert() {
		$this->load->language('font/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('font/font');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	
			$id_font = $this->model_font_font->addFont($this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
			
			if (isset($this->request->get['filter_id_font'])) {
				$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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


			$this->response->redirect($this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('font/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('font/font');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_font_font->editFont($this->request->get['id_font'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_id_font'])) {
				$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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


			$this->response->redirect($this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		
		$this->load->language('font/form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			$this->load->model('font/font');
			
			foreach ($this->request->post['selected'] as $id_font) {
				$this->model_font_font->deleteFont($id_font);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_id_font'])) {
				$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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

			$this->response->redirect($this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {
		
		$this->load->language('font/list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('font/font');

		$filters = array();
		
		if (isset($this->request->get['filter_id_font'])) {
			$filter_id_font = $this->request->get['filter_id_font'];
			$filters['filter_id_font'] = $filter_id_font;
		} else {
			$filter_id_font = null;
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
			$sort = 'f.date_added';
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

		if (isset($this->request->get['filter_id_font'])) {
			$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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
			'href'      => $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
   		);
		$data['delete'] = $this->url->link('font/font/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('font/font/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['fonts'] = array();

		$font_total = $this->model_font_font->getTotalFonts($filters);

		$results = $this->model_font_font->getFonts($filters);
		$this->load->model('font/category');
		$this->load->model('tool/image');
		
    	foreach ($results as $result) {
						
			$action = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('font/font/update', 'token=' . $this->session->data['token'] . '&id_font=' . $result['id_font'] . $url, 'SSL')
			);
			
			$cats = array();
			foreach($this->model_font_font->getFontCategories($result['id_font']) as $id_category)
			{
				$cats[] = $this->model_font_category->getCategory($id_category);
			}
			
			
			if($result['ttf_file'] && file_exists(DIR_IMAGE . 'data/fonts/' . $result['ttf_file'])) {
				$thumb = $this->url->link('font/ttf2png', "font_source=fonts/".$result['ttf_file']."&display_text=".strtoupper($result['name'])."&token=".$this->session->data['token'], 'SSL');
			} else {
				$thumb = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}	
			
			
			$data['fonts'][] = array(
				'id_font'    => $result['id_font'],
				'name'      	=> $result['name'],
				'status'      	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'thumb'      	=> $thumb,
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'categories'    => $cats,
				'keywords'      => $this->model_font_font->getFontKeywords($result['id_font']),
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_font'], $this->request->post['selected']),
				'edit'        => $action
			);
		}

		$language_items = array(
			'text_list',
			'entry_name',
			'entry_id',
			'entry_status',
			'entry_keyword',
			'entry_category',
			'button_add',
		);
		
		foreach ( $language_items as $language_item ) {
			$data[$language_item] = $this->language->get($language_item);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_id_font'] = $this->language->get('column_id_font');
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
		$data['button_insert'] = $this->language->get('button_add_font');

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

		if (isset($this->request->get['filter_id_font'])) {
			$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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

		$data['sort_font'] = $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . '&sort=f.id_font' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . '&sort=f.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . '&sort=f.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . '&sort=f.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_id_font'])) {
			$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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
		$pagination->total = $font_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('clipart/clipart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($font_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($font_total - $this->config->get('config_limit_admin'))) ? $font_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $font_total, ceil($font_total / $this->config->get('config_limit_admin')));

		$data['filter_id_font'] = $filter_id_font;
		$data['filter_name'] = $filter_name;
		$data['filter_id_category'] = $filter_id_category;
		$data['filter_status'] = $filter_status;
		$data['filter_keyword'] = $filter_keyword;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$this->load->model('font/category');

    	$data['categories'] = $this->model_font_category->getCategoriesByParentId();
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'', 'description'=>$this->language->get('text_none'));
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
	
		$this->response->setOutput($this->load->view('font/list.tpl',$data));
  	}

  	private function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->document->addScript('view/javascript/uploadify/swfobject.js');
		$this->document->addScript('view/javascript/uploadify/jquery.uploadify.v2.1.4.min.js');
		$this->document->addStyle('view/javascript/uploadify/uploadify.css');
		
		$data['text_form'] = $this->language->get('text_form');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_freq_keywords'] = $this->language->get('text_freq_keywords');
		$data['text_clear'] = $this->language->get('text_clear');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_keywords'] = $this->language->get('entry_keywords');
		$data['entry_swf_file'] = $this->language->get('entry_swf_file');
		$data['entry_ttf_file'] = $this->language->get('entry_ttf_file');
		$data['entry_status'] = $this->language->get('entry_status');
			
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_font'] = $this->language->get('button_add_font');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_upload'] = $this->language->get('button_upload');

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
				
 		if (isset($this->error['ttf_file'])) {
			$data['error_ttf_file'] = $this->error['ttf_file'];
		} else {
			$data['error_ttf_file'] = '';
		}
				
 		if (isset($this->error['swf_file'])) {
			$data['error_swf_file'] = $this->error['swf_file'];
		} else {
			$data['error_swf_file'] = '';
		}
				
		$url = '';

		if (isset($this->request->get['filter_id_font'])) {
			$url .= '&filter_id_font=' . $this->request->get['filter_id_font'];
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
       		'text'      => $this->language->get('text_font_list'),
			'href'      => $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);


		if (!isset($this->request->get['id_font'])) {
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('font/font/insert', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
			$data['action'] = $this->url->link('font/font/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('font/font/update', 'token=' . $this->session->data['token'] . '&id_font=' . $this->request->get['id_font'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
			$data['action'] = $this->url->link('font/font/update', 'token=' . $this->session->data['token'] . '&id_font=' . $this->request->get['id_font'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('font/font/_list', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->load->model('tool/image');
		
		if (isset($this->request->get['id_font']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$result = $this->model_font_font->getFont($this->request->get['id_font']);	
			
			if($result['ttf_file'] && file_exists(DIR_IMAGE . 'data/fonts/' . $result['ttf_file'])) {
				$thumb = $this->url->link('font/ttf2png', "font_source=fonts/".$result['ttf_file']."&display_text=".strtoupper($result['name'])."&token=".$this->session->data['token'], 'SSL');
			} else {
				$thumb = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}	
			$font_info = array(
				'id_font'		=> $result['id_font'],
				'name'      	=> $result['name'],
				'thumb'    		=> $thumb,
				'swf_file'      => $result['swf_file'],
				'ttf_file'      => $result['ttf_file'],
				'status'      	=> $result['status'],
				'keywords'      => implode(",",$this->model_font_font->getFontKeywords($result['id_font']))
			);
		}
				
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($font_info)) {
			$data['name'] = $font_info['name'];
		} else {
			$data['name'] = '';
		}
				
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($font_info)) { 
			$data['status'] = $font_info['status'];
		} else {
			$data['status'] = '';
		}	
		
		if (isset($this->request->post['keywords'])) {
			$data['keywords'] = $this->request->post['keywords'];
		} elseif (!empty($font_info)) { 
			$data['keywords'] = $font_info['keywords'];
		} else {
			$data['keywords'] = '';
		}	
		
		if (isset($this->request->post['swf_file'])) {
			$data['swf_file'] = $this->request->post['swf_file'];
		} elseif (!empty($font_info)) { 
			$data['swf_file'] = $font_info['swf_file'];
		} else {
			$data['swf_file'] = '';
		}
		
		if (isset($this->request->post['ttf_file'])) {
			$data['ttf_file'] = $this->request->post['ttf_file'];
		} elseif (!empty($font_info)) { 
			$data['ttf_file'] = $font_info['ttf_file'];
		} else {
			$data['ttf_file'] = '';
		}
		
		
		
		if (isset($this->request->post['ttf_file'])) {
			$data['thumb'] = $this->url->link('font/ttf2png', "font_source=fonts/".$this->request->post['ttf_file']."&display_text=Sample&token=".$this->session->data['token'], 'SSL');
		} elseif (!empty($font_info)) {
			$data['thumb'] = $font_info['thumb'];
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		$template = 'font/form.tpl';
		
		$data['extra_tabs'] = array();
		$data['extra_tabs'][] = 	$this->load->controller('font/category/category_tab');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view($template,$data));
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'font/font')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['swf_file']) < 1) || (utf8_strlen($this->request->post['swf_file']) > 255)) {
			$this->error['swf_file'] = $this->language->get('error_swf_file');
		}
		
		if ((utf8_strlen($this->request->post['ttf_file']) < 1) || (utf8_strlen($this->request->post['ttf_file']) > 255)) {
			$this->error['ttf_file'] = $this->language->get('error_ttf_file');
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
		if (!$this->user->hasPermission('modify', 'font/font')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}



	public function upload_ttf() {
		
		$this->language->load('font/form');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');
			
			if ((strlen($filename) < 3) || (strlen($filename) > 128)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	
			
			$allowed = array();
			
			$filetypes = explode(',', 'ttf,otf,TTF,OTF');
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			
			if (!in_array(utf8_substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}
						
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		
		if (!$this->user->hasPermission('modify', 'font/font')) {
			$json['error'] = $this->language->get('error_permission');
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				//$file = md5(rand()) . '-' . basename($filename) ;
				$file = basename($filename) ;
				
				if(move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'data/fonts/' . $file))
				{
					$json['filename'] = $file;
					
					$json['file'] = html_entity_decode($this->url->link('font/ttf2png', "font_source=fonts/".$file."&display_text=Sample&token=".$this->session->data['token'], 'SSL'));
					
					$json['success'] = $this->language->get('text_upload');
				} else {
					$json['error'] = $this->language->get('error_upload');
				}
			
			}
		}	

		$this->response->setOutput(json_encode($json));		
	}

	public function upload_swf() {
		
		$this->language->load('font/form');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');
			
			if ((strlen($filename) < 3) || (strlen($filename) > 128)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	
			
			$allowed = array();
			
			$filetypes = explode(',', 'swf,SWF');
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			
			if (!in_array(utf8_substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}
						
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		
		if (!$this->user->hasPermission('modify', 'font/font')) {
			$json['error'] = $this->language->get('error_permission');
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				//$file = md5(rand()) . '-' . basename($filename) ;
				$file = basename($filename) ;
				
				if(move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'data/fonts/' . $file))
				{
					$json['filename'] = $file;
					
					$json['success'] = $this->language->get('text_upload');
				} else {
					$json['error'] = $this->language->get('error_upload');
				}
			
			}
		}	

		$this->response->setOutput(json_encode($json));		
	}
			
}
?>
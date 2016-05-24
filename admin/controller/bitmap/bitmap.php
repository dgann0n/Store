<?php
class ControllerBitmapBitmap extends Controller {
	private $error = array();

  	public function index() {
		$this->getList();

  	}
	
  	public function _list() {

    	$this->getList();
  	}
	
  	public function insert() {
		$this->load->language('bitmap/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bitmap/bitmap');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	
			$id_bitmap = $this->model_bitmap_bitmap->addBitmap($this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
			
			if (isset($this->request->get['filter_id_bitmap'])) {
				$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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

			$this->response->redirect($this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('bitmap/form');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bitmap/bitmap');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_bitmap_bitmap->editBitmap($this->request->get['id_bitmap'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_id_bitmap'])) {
				$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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


			$this->response->redirect($this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		
		$this->load->language('bitmap/form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			$this->load->model('bitmap/bitmap');
			
			foreach ($this->request->post['selected'] as $id_bitmap) {
				$this->model_bitmap_bitmap->deleteBitmap($id_bitmap);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_id_bitmap'])) {
				$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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

			$this->response->redirect($this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {
		
		$this->load->language('bitmap/list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bitmap/bitmap');

		$filters = array();
		
		if (isset($this->request->get['filter_id_bitmap'])) {
			$filter_id_bitmap = $this->request->get['filter_id_bitmap'];
			$filters['filter_id_bitmap'] = $filter_id_bitmap;
		} else {
			$filter_id_bitmap = null;
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
			$sort = 'b.date_added';
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

		if (isset($this->request->get['filter_id_bitmap'])) {
			$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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
			'href'      => $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
   		);
		$data['delete'] = $this->url->link('bitmap/bitmap/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('bitmap/bitmap/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['bitmaps'] = array();

		$filters['filter_from_customer'] = '0'; //skip customer's art

		$bitmap_total = $this->model_bitmap_bitmap->getTotalBitmaps($filters);

		$results = $this->model_bitmap_bitmap->getBitmaps($filters);
		$this->load->model('bitmap/category');
		$this->load->model('tool/image');
		
    	foreach ($results as $result) {
			$edit = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('bitmap/bitmap/update', 'token=' . $this->session->data['token'] . '&id_bitmap=' . $result['id_bitmap'] . $url, 'SSL')
			);
			
			$cats = array();
			foreach($this->model_bitmap_bitmap->getBitmapCategories($result['id_bitmap']) as $id_category)
			{
				$cats[] = $this->model_bitmap_category->getCategory($id_category);
			}
			
			if($result['image_file'] && file_exists(DIR_IMAGE . 'data/bitmaps/' . $result['image_file'])) {
				$thumb = $this->model_tool_image->resize('data/bitmaps/' .$result['image_file'], 100, 100);
			} else {
				$thumb = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
			
			$data['bitmaps'][] = array(
				'id_bitmap'    => $result['id_bitmap'],
				'name'      	=> $result['name'],
				'status'      	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				//'thumb'      	=> 	__HTTP_RESOURCES_DIR__ . 'bitmaps/bitmap_'.$result['id_bitmap'].'/thumb_90_90.jpg',
				'thumb'      	=> 	$thumb,
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'categories'    => $cats,
				'keywords'      => $this->model_bitmap_bitmap->getBitmapKeywords($result['id_bitmap']),
				'selected'      => isset($this->request->post['selected']) && in_array($result['id_bitmap'], $this->request->post['selected']),
				'edit'        => $edit
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_id'] = $this->language->get('column_id');
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
		$data['button_insert'] = $this->language->get('button_add_bitmap');

		$data['token'] = $this->session->data['token'];
		
		$language_items = array(
			'text_list',
			'text_edit',
			'entry_name',
			'entry_id',
			'entry_status',
			'entry_keyword',
			'entry_category',
			'button_add_bitmap',
		);
		
		foreach ( $language_items as $language_item ) {
			$data[$language_item] = $this->language->get($language_item);
		}
		
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

		if (isset($this->request->get['filter_id_bitmap'])) {
			$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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

		$data['sort_bitmap'] = $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . '&sort=c.id_bitmap' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . '&sort=c.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_id_bitmap'])) {
			$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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
		$pagination->total = $bitmap_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('clipart/clipart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($pagination->total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($pagination->total - $limit)) ? $pagination->total : ((($page - 1) * $limit) + $limit), $pagination->total, ceil($pagination->total / $limit));

		$data['filter_id_bitmap'] = $filter_id_bitmap;
		$data['filter_name'] = $filter_name;
		$data['filter_id_category'] = $filter_id_category;
		$data['filter_status'] = $filter_status;
		$data['filter_keyword'] = $filter_keyword;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$this->load->model('bitmap/category');

    	$data['categories'] = $this->model_bitmap_category->getCategoriesByParentId();
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'', 'description'=>$this->language->get('text_none'));
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view('bitmap/list.tpl',$data));
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
		$data['text_select_colors'] = $this->language->get('text_select_colors');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_keywords'] = $this->language->get('entry_keywords');
		$data['entry_status'] = $this->language->get('entry_status');
			
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_categories'] = $this->language->get('tab_categories');
		$data['tab_appearance'] = $this->language->get('tab_appearance');

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

		if (isset($this->request->get['filter_id_bitmap'])) {
			$url .= '&filter_id_bitmap=' . $this->request->get['filter_id_bitmap'];
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
       		'text'      => $this->language->get('text_bitmap_list'),
			'href'      => $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);


		if (!isset($this->request->get['id_bitmap'])) {
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('bitmap/bitmap/insert', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
			$data['action'] = $this->url->link('bitmap/bitmap/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('bitmap/bitmap/update', 'token=' . $this->session->data['token'] . '&id_bitmap=' . $this->request->get['id_bitmap'] . $url, 'SSL'),				
				'separator' => ' :: '
			);
			$data['action'] = $this->url->link('bitmap/bitmap/update', 'token=' . $this->session->data['token'] . '&id_bitmap=' . $this->request->get['id_bitmap'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('bitmap/bitmap/_list', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['id_bitmap']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$result = $this->model_bitmap_bitmap->getBitmap($this->request->get['id_bitmap']);	
			
			$bitmap_info = array(
				'id_bitmap'		=> $result['id_bitmap'],
				'name'      	=> $result['name'],
				'status'      	=> $result['status'],
				'keywords'      => implode(",",$this->model_bitmap_bitmap->getBitmapKeywords($result['id_bitmap']))
			);
		}
				
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($bitmap_info)) {
			$data['name'] = $bitmap_info['name'];
		} else {
			$data['name'] = '';
		}
				
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($bitmap_info)) { 
			$data['status'] = $bitmap_info['status'];
		} else {
			$data['status'] = '';
		}	
		
		if (isset($this->request->post['keywords'])) {
			$data['keywords'] = $this->request->post['keywords'];
		} elseif (!empty($bitmap_info)) { 
			$data['keywords'] = $bitmap_info['keywords'];
		} else {
			$data['keywords'] = '';
		}	
		
		$data['statuses'] = array();
		$data['statuses'][] = array('val'=>'1', 'description'=>$this->language->get('text_enabled'));
		$data['statuses'][] = array('val'=>'0', 'description'=>$this->language->get('text_disabled'));

		//$data['category_tab'] = $this->load->controller('bitmap/category/category_tab');
		//$data['appearance_tab'] = $this->load->controller('bitmap/category/appearance_tab');
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$data['extra_tabs'] = array();
		
		$data['extra_tabs'][] = $this->load->controller('bitmap/bitmap/category_tab');
		$data['extra_tabs'][] = $this->load->controller('bitmap/bitmap/appearance_tab');
		
		$this->response->setOutput($this->load->view('bitmap/form.tpl',$data));
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'bitmap/bitmap')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['image_file']) < 1) || (utf8_strlen($this->request->post['image_file']) > 255)) {
			$this->error['image_file'] = $this->language->get('error_image_file');
			$this->session->data['error_image_file'] = $this->language->get('error_image_file');
		}

		if (empty($this->request->post['colors'])) {
			$this->error['colors'] = $this->language->get('error_colors');
			$this->session->data['error_colors'] = $this->language->get('error_colors');
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
		if (!$this->user->hasPermission('modify', 'bitmap/bitmap')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}


	public function upload_image() {
		
		$this->language->load('bitmap/form');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');
			
			if ((strlen($filename) < 3) || (strlen($filename) > 128)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	
			
			$allowed = array();
			
			$filetypes = explode(',', 'jpg,png,gif,JPG');
			
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
		
		if (!$this->user->hasPermission('modify', 'bitmap/bitmap')) {
			$json['error'] = $this->language->get('error_permission');
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$file = substr(md5(rand()), 0, 8) . '-' . basename($filename) ;
				
				if(move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'data/bitmaps/' . $file))
				{
					$json['filename'] = $file;
					
					$this->load->model('tool/image');
		
					$json['file'] = $this->model_tool_image->resize('data/bitmaps/' .$file, 400, 400);
					
					$json['success'] = $this->language->get('text_upload');
				} else {
					$json['error'] = $this->language->get('error_upload');
				}
			
			}
		}	

		$this->response->setOutput(json_encode($json));		
	}
	
	public function category_tab() {
		
		$this->load->language('bitmap/form');
		
		$this->load->model('bitmap/category');

		$data['selected'] = array();
		if (isset($this->request->get['id_bitmap']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$this->load->model('bitmap/bitmap');

			$selected_categories = $this->model_bitmap_bitmap->getBitmapCategories($this->request->get['id_bitmap']);
		}
		
		if (isset($this->request->post['selected_categories'])) {
			$data['selected_categories'] = $this->request->post['selected_categories'];
		} elseif (!empty($selected_categories)) { 
			$data['selected_categories'] = $selected_categories;
		} else {
			$data['selected_categories'] = array();
		}

		$data['categories'] = $this->model_bitmap_category->getCategoriesByParentId();
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_autoselect_parent'] = $this->language->get('text_autoselect_parent');
		$data['text_root'] = $this->language->get('text_root');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');

		$data['token'] = $this->session->data['token'];

		$output = $this->load->view('clipart/category_tab.tpl',$data);
		
		return array(
			'id' 		=>'tab-categories',
			'label'		=> $this->language->get('tab_categories'),
			'content' 	=> $output,
		);
  	}
	
	public function appearance_tab() {

		$this->load->language('bitmap/form');

		$this->load->model('bitmap/bitmap');

		$data['entry_image_file'] = $this->language->get('entry_image_file');
		$data['entry_colors'] = $this->language->get('entry_colors');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_selected_colors'] = $this->language->get('text_selected_colors');		
		$data['button_upload'] = $this->language->get('button_upload');
		$data['token'] = $this->session->data['token'];

		if (isset($this->session->data['error_image_file'])) {
			$data['error_image_file'] = $this->session->data['error_image_file'];
			unset($this->session->data['error_image_file']);
		} else {
			$data['error_image_file'] = '';
		}

		if (isset($this->session->data['error_colors'])) {
			$data['error_colors'] = $this->session->data['error_colors'];
			unset($this->session->data['error_colors']);
		} else {
			$data['error_colors'] = '';
		}

		if (isset($this->request->get['id_bitmap']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$result = $this->model_bitmap_bitmap->getBitmap($this->request->get['id_bitmap']);	
			
			$bitmap_info = array(
				'image_file'      => $result['image_file'],
				'colors'      	  => $result['colors'],
			);
		}
		
		if (isset($this->request->post['image_file'])) {
			$data['image_file'] = $this->request->post['image_file'];
		} elseif (!empty($bitmap_info)) { 
			$data['image_file'] = $bitmap_info['image_file'];
		} else {
			$data['image_file'] = '';
		}

		if (isset($this->request->post['colors'])) {
			$data['colors'] = $this->request->post['colors'];
		} elseif (!empty($bitmap_info)) { 
			$data['colors'] = $bitmap_info['colors'];
		} else {
			$data['colors'] = array();
		}
		
		$data['bitmap_dir'] = HTTP_CATALOG . 'image/data/bitmaps/';
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image_file'])) {
			$data['thumb'] = $this->model_tool_image->resize('data/bitmaps/' .$this->request->post['image_file'], 400, 400);
		} elseif (!empty($bitmap_info) && $bitmap_info['image_file'] && file_exists(DIR_IMAGE . 'data/bitmaps/' . $bitmap_info['image_file'])) {
			$data['thumb'] = $this->model_tool_image->resize('data/bitmaps/' .$bitmap_info['image_file'], 400, 400);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 400, 400);
		}
		
		$this->load->model('design_color/design_color');
		
		$data['design_colors'] = $this->model_design_color_design_color->getColors();
		
		$output = $this->load->view('bitmap/appearance_tab.tpl',$data);
		
		return array(
			'id' 		=>'tab-appearance',
			'label'		=> $this->language->get('tab_appearance'),
			'content' 	=> $output,
		);
	}
			
}
?>
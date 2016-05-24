<?php
class ControllerProductProduct extends Controller {
	private $error = array();

  	public function index() {
    	$this->getList();
  	}
	
  	public function _list() {
    	$this->getList();
  	}
	
  	public function insert() {
		
		$this->load->language('product/form');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('product/product');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$product_id = $this->model_product_product->addProduct($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_printable'])) {
				$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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

			$this->response->redirect($this->url->link('product/product/_list', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function update() {
		
		$this->load->language('product/form');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('product/product');
		$this->load->model('catalog/product');
		    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_product_product->editProduct($this->request->get['product_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_printable'])) {
				$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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

			$this->response->redirect($this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {	
		$this->load->language('product/form');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			$this->load->model('product/product');
			
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_product_product->deleteProduct($product_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
			
			if (isset($this->request->get['filter_id_category'])) {
				$url .= '&filter_id_category=' . $this->request->get['filter_id_category'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_printable'])) {
				$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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

			$this->response->redirect($this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	public function set_default() {
		
		$this->load->language('product/form');

		if (isset($this->request->get['product_id']) && $this->validateDefault()) {
			
			$this->load->model('product/product');
			
			$this->model_product_product->setToDefaultProduct($this->request->get['product_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_printable'])) {
				$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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

			$this->response->redirect($this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
  	}

  	private function getList() {	

  		$this->load->language('product/product');

		$this->document->setTitle($this->language->get('heading_title'));

  		$this->load->model('product/product');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_printable'])) {
			$filter_printable = $this->request->get['filter_printable'];
		} else {
			$filter_printable = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_printable'])) {
			$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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
		
		$data['text_oc_product_list'] = sprintf($this->language->get('text_oc_product_list'), $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_status'   => $filter_status,
			'filter_printable'=> $filter_printable,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_product_product->getTotalProducts($filter_data);
			
		$results = $this->model_product_product->getProducts($filter_data);

		$printable_ids = $this->model_product_product->getPrintableProducts();
				    	
		foreach ($results as $result) {
			
			$action = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('product/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['p_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}

			if(!is_null($filter_printable) && $filter_printable=="0") {
				if(isset($printable_ids[$result['p_id']])) {	
					continue;
				}
			}

			$data['products'][] = array(
				'product_id' => $result['p_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'image'      => $image,
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'printable'  => (isset($printable_ids[$result['p_id']]) ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'action'     => $action
			);
      		
    	}
		
		$data['heading_title'] = $this->language->get('heading_title');		
				
		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');		
		$data['text_disabled'] = $this->language->get('text_disabled');		
		$data['text_no_results'] = $this->language->get('text_no_results');		
		$data['text_image_manager'] = $this->language->get('text_image_manager');		
			
		$data['column_image'] = $this->language->get('column_image');		
		$data['column_name'] = $this->language->get('column_name');		
		$data['column_model'] = $this->language->get('column_model');		
		$data['column_price'] = $this->language->get('column_price');		
		$data['column_quantity'] = $this->language->get('column_quantity');	
		$data['column_status'] = $this->language->get('column_status');	
		$data['column_printable'] = $this->language->get('column_printable');		
		$data['column_action'] = $this->language->get('column_action');		
				
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_printable'] = $this->language->get('entry_printable');	
			
		$data['button_copy'] = $this->language->get('button_copy');		
		$data['button_insert'] = $this->language->get('button_insert');		
		$data['button_delete'] = $this->language->get('button_delete');		
		$data['button_filter'] = $this->language->get('button_filter');

		 
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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_printable'])) {
			$url .= '&filter_printable=' . $this->request->get['filter_printable'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$data['sort_name'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_printable'])) {
			$url .= '&filter_printable=' . $this->request->get['filter_printable'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('product/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

	
		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));
	
		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_status'] = $filter_status;
		$data['filter_printable'] = $filter_printable;
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('product/product_list.tpl',$data ) );
  	}

  	private function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->document->addScript('view/javascript/uploadify/swfobject.js');
		$this->document->addScript('view/javascript/uploadify/jquery.uploadify.v2.1.4.min.js');
		$this->document->addStyle('view/javascript/uploadify/uploadify.css');
		 
		$data['text_form'] = $this->language->get('text_form');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_wait'] = $this->language->get('text_wait');
    	$data['text_disabled'] = $this->language->get('text_disabled');
    	$data['text_enabled'] = $this->language->get('text_enabled');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_printable_status'] = $this->language->get('entry_printable_status');
			
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_views'] = $this->language->get('tab_views');
		$data['tab_price'] = $this->language->get('tab_price');
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
				
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_printable'])) {
			$url .= '&filter_printable=' . $this->request->get['filter_printable'];
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
       		'text'      => $this->language->get('text_product_list'),
			'href'      => $this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('product/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('product/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('product/product', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);

			$this->load->model('product/product');
			
			$printable_product_info = $this->model_product_product->getProduct($this->request->get['product_id']);
		}

		if (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
				
		if (!empty($product_info)) {
			$data['name'] = $product_info['name'];
		} else {
			$data['name'] = '';
		}

		if (!empty($product_info)) {
			$data['model'] = $product_info['model'];
		} else {
			$data['model'] = '';
		}	
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($product_info)) { 
			$data['status'] = $product_info['status'];
		} else {
			$data['status'] = '';
		}	

		if (isset($this->request->post['printable_status'])) {
      		$data['printable_status'] = $this->request->post['printable_status'];
    	} elseif (!empty($printable_product_info)) {
			$data['printable_status'] = $printable_product_info['printable_status'];
		} else {
      		$data['printable_status'] = 1;
    	}
		
		if (!empty($product_info)) { 
			$data['image'] = $product_info['image'];
		} else {
			$data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['color_size_tab'] = $this->load->controller('product/color_size/color_size_tab');
		$data['view_tab'] = $this->load->controller('product/view/view_tab');
		$data['price_tab'] = $this->load->controller('product/price/price_tab');
		
		$this->response->setOutput($this->load->view('product/product_form.tpl',$data ) );
  	}
	
	
  	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'product/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if(!isset($this->request->post['colors_number'])) {
			$this->error['colors_number'] = $this->language->get('error_colors_number');
			$this->session->data['error_colors_number'] = $this->language->get('error_colors_number');
		}
		
		if(!isset($this->request->post['color_size'])) {
			$this->error['color_size'] = $this->language->get('error_color_size');
			$this->session->data['error_color_size'] = $this->language->get('error_color_size');
		}
		
		if(!isset($this->request->post['default_color'])) {
			$this->error['error_default_color'] = $this->language->get('error_default_color');
			$this->session->data['error_default_color'] = $this->language->get('error_default_color');
		}
		
		if(!isset($this->request->post['quantities']) || !is_array($this->request->post['quantities'])) {
			$this->error['error_quantities'] = $this->language->get('error_quantities');
			$this->session->data['error_quantities'] = $this->language->get('error_quantities');
		} else {
			foreach($this->request->post['quantities'] as $value) {
				if(!preg_match("/^[0-9]+$/",$value)) {
					$this->error['error_quantities'] = $this->language->get('error_quantities');
					$this->session->data['error_quantities'] = $this->language->get('error_quantities');
				}
			}
		}
		
		if(!isset($this->request->post['price']) || !is_array($this->request->post['price'])) {
			$this->error['error_price'] = $this->language->get('error_price');
			$this->session->data['error_price'] = $this->language->get('error_price');
		} else {
			foreach($this->request->post['price'] as $prices) {
				foreach($prices as $value) {
					if(!preg_match("/^[0-9]+(.[0-9]+)?$/",$value)) {
						$this->error['error_price'] = $this->language->get('error_price');
						$this->session->data['error_price'] = $this->language->get('error_price');
					}
				}
			}
		}
		
		if(isset($this->request->post['upcharge'])) {
			if(!is_array($this->request->post['upcharge'])) {
				$this->error['error_upcharge'] = $this->language->get('error_upcharge');
				$this->session->data['error_upcharge'] = $this->language->get('error_upcharge');
			}
			foreach($this->request->post['upcharge'] as $key=>$value) {
				if(!preg_match("/^[0-9]+(.[0-9]+)?$/",$value)) {
					$this->error['error_upcharge'] = $this->language->get('error_upcharge');
					$this->session->data['error_upcharge'] = $this->language->get('error_upcharge');
				}
			}
		}
		
		if(!isset($this->request->post['default_region'])) {
			$this->error['error_default_region'] = $this->language->get('error_default_region');
			$this->session->data['error_default_region'] = $this->language->get('error_default_region');
		}
		
		if(empty($this->request->post['views'])) {
			$this->error['error_views'] = $this->language->get('error_views');
			$this->session->data['error_views'] = $this->language->get('error_views');
		} else {
			foreach($this->request->post['views'] as $view) {
				if(empty($view['shade']) && empty($view['underfill'])) {
					$this->error['error_view_shade_underfill'] = $this->language->get('error_view_shade_underfill');
					$this->session->data['error_view_shade_underfill'] = $this->language->get('error_view_shade_underfill');
				}
				if(empty($view['fills'])) {
					$this->error['error_view_fills'] = $this->language->get('error_view_fills');
					$this->session->data['error_view_fills'] = $this->language->get('error_view_fills');
				}
				if(empty($view['regions'])) {
					$this->error['error_view_regions'] = $this->language->get('error_view_regions');
					$this->session->data['error_view_regions'] = $this->language->get('error_view_regions');
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
		if (!$this->user->hasPermission('modify', 'product/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	private function validateDefault() {
		if (!$this->user->hasPermission('modify', 'product/product')) {
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

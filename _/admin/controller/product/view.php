<?php
class ControllerProductView extends Controller {
	private $error = array();

  	public function index() {

    	$this->getList();
  	}
	
  	public function view_tab() {
		
		$this->load->language('product/view');

		$data['text_help_create_views_header'] = $this->language->get('text_help_create_views_header');
		$data['text_help_create_views_body'] = $this->language->get('text_help_create_views_body');
		$data['button_add_view'] = $this->language->get('button_add_view');
		
		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$this->load->model('product/view');
			$this->load->model('product/region');
			$this->load->model('product/fill');
			
			$views = array();
			$result = $this->model_product_view->getViews(array('product_id' => $this->request->get['product_id']));
			
			foreach ($result as $view) {
				$regions = array();
				foreach ($this->model_product_region->getRegions(array('product_id' => $this->request->get['product_id'], 'view_index' => $view['view_index'])) as $region) {
					$regions[] = array(
						'region_index'	=> $region['region_index'],
						'name'		=> $region['name'],
						'x'			=> $region['x'],
						'y'			=> $region['y'],
						'width'		=> $region['width'],
						'height'	=> $region['height'],
						'mask'	    => $region['mask']
					);
				}	
				$fills = array();
				foreach ($this->model_product_fill->getFills(array('product_id' => $this->request->get['product_id'], 'view_index' => $view['view_index'])) as $fill) {
					$fills[$fill['view_fill_index']] = $fill['file'];
				}
				
				$views[] = array(
        			'view_index'	=> $view['view_index'],
        			'name'			=> $view['name'],
        			'regions_scale'	=> $view['regions_scale'],
        			'shade'			=> $view['shade'],
        			'underfill'		=> $view['underfill'],
					'regions'		=> $regions,
					'fills'			=> $fills
        		);
    		}	
			
		}
		
		$data['token'] = $this->session->data['token'];
		
		$data['views'] = $views;
		$data['view_tabs'] = array();
		if (isset($this->request->post['views'])) {
			foreach($this->request->post['views'] as $view) {
				$data['view_tabs'][] = $this->load->controller('product/view/internalform', $view);
			}
		} elseif (!empty($views)) { 
			foreach($views as $view) {
				$data['view_tabs'][] = $this->load->controller('product/view/internalform', $view);
			}	
		}
		
		if (!empty($this->request->get['product_id'])) {
			$data['product_id'] =$this->request->get['product_id'];
		} else { 
			$data['product_id'] = '';	
		}
		
		if (isset($this->session->data['error_default_region'])) {
			$data['error_default_region'] = $this->session->data['error_default_region'];
			unset($this->session->data['error_default_region']);
		} else {
			$data['error_default_region'] = '';
		}

		if (isset($this->session->data['error_views'])) {
			$data['error_views'] = $this->session->data['error_views'];
			unset($this->session->data['error_views']);
		} else {
			$data['error_views'] = '';
		}

		if (isset($this->session->data['error_view_fills'])) {
			$data['error_view_fills'] = $this->session->data['error_view_fills'];
			unset($this->session->data['error_view_fills']);
		} else {
			$data['error_view_fills'] = '';
		}

		if (isset($this->session->data['error_view_shade_underfill'])) {
			$data['error_view_shade_underfill'] = $this->session->data['error_view_shade_underfill'];
			unset($this->session->data['error_view_shade_underfill']);
		} else {
			$data['error_view_shade_underfill'] = '';
		}

		if (isset($this->session->data['error_view_regions'])) {
			$data['error_view_regions'] = $this->session->data['error_view_regions'];
			unset($this->session->data['error_view_regions']);
		} else {
			$data['error_view_regions'] = '';
		}

		return $this->load->view('product/view.tpl',$data);
  	}

	public function internalform($filter_data = array()) {
		$data = $this->formdata($filter_data);
		return $this->load->view('product/view_item.tpl',$data);
	}
	
	public function form($filter_data = array()) {
		$data = $this->formdata($filter_data);
		$this->response->setOutput($this->load->view('product/view_item.tpl',$data));
	}
	
	private function formdata ($filter_data = array()) {
		$this->load->language('product/view');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['button_add_region'] = $this->language->get('button_add_region');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_shade'] = $this->language->get('button_shade');
		$data['button_underfill'] = $this->language->get('button_underfill');
		$data['button_fill'] = $this->language->get('button_fill');
		
		$data['help_shade']	= $this->language->get('help_shade');
		$data['help_fills'] = $this->language->get('help_fills');
		
		$data['text_image_setup'] = $this->language->get('text_image_setup');
		$data['text_regions'] = $this->language->get('text_regions');
		$data['text_fills'] = $this->language->get('text_fills');
		$data['text_shade'] = $this->language->get('text_shade');
		$data['text_underfill'] = $this->language->get('text_underfill');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_scale'] = $this->language->get('text_scale');
		$data['text_coloreable'] = $this->language->get('text_coloreable');
		$data['text_view_setup'] = $this->language->get('text_view_setup');
		$data['text_coloreable_pros_cons'] = $this->language->get('text_coloreable_pros_cons');
		$data['text_no_coloreable_pros_cons'] = $this->language->get('text_no_coloreable_pros_cons');		
		
		$data['token'] = $this->session->data['token'];
		
		if (!empty($filter_data)) {
			$view_index = $filter_data['view_index'];
			$name = $filter_data['name'];
			$shade = $filter_data['shade'];
			$underfill = $filter_data['underfill'];
			$regions_scale = $filter_data['regions_scale'];
			$fills = (isset($filter_data['fills']))?$filter_data['fills']:array();
			$regions = (isset($filter_data['regions']))?$filter_data['regions']:array();
		}
		
		if (isset($view_index)) { 
			$data['view_index'] = $view_index;
		} else {
			$data['view_index'] = mt_rand();
		}
		
		if (!empty($name)) { 
			$data['name'] = $name;
		} else {
			$data['name'] = 'Enter View Name';
		}
		
		$this->load->model('tool/image');
		
		if (isset($shade)) { 
			$data['shade'] = $shade;
			if(empty($shade)) {
				$data['thumb_shade'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				$data['shade_url'] = '';
			} else {
				$data['thumb_shade'] = $this->model_tool_image->resize('data/products/' .$shade, 100, 100);
				$data['shade_url'] = HTTPS_CATALOG . 'image/data/products/' . $shade;
			}
		} else {
			$data['shade'] = 'default_shade.png';
			$data['thumb_shade'] = $this->model_tool_image->resize('data/products/default_shade.png' , 100, 100);
			$data['shade_url'] = HTTPS_CATALOG . 'image/data/products/default_shade.png';
		}

		if (!empty($underfill)) { 
			$data['underfill'] = $underfill;
			$data['thumb_underfill'] = $this->model_tool_image->resize('data/products/' .$underfill, 100, 100);
			$data['underfill_url'] = HTTPS_CATALOG . 'image/data/products/' . $underfill;
		} else {
			$data['underfill'] = '';
			$data['thumb_underfill'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			$data['underfill_url'] = '';
		}


		
		
		if (isset($regions_scale)) { 
			$data['regions_scale'] = $regions_scale;
		} else {
			$data['regions_scale'] = '';
		}
		
		/*if (!empty($fills)) { 
			foreach($fills as $key=>$fill) {
				$data['fills'][] = array(
					'view_fill_index' => $key, 
					'fill_file' => $fill, 
					'image' =>  HTTPS_CATALOG . 'image/data/products/'.$fill,
					'thumb' => $this->model_tool_image->resize('data/products/'.$fill , 100, 100)
				);
			}
		} else {
			$data['fills'] = array();
			$data['fills'][] = array(
				'view_fill_index' => '0', 
				'fill_file' => 'default_fill.png', 
				'image' =>  HTTPS_CATALOG . 'image/data/products/default_fill.png',
				'thumb' => $this->model_tool_image->resize('data/products/default_fill.png' , 100, 100)
			);
		}*/
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$data['fills'] = array();
		if (!empty($fills)) { 
			foreach($fills as $key=>$fill) {
				$data['fills'][] = $this->load->controller('product/view/internalfill', array('view_index' => $data['view_index'], 'view_fill_index' => $key, 'fill_file' =>  $fill));
			}	
		} else {
			$data['fills'][] = $this->load->controller('product/view/internalfill', array('view_index' => $data['view_index']));
		}
		
		if (!empty($regions)) { 
			foreach($regions as $region) {
				$region['view_index'] = $data['view_index'];
				$data['regions'][] = $this->load->controller('product/region/internalform', $region);
			}	
		} else {
			$data['regions'] = array();
		}
		
		return $data;

	}
	
	
	public function fill($filter_data = array()) { 
		$data = $this->filldata($filter_data);
		$this->response->setOutput($this->load->view('product/add_fill.tpl',$data));
	}
	
	public function internalfill($filter_data = array()) { 
		$data = $this->filldata($filter_data);
		return $this->load->view('product/add_fill.tpl',$data);
	}
	
  	private function filldata($filter_data = array()) {
		$this->load->language('product/view');
		
		$this->load->model('tool/image');

		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		$data['text_clear'] = $this->language->get('text_clear');
		$data['button_fill'] = $this->language->get('button_fill');
		$data['token'] = $this->session->data['token'];
		
		if (isset($filter_data['view_index'])) { 
			$data['view_index'] = $filter_data['view_index'];
		} else {
			$data['view_index'] = $this->request->get['view_index'];
		}
		
		if (isset($filter_data['view_fill_index'])) { 
			$data['view_fill_index'] = $filter_data['view_fill_index'];
		} else {
			$data['view_fill_index'] = mt_rand();
		}
		
		if (isset($filter_data['fill_file'])) { 
			if(empty($filter_data['fill_file'])) {
				$data['fill_file'] = '';
				$data['image'] = '';
				$data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			} else {
				$data['fill_file'] = $filter_data['fill_file'];
				$data['image'] = HTTPS_CATALOG . 'image/data/products/'.$filter_data['fill_file'];
				$data['thumb'] = $this->model_tool_image->resize('data/products/'.$filter_data['fill_file'] , 100, 100);
			}
		} else {
			$data['fill_file'] = 'default_fill.png';
			$data['image'] = HTTPS_CATALOG . 'image/data/products/default_fill.png';
			$data['thumb'] = $this->model_tool_image->resize('data/products/default_fill.png' , 100, 100);
		}

		return $data;

	}
	
	public function upload_shade() {
		
		$this->language->load('product/form');
		
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
		
		if (!$this->user->hasPermission('modify', 'product/product')) {
			$json['error'] = $this->language->get('error_permission');
		}
 
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$file = md5(rand()) . '-' . basename($filename) ;
				
				if(move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'data/products/' . $file))
				{
					$json['filename'] = $file;
					$json['image'] = HTTPS_CATALOG . 'image/data/products/' . $file;
					
					$this->load->model('tool/image');
		
					$json['thumb'] = $this->model_tool_image->resize('data/products/' .$file, 100, 100);
					
					$json['success'] = $this->language->get('text_upload');
				} else {
					$json['error'] = $this->language->get('error_upload');
				}
			
			}
		}	

		$this->response->setOutput(json_encode($json));		
	}
	
	public function upload_fill() {
		
		$this->language->load('product/form');
		
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
		
		if (!$this->user->hasPermission('modify', 'product/product')) {
			$json['error'] = $this->language->get('error_permission');
		}
 
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$file = md5(rand()) . '-' . basename($filename) ;
				
				if(move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'data/products/' . $file))
				{
					$json['filename'] = $file;
					$json['image'] = HTTPS_CATALOG . 'image/data/products/' . $file;
					
					$this->load->model('tool/image');
		
					$json['thumb'] = $this->model_tool_image->resize('data/products/' .$file, 100, 100);
					
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
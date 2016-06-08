<?php
class ControllerProductRegion extends Controller {
	
	public function form($filter_data = array()) {
		$data = $this->formdata($filter_data);
		$this->response->setOutput($this->load->view('product/region_item.tpl',$data));
	}
	
	public function internalform($filter_data = array()) {
		$data = $this->formdata($filter_data);
		return $this->load->view('product/region_item.tpl',$data);
	}
	
  	public function formdata($filter_data = array()) {
		
		$this->load->language('product/region');
		
		$data['length_unit'] = $this->length->getUnit($this->config->get('config_length_class_id'));
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_width'] = sprintf($this->language->get('entry_width'),$data['length_unit']);
		$data['entry_height'] = sprintf($this->language->get('entry_height'),$data['length_unit']);
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_mask'] = $this->language->get('button_mask');
		
		$data['text_x'] = $this->language->get('text_x');
		$data['text_y'] = $this->language->get('text_y');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_mask'] = $this->language->get('text_mask');
		$data['text_clear'] = $this->language->get('text_clear');
		

		$data['token'] = $this->session->data['token'];
		
		if (!empty($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$this->load->model('product/product');
			$product = $this->model_product_product->getProduct($this->request->get['product_id']);	
			$default_region = $product['default_view'].'_'.$product['default_region'];
		}
		

		if (!empty($filter_data)) {
			$view_index = $filter_data['view_index'];
			$region_index = $filter_data['region_index'];
			$name = $filter_data['name'];
			$x = $filter_data['x'];
			$y = $filter_data['y'];
			$width = $filter_data['width'];
			$height = $filter_data['height'];
			$mask = $filter_data['mask'];
		}

		if (isset($view_index)) { 
			$data['view_index'] = $view_index;
		} else {
			$data['view_index'] = $this->request->get['view_index'];
		}
		
		if (isset($region_index)) { 
			$data['region_index'] = $region_index;
		} else {
			$data['region_index'] = mt_rand();
		}
		
		if (!empty($name)) { 
			$data['name'] = $name;
		} else {
			$data['name'] = 'print area';
		}
		
		if (!empty($x)) { 
			$data['x'] = $x;
		} else {
			$data['x'] = '10';
		}
		
		if (!empty($y)) { 
			$data['y'] = $y;
		} else {
			$data['y'] = '15';
		}

		if (!empty($width)) { 
			$data['width'] = $width;
		} else {
			$data['width'] = '10';
		}

		if (!empty($height)) { 
			$data['height'] = $height;
		} else {
			$data['height'] = '10';
		}

		$this->load->model('tool/image');
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (!empty($mask)) { 
			$data['mask'] = $mask;
			$data['thumb_mask'] = $this->model_tool_image->resize('data/products/' .$mask, 100, 100);
			$data['mask_url'] = HTTPS_CATALOG . 'image/data/products/' . $mask;
		} else {
			$data['mask'] = '';
			$data['thumb_mask'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			$data['mask_url'] = '';
		}

		if (isset($this->request->post['default_region'])) { 
			$data['default_region'] = $this->request->post['default_region'];
		} else if (isset($default_region)) { 
			$data['default_region'] = $default_region;
		} else {
			$data['default_region'] = '';
		}
		
		return $data;
	}

	public function upload_mask() {
		
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
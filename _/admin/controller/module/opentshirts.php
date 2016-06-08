<?php
class ControllerModuleOpentshirts extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/opentshirts');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('opentshirts', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/opentshirts', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');

		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['help_logo']	= $this->language->get('help_logo');
		$data['entry_template'] = $this->language->get('entry_template');
		$data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_video_tutorial_link'] = $this->language->get('entry_video_tutorial_link');
		$data['entry_home_button_link'] = $this->language->get('entry_home_button_link');
		$data['help_home_button_link']	= $this->language->get('help_home_button_link');
		$data['entry_printing_colors_limit'] = $this->language->get('entry_printing_colors_limit');

		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_upgrade'] = $this->language->get('tab_upgrade');
		$data['tab_business_center'] = $this->language->get('tab_business_center');
		$data['tab_about'] = $this->language->get('tab_about');
		$data['tab_downloads'] = $this->language->get('tab_downloads');

		$data['products_instr'] = $this->language->get('products_instr');
		$data['button_products'] = $this->language->get('button_products');
		$data['other_instr'] = $this->language->get('other_instr');
		$data['button_install'] = $this->language->get('button_install');
		$data['button_download'] = $this->language->get('button_download');
		$data['purchase_packs'] = $this->language->get('purchase_packs');
		$data['purchase_packs_title'] = $this->language->get('purchase_packs_title');
		$data['purchase_m7'] = $this->language->get('purchase_m7');
		$data['purchase_m7_title'] = $this->language->get('purchase_m7_title');


		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_save'] = $this->language->get('button_save');


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

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/opentshirts', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('module/opentshirts', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['opentshirts_config_logo'])) {
			$data['opentshirts_config_logo'] = $this->request->post['opentshirts_config_logo'];
		} else {
			$data['opentshirts_config_logo'] = $this->config->get('opentshirts_config_logo');
		}

		$this->load->model('tool/image');

		if ($this->config->get('opentshirts_config_logo') && file_exists(DIR_IMAGE . $this->config->get('opentshirts_config_logo')) && is_file(DIR_IMAGE . $this->config->get('opentshirts_config_logo'))) {
			$data['ot_logo'] = $this->model_tool_image->resize($this->config->get('opentshirts_config_logo'), 370, 70);
		} else {
			$data['ot_logo'] = $this->model_tool_image->resize('no_image.jpg', 370, 70);
		}

		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 370, 70);

		if (isset($this->request->post['opentshirts_video_tutorial_embed'])) {
			$data['opentshirts_video_tutorial_embed'] = $this->request->post['opentshirts_video_tutorial_embed'];
		} else {
			$data['opentshirts_video_tutorial_embed'] = $this->config->get('opentshirts_video_tutorial_embed');
		}

		if (isset($this->request->post['opentshirts_home_button_link'])) {
			$data['opentshirts_home_button_link'] = $this->request->post['opentshirts_home_button_link'];
		} else {
			$data['opentshirts_home_button_link'] = $this->config->get('opentshirts_home_button_link');
		}

		if (isset($this->request->post['opentshirts_printing_colors_limit'])) {
			$data['opentshirts_printing_colors_limit'] = $this->request->post['opentshirts_printing_colors_limit'];
		} else if($this->config->get('opentshirts_printing_colors_limit')) {
			$data['opentshirts_printing_colors_limit'] = $this->config->get('opentshirts_printing_colors_limit');
		} else {
			$data['opentshirts_printing_colors_limit'] = 5;
		}

		$data['config_template'] = $this->config->get('config_template');

		$data['themes'] = array();

		$directories = glob(DIR_CATALOG . 'view/theme/default/opentshirts/*', GLOB_ONLYDIR);

		foreach ($directories as $directory) {
			$data['themes'][] = basename($directory);
		}

		if (!$directories) {
			//$data['themes'][] = $this->language->get('text_none');
			$data['themes_warning'] = $this->language->get('themes_warning');
		}

		if (isset($this->request->post['opentshirts_theme'])) {
			$data['opentshirts_theme'] = $this->request->post['opentshirts_theme'];
		} else {
			$data['opentshirts_theme'] = $this->config->get('opentshirts_theme');
		}

		if (isset($this->request->get['tab']) && $this->request->get['tab']=="upgrade") {
			$data['show_upgrade_tab'] = true;
		} else {
			$data['show_upgrade_tab'] = false;
		}

		if (isset($this->request->get['tab']) && $this->request->get['tab']=="about") {
			$data['show_about_tab'] = true;
		} else {
			$data['show_about_tab'] = false;
		}

		$data['product_import_link'] = $this->url->link('opentshirts/product_export/form', 'token=' . $this->session->data['token'] , 'SSL');
		$data['install_packs_link'] = $this->url->link('content_pack/install', 'token=' . $this->session->data['token'] , 'SSL');
		$data['product_downloads'] = array(
			'products1' => array(
				'name' => $this->language->get('product_pack1'),
				'link' => 'https://www.dropbox.com/s/xheee52tajje80l/products-part-1.zip?dl=1',
			),
			'products2' => array(
				'name' => $this->language->get('product_pack2'),
				'link' => 'https://www.dropbox.com/s/51ctj0ybdxfwl09/products-part-2.zip?dl=1',
			),
			'products3' => array(
				'name' => $this->language->get('product_pack3'),
				'link' => 'https://www.dropbox.com/s/sz0p0yrmra19q0b/products-part-3.zip?dl=1',
			),
			'products4' => array(
				'name' => $this->language->get('product_pack4'),
				'link' => 'https://www.dropbox.com/s/4cxep8fqe4rftgl/products-part-4.zip?dl=1',
			),
		);

		$data['other_downloads'] = array(
			'art' 		=> array(
				'name'	=> $this->language->get('art_pack'),
				'link'	=> 'https://www.dropbox.com/s/3kjeusu9lrtso27/artsample.zip?dl=1',
			),
			'fonts' 	=> array(
				'name'	=> $this->language->get('font_pack'),
				'link'	=> 'https://www.dropbox.com/s/nm16qvhdb6ovczv/font-installer.zip?dl=1',
			),
		);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['upgrade_tab'] = $this->load->controller('module/opentshirts/upgrade_tab');


		$this->response->setOutput($this->load->view('module/opentshirts.tpl',$data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/opentshirts')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function theme_thumb() {
		$template = basename($this->request->get['template']);
		$theme = basename($this->request->get['theme']);

		if (file_exists(DIR_IMAGE . 'templates/' . $template . '/' . $theme . '.png')) {
			$image = HTTP_CATALOG . 'image/templates/' . $template . '/' . $theme . '.png';
		} else {
			$image = HTTP_CATALOG . 'image/no_image.jpg';
		}

		$this->response->setOutput('<img src="' . $image . '" alt="" title="" style="border: 1px solid #EEEEEE;" />');
	}


	public function uninstall() {
		$this->load->model('opentshirts/install');

		$this->model_opentshirts_install->uninstall();

	}
	public function install() {

		$this->load->model('opentshirts/install');

		$this->model_opentshirts_install->install();

	}

	public function upgrade_tab() {

		$this->load->language('module/opentshirts');

		$data['button_upgrade'] = $this->language->get('button_upgrade');

		$data['upgrade'] = $this->url->link('module/opentshirts/upgrade', 'token=' . $this->session->data['token'] , 'SSL');

		if (isset($this->session->data['success_upgrade'])) {
			$data['success'] = $this->session->data['success_upgrade'];

			unset($this->session->data['success_upgrade']);
		} else {
			$data['success'] = '';
		}


		return $this->load->view('opentshirts/upgrade_tab.tpl',$data);
	}

	public function upgrade() {

		$this->load->language('module/opentshirts');

		$file = DIR_APPLICATION . 'model/opentshirts/upgrade.sql';

		if (!file_exists($file)) {
			die('Could not load sql file: ' . $file);
		}

		if ($sql = file($file)) {

			$this->load->model('opentshirts/upgrade');

			$this->model_opentshirts_upgrade->mysql($sql);

			$this->session->data['success_upgrade'] = $this->language->get('text_success_upgrade');

			$this->response->redirect($this->url->link('module/opentshirts', 'token=' . $this->session->data['token'] . '&tab=upgrade', 'SSL'));
		} else {
			die('Could not read sql file: ' . $file);
		}

	}

}
?>
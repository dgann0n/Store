<?php 
class ControllerStudioRegister extends Controller {
	private $error = array();
	      
  	public function index() {
		
		if ($this->customer->isLogged()) {
      			$this->response->redirect($this->url->link('studio/login/welcome', '', 'SSL')); 
		}

		$this->language->load('studio/register');
				
		$this->load->model('account/customer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_account_customer->addCustomer($this->request->post);

			$this->customer->login($this->request->post['email'], $this->request->post['password']);
		  
			$this->response->redirect($this->url->link('studio/success', '', 'SSL'));
		} 
	
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_your_address'] = $this->language->get('text_your_address');
		$data['text_select'] = $this->language->get('text_select');
					
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
		
		$data['back'] = $this->url->link('studio/login', '', 'SSL'); 
    
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}	
		
		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}		
	
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		
		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['fax'])) {
			$data['error_fax'] = $this->error['fax'];
		} else {
			$data['error_fax'] = '';
		}
		
		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}
		
 		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}
		
  		if (isset($this->error['address_1'])) {
			$data['error_address_1'] = $this->error['address_1'];
		} else {
			$data['error_address_1'] = '';
		}
   		
		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}
		
		if (isset($this->error['postcode'])) {
			$data['error_postcode'] = $this->error['postcode'];
		} else {
			$data['error_postcode'] = '';
		}

		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}
		
		$data['action'] = $this->url->link('studio/register', '', 'SSL');

		if (isset($this->request->post['firstname'])) {
    			$data['firstname'] = $this->request->post['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
    			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = '';
		}
		
		if (isset($this->request->post['email'])) {
    			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['telephone'])) {
    			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
    			$data['fax'] = $this->request->post['fax'];
		} else {
			$data['fax'] = '';
		}
				
		if (isset($this->request->post['company'])) {
    			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = '';
		}
				
		if (isset($this->request->post['address_1'])) {
    			$data['address_1'] = $this->request->post['address_1'];
		} else {
			$data['address_1'] = '';
		}

		if (isset($this->request->post['postcode'])) {
    			$data['postcode'] = $this->request->post['postcode'];
		} else {
			$data['postcode'] = '';
		}
		
		if (isset($this->request->post['city'])) {
    			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} else {	
			$data['country_id'] = $this->config->get('config_country_id');
		}
	
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id']; 	
		} else {
			$data['zone_id'] = '';
		}
		
		$this->load->model('localisation/country');
		
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['password'])) {
    			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($this->request->post['confirm'])) {
    			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/studio/register.tpl')) {
			$template = $this->config->get('config_template') . '/template/studio/register.tpl';
		} else {
			$template = 'default/template/studio/register.tpl';
		}
						
		$this->response->setOutput($this->load->view($template,$data));	
  	}

  	private function validate() {
		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}
	
		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
	
		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}
	
		if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}
			
		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
	
		if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
			$this->error['address_1'] = $this->language->get('error_address_1');
		}
	
		if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
			$this->error['city'] = $this->language->get('error_city');
		}
	
		$this->load->model('localisation/country');
		
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
		
		if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
			$this->error['postcode'] = $this->language->get('error_postcode');
		}
	
		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}
			
		if ($this->request->post['zone_id'] == '') {
			$this->error['zone'] = $this->language->get('error_zone');
		}
	
		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}
	
		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}
			
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
  	}
  
  	public function zone() {
		$output = '<option value="">' . $this->language->get('text_select') . '</option>';
		
		$this->load->model('localisation/zone');

		$results = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);
		
		foreach ($results as $result) {
			$output .= '<option value="' . $result['zone_id'] . '"';
		
			if (isset($this->request->get['zone_id']) && ($this->request->get['zone_id'] == $result['zone_id'])) {
				$output .= ' selected="selected"';
			}
		
			$output .= '>' . $result['name'] . '</option>';
		} 
		
		if (!$results) {
		  	$output .= '<option value="0">' . $this->language->get('text_none') . '</option>';
		}
	
		$this->response->setOutput($output);
  	}  
}
?>
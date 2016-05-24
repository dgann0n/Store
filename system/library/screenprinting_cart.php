<?php
class ScreenprintingCart {
	private $config;
	private $session;
	private $db;
	private $cart;

  	public function __construct($config, $session, $db, $cart) {
		$this->config = $config;
		$this->session = $session;
		$this->db = $db;
		$this->cart = $cart;
	}
	public function getPrintData($product) {

		$return = array(
			'flag_remove' => false,
			'option_price' => 0,
			'option_data' => array()
		);

		if ( ! isset ( $product['id_composition'] ) ) {
			continue;
		}

		$id_composition = $product['id_composition'];

		// Options
		if (!empty($product['option'])) {
			$options = $product['option'];
		} else {
			trigger_error("options for printable product not defined: ", E_USER_ERROR);
		}

		$amount_products = $product['total_quantity'];


		$printing_prices = array();
		$query_printing_quantity = $this->db->query("SELECT quantity_index, screen_charge FROM " . DB_PREFIX . "screenprinting_quantity WHERE quantity <= " . (int)$amount_products . " ORDER BY quantity DESC LIMIT 1 ");
		if($query_printing_quantity->num_rows==0) {
			$return['flag_remove'] = true;
		} else {

			$quantity_index = $query_printing_quantity->row["quantity_index"]; //column to take prices from
			$screen_charge = $query_printing_quantity->row["screen_charge"];
			$query_printing_quantity_price = $this->db->query("SELECT price, num_colors FROM " . DB_PREFIX . "screenprinting_quantity_price WHERE quantity_index = " . (int)$quantity_index . " ");

			if($query_printing_quantity_price->num_rows==0) {
				$return['flag_remove'] = true;
			} else {

				foreach ($query_printing_quantity_price->rows as $result) {
					$printing_prices[$result["num_colors"]] = $result["price"];
				}
			}
		}

		$return['option_data'][] = array(
			'product_option_id'       => '',
			'product_option_value_id' => '',
			'option_id'               => '',
			'option_value_id'         => '',
			'name'                    => 'Printing Method',
			'value'            => 'Screenprinting',
			'type'                    => '',
			'quantity'                => '',
			'subtract'                => '',
			'price'                   => '0',
			'price_prefix'            => '+',
			'points'                  => '0',
			'points_prefix'           => '+',
			'weight'                  => '0',
			'weight_prefix'           => '+'
		);

		foreach ($options['views'] as $value) {

			$whitebase = (in_array($options['id_product_color'], $value['apply_white_base_array']))?" (+1 whitebase)":"";

			$printing_price = 0;
			$num_colors = $value['num_colors'];

			if(in_array($options['id_product_color'], $value['apply_white_base_array'])) {
				$num_colors = ($num_colors>0)?$num_colors+1:0; //add 1 color for whitebase
			}

			if($num_colors > 0) {
				$printing_price = $printing_prices[$num_colors];
				$return['option_price'] += $printing_prices[$num_colors];
			}

			$return['option_data'][] = array(
				'product_option_id'       => '',
				'product_option_value_id' => '',
				'option_id'               => '',
				'option_value_id'         => '',
				'name'                    => 'Colors to print on '.$value['name'],
				'value'            => $value['num_colors'].$whitebase,
				'type'                    => '',
				'quantity'                => '',
				'subtract'                => '',
				'price'                   => $printing_price,
				'price_prefix'            => '+',
				'points'                  => '0',
				'points_prefix'           => '+',
				'weight'                  => '0',
				'weight_prefix'           => '+'
			);
		}

		//add screencharge only once for every composition

		$screen_charge_id = 99999999999;

		$total_screens = 0;

		foreach ($options['views'] as $value) {
			$num_colors = $value['num_colors'];

			if(!empty($value['apply_white_base_array'])) {
				$num_colors = ($num_colors>0)?$num_colors+1:0; //add 1 color for whitebase
			}

			if($num_colors > 0) {
				$total_screens += $num_colors;
			}


		}

		$screen_options = array(
			'price'			=> $screen_charge,
			);

		$this->cart->addMiscPrintCharge($total_screens, $screen_options, $id_composition);

		return $return;
	}
}
?>
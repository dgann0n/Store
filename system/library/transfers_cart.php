<?php
class TransfersCart {
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

		$return['option_data'][] = array(
			'product_option_id'       => '',
			'product_option_value_id' => '',
			'option_id'               => '',
			'option_value_id'         => '',
			'name'                    => 'Printing Method',
			'value'            		  => 'Transfers',
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

		foreach ($options['views'] as $view) {

			$printing_price = 0;

			$printing_price = $this->getPrintingPricesFromQuantityArea($amount_products, (float)($view['area_size_w'] * $view['area_size_h']));
			if ($printing_price === false) {
				$return['flag_remove'] = true;
				return $return;
			} else {
				$num_elements = (int)$view["num_elements"];
                if($num_elements>0) {
					$return['option_price'] += $printing_price;

					$return['option_data'][] = array(
						'product_option_id'       => '',
						'product_option_value_id' => '',
						'option_id'               => '',
						'option_value_id'         => '',
						'name'                    => 'Print design on '.$view['name'],
						'value'            => $view['area_size_w'] . " x " . $view['area_size_h'],
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
			}

		}

		return $return;
	}

	private function getPrintingPricesFromQuantityArea($quantity, $area)
	{
	  $sql  = " SELECT quantity_index FROM " . DB_PREFIX . "transfers_printing_quantity  ";
	  $sql .= " WHERE quantity<=".(int)$quantity." ";
	  $sql .= " ORDER BY quantity DESC LIMIT 1 ";

	  $query = $this->db->query($sql);
	  if($query->num_rows==0) {
	    return false;
	  } else {

	    $quantity_index = $query->row["quantity_index"]; //column to take prices from

	    $sql  = " SELECT * FROM  " . DB_PREFIX . "transfers_printing_quantity_price ";
	    $sql .= " WHERE quantity_index=".(int)$quantity_index." AND area<=".(float)$area." ";
	    $sql .= " ORDER BY area DESC LIMIT 1 ";
	    $query = $this->db->query($sql);

	    if($query->num_rows==0) {
	      return false;
	    } else {
	      $price = $query->row["price"];
	      return $price;
	    }
	  }
	}
}
?>
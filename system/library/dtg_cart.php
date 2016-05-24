<?php
class DtgCart {
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
			'value'            		  => 'DTG',
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

			$whitebase_level = 1;
			if (in_array($options['id_product_color'], $view['apply_white_base_1_array'])) {
			  $whitebase_level = 2;
			} elseif (in_array($options['id_product_color'], $view['apply_white_base_2_array'])) {
				$whitebase_level = 3;
			}

			$printing_price = $this->getPrintingPricesFromQuantityArea($amount_products, (float)($view['area_size_w'] * $view['area_size_h']), $whitebase_level);
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

	private function getPrintingPricesFromQuantityArea($quantity, $area, $color_group = 1)
	{
	  $sql  = " SELECT quantity_index FROM " . DB_PREFIX . "dtg_printing_quantity  ";
	  $sql .= " WHERE quantity<=".(int)$quantity." ";
	  $sql .= " ORDER BY quantity DESC LIMIT 1 ";

	  $query = $this->db->query($sql);
	  if($query->num_rows==0) {
	    return false;
	  } else {

	    $quantity_index = $query->row["quantity_index"]; //column to take prices from

	    $sql  = " SELECT * FROM  " . DB_PREFIX . "dtg_printing_quantity_price ";
	    $sql .= " WHERE quantity_index=".(int)$quantity_index." AND area<=".(float)$area." ";
	    $sql .= " ORDER BY area DESC LIMIT 1 ";
	    $query = $this->db->query($sql);

	    if($query->num_rows==0) {
	      return false;
	    } else {
	      switch ($color_group) {
	        case 3:
	          $price = $query->row["price_whitebase_2"];
	          break;
	        case 2:
	          $price = $query->row["price_whitebase_1"];
	          break;
	        default:
	          $price = $query->row["price"];
	          break;
	      }
	      return $price;
	    }
	  }
	}
}
?>
<?php 
class ControllerXmlLanguage extends Controller { 
	public function index() {
		
		$this->language->load('studio/studio');

		$data['code'] = $this->language->get('code');
		
		$data['language'] = array();
		$data['language']['CLIPART_PROPERTIES'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['COLORS'] = $this->language->get('COLORS');
		$data['language']['COLOR'] = $this->language->get('COLOR');
		$data['language']['PRODUCTS'] = $this->language->get('PRODUCTS');
		$data['language']['CLIPART'] = $this->language->get('CLIPART');
		$data['language']['ADD_CLIPART'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['ADD_TEXT'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['SELECT_PRODUCT'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['SEARCH'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['VIEWS'] = $this->language->get('VIEWS');
		$data['language']['FULL_COLOR'] = $this->language->get('FULL_COLOR');
		$data['language']['DUO_COLOR'] = $this->language->get('DUO_COLOR');
		$data['language']['ONE_COLOR'] = $this->language->get('ONE_COLOR');
		$data['language']['INVERT'] = $this->language->get('INVERT');
		$data['language']['MOVE_TO_TOP'] = $this->language->get('MOVE_TO_TOP');
		$data['language']['MOVE_TO_BOTTOM'] = $this->language->get('MOVE_TO_BOTTOM');
		$data['language']['MOVE_FORWARD'] = $this->language->get('MOVE_FORWARD');
		$data['language']['MOVE_BACKWARD'] = $this->language->get('MOVE_BACKWARD');
		$data['language']['WIDTH'] = $this->language->get('WIDTH');
		$data['language']['HEIGHT'] = $this->language->get('HEIGHT');
		$data['language']['ROTATION'] = $this->language->get('ROTATION');
		$data['language']['X'] = $this->language->get('X');
		$data['language']['Y'] = $this->language->get('Y');
		$data['language']['LOCKED'] = $this->language->get('LOCKED');
		$data['language']['RESET_PROPORTIONS'] = $this->language->get('RESET_PROPORTIONS');
		$data['language']['TEXT'] = $this->language->get('TEXT');
		$data['language']['ENTER_TEXT'] = $this->language->get('ENTER_TEXT');
		$data['language']['FONT'] = $this->language->get('FONT');
		$data['language']['SPACING'] = $this->language->get('SPACING');
		$data['language']['TEXT_COLOR'] = $this->language->get('TEXT_COLOR');
		$data['language']['ALIGN_TO_BOTTOM'] = $this->language->get('ALIGN_TO_BOTTOM');
		$data['language']['ALIGN_TO_TOP'] = $this->language->get('ALIGN_TO_TOP');
		$data['language']['ALIGN_TO_LEFT'] = $this->language->get('ALIGN_TO_LEFT');
		$data['language']['ALIGN_TO_RIGHT'] = $this->language->get('ALIGN_TO_RIGHT');
		$data['language']['CENTER_VERTICAL'] = $this->language->get('CENTER_VERTICAL');
		$data['language']['CENTER_HORIZONTAL'] = $this->language->get('CENTER_HORIZONTAL');
		$data['language']['ARRANGE'] = $this->language->get('ARRANGE');
		$data['language']['ALIGN'] = $this->language->get('ALIGN');
		$data['language']['ZOOM_IN'] = $this->language->get('ZOOM_IN');
		$data['language']['ZOOM_TO_AREA'] = $this->language->get('ZOOM_TO_AREA');
		$data['language']['ZOOM_OUT'] = $this->language->get('ZOOM_OUT');
		$data['language']['FILTERS'] = $this->language->get('FILTERS');
		$data['language']['FILTER_COLOR'] = $this->language->get('FILTER_COLOR');
		$data['language']['SELECT_FILTER'] = $this->language->get('SELECT_FILTER');
		$data['language']['THICKNESS'] = $this->language->get('THICKNESS');
		$data['language']['DISTANCE'] = $this->language->get('DISTANCE');
		$data['language']['ANGLE'] = $this->language->get('ANGLE');
		$data['language']['OUTLINE'] = $this->language->get('OUTLINE');
		$data['language']['SHADOW'] = $this->language->get('SHADOW');
		$data['language']['VISIBLE'] = $this->language->get('VISIBLE');
		$data['language']['TEXT_EFFECT'] = $this->language->get('TEXT_EFFECT');
		$data['language']['ADJUST_EFFECTS'] = $this->language->get('ADJUST_EFFECTS');
		$data['language']['SELECT_FONT'] = $this->language->get('SELECT_FONT');
		$data['language']['SELECT_SHAPE'] = $this->language->get('SELECT_SHAPE');
		$data['language']['COLORS_USED'] = $this->language->get('COLORS_USED');
		$data['language']['SELECT_LAYERS_TO_TINT'] = $this->language->get('SELECT_LAYERS_TO_TINT');
		$data['language']['SAVE_DESIGN'] = $this->language->get('SAVE_DESIGN');
		$data['language']['SELECT_PRODUCT_FIRST'] = $this->language->get('SELECT_PRODUCT_FIRST');
		$data['language']['EXPORT_IMAGE'] = $this->language->get('EXPORT_IMAGE');
		$data['language']['PRODUCT_COLORS'] = $this->language->get('PRODUCT_COLORS');
		$data['language']['OBJECT_PROPERTIES'] = $this->language->get('OBJECT_PROPERTIES');
		$data['language']['CLIPART_PROPERTIES'] = $this->language->get('CLIPART_PROPERTIES');
		$data['language']['COLOR_PALETTE'] = $this->language->get('COLOR_PALETTE');
		$data['language']['SELECT_ALL'] = $this->language->get('SELECT_ALL');
		$data['language']['FIT_TO_AREA'] = $this->language->get('FIT_TO_AREA');
		$data['language']['FLIP_H'] = $this->language->get('FLIP_H');
		$data['language']['FLIP_V'] = $this->language->get('FLIP_V');
		$data['language']['PRODUCT_PROPERTIES_HELP1'] = $this->language->get('PRODUCT_PROPERTIES_HELP1');		
		$data['language']['PRODUCT_PROPERTIES_HELP2'] = $this->language->get('PRODUCT_PROPERTIES_HELP2');
		$data['language']['COLOR_USED_HELP'] = $this->language->get('COLOR_USED_HELP');
		$data['language']['UNDO'] = $this->language->get('UNDO');
		$data['language']['REDO'] = $this->language->get('REDO');
		$data['language']['DUPLICATE'] = $this->language->get('DUPLICATE');
		$data['language']['CLEAR_SELECTION'] = $this->language->get('CLEAR_SELECTION');
		$data['language']['TEXT_SHAPE'] = $this->language->get('TEXT_SHAPE');
		$data['language']['SELECT_TEXT_SHAPE'] = $this->language->get('SELECT_TEXT_SHAPE');
		$data['language']['SET_TEXT_OUTLINES'] = $this->language->get('SET_TEXT_OUTLINES');
		$data['language']['CLICK_ENABLE_OUTLINES'] = $this->language->get('CLICK_ENABLE_OUTLINES');
		$data['language']['PRODUCT_CATALOG_BUTTON'] = $this->language->get('PRODUCT_CATALOG_BUTTON');
		$data['language']['PRODUCT_INFORMATION'] = $this->language->get('PRODUCT_INFORMATION');
		$data['language']['PRINT_LOCATIONS'] = $this->language->get('PRINT_LOCATIONS');
		$data['language']['TEXT_HOVER_IMAGE'] = $this->language->get('TEXT_HOVER_IMAGE');
		$data['language']['AVAILABLE_PRINT_LOCATIONS'] = $this->language->get('AVAILABLE_PRINT_LOCATIONS');
		
		$this->response->addHeader("Content-type: text/xml");
		$this->response->setOutput($this->load->view('default/template/xml/language.tpl',$data));
  	}
}
?>
# OPENCART UPGRADE SCRIPT v1.5.x
# WWW.OPENCART.COM
# Qphoria

# DO NOT RUN THIS ENTIRE FILE MANUALLY THROUGH PHPMYADMIN OR OTHER MYSQL DB TOOL
# THIS FILE IS GENERATED FOR USE WITH THE UPGRADE.PHP SCRIPT LOCATED IN THE INSTALL FOLDER
# THE UPGRADE.PHP SCRIPT IS DESIGNED TO VERIFY THE TABLES BEFORE EXECUTING WHICH PREVENTS ERRORS

# IF YOU NEED TO MANUALLY RUN THEN YOU CAN DO IT BY INDIVIDUAL VERSIONS. EACH SECTION IS LABELED.
# BE SURE YOU CHANGE THE PREFIX "oc_" TO YOUR PREFIX OR REMOVE IT IF NOT USING A PREFIX

# Version 1.0.5

ALTER TABLE `ot_design_color` ADD `sort` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '';
ALTER TABLE `ot_printable_product_view_region` ADD `mask` varchar(255) COLLATE utf8_bin COMMENT '';
ALTER TABLE `ot_printable_product` ADD `printable_status` TINYINT(1) NULL DEFAULT '1';
ALTER TABLE `ot_printable_product_view` ADD `underfill` VARCHAR(255) NULL DEFAULT NULL;

UPDATE `ot_setting` SET `key` = 'opentshirts_autoselect_enabled' WHERE `key` = 'ot_enable_autoselect';
UPDATE `ot_setting` SET `key` = 'opentshirts_autoselect_quantities' WHERE `key` = 'ot_quantities';
UPDATE `ot_setting` SET `key` = 'opentshirts_autoselect_descriptions' WHERE `key` = 'ot_descriptions';
UPDATE `ot_setting` SET `key` = 'opentshirts_autoselect_pm' WHERE `key` = 'ot_pm';
UPDATE `ot_setting` SET `key` = 'opentshirts_autoselect_title_text' WHERE `key` = 'ot_title_text';

UPDATE `ot_setting` SET `key` = 'opentshirts_max_product_color_combination' WHERE `key` = 'config_max_product_color_combination';
UPDATE `ot_setting` SET `key` = 'opentshirts_config_logo' WHERE `key` = 'ot_config_logo';
UPDATE `ot_setting` SET `key` = 'opentshirts_video_tutorial_embed' WHERE `key` = 'video_tutorial_embed';
UPDATE `ot_setting` SET `key` = 'opentshirts_home_button_link' WHERE `key` = 'home_button_link';
UPDATE `ot_setting` SET `key` = 'opentshirts_printing_colors_limit' WHERE `key` = 'printing_colors_limit';
UPDATE `ot_setting` SET `key` = 'opentshirts_theme' WHERE `key` = 'config_theme';

UPDATE `ot_setting` SET `key` = 'opentshirts_setting_product_color_option_id', `code` = 'opentshirts_setting' WHERE `key` = 'product_color_option_id';
UPDATE `ot_setting` SET `key` = 'opentshirts_setting_product_size_option_id', `code` = 'opentshirts_setting' WHERE `key` = 'product_size_option_id';

ALTER TABLE `ot_composition` ADD FULLTEXT (`name`);

# FOR OC 2.1+ - add new compositions_cart_product
CREATE TABLE IF NOT EXISTS `ot_composition_to_cart_item` (
	`id_composition` char(36) COLLATE utf8_bin NOT NULL,
	`cart_id` int(11) NOT NULL,
	PRIMARY KEY (`id_composition`,`cart_id`),
	KEY `fk_id_composition` (`id_composition`),
	KEY `fk_order_id` (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `ot_composition_to_order_item` (
	`id_composition` char(36) COLLATE utf8_bin NOT NULL,
	`order_product_id` int(11) NOT NULL,
	PRIMARY KEY (`id_composition`,`order_product_id`),
	KEY `fk_id_composition` (`id_composition`),
	KEY `fk_order_id` (`order_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
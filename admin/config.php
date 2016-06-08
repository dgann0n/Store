<?php
// DIR
define('DIR_APPLICATION', '/home/redwoodtechlinux/public_html/novusprintflow.com/admin/');
define('DIR_SYSTEM', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/');
define('DIR_LANGUAGE', '/home/redwoodtechlinux/public_html/novusprintflow.com/admin/language/');
define('DIR_TEMPLATE', '/home/redwoodtechlinux/public_html/novusprintflow.com/admin/view/template/');
define('DIR_CONFIG', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/config/');
define('DIR_CATALOG', '/home/redwoodtechlinux/public_html/novusprintflow.com/catalog/');
// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');

$serverName = str_replace("www.", "", strtolower($_SERVER['SERVER_NAME']));
if ($serverName=='novusprintflow.com') {
	// novusprintflow.com
	// DIR
	define('DIR_IMAGE', '/home/redwoodtechlinux/public_html/novusprintflow.com/image/');
	define('IMAGESUBDIR_CATALOG', 'Catalog_Novus');
	define('DIR_CACHE', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storage/cache/');
	define('DIR_DOWNLOAD', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storage/download/');
	define('DIR_LOGS', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storage/logs/');
	define('DIR_MODIFICATION', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storage/modification/');
	define('DIR_UPLOAD', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storage/upload/');
	// HTTP, HTTPS
	define('HTTP_SERVER', 'http://www.novusprintflow.com/admin/');
	define('HTTP_CATALOG', 'http://www.novusprintflow.com/');
	define('HTTPS_SERVER', 'http://www.novusprintflow.com/admin/');
	define('HTTPS_CATALOG', 'http://www.novusprintflow.com/');
	// DB
	define('DB_USERNAME', 'dgannon');
	define('DB_PASSWORD', '@Boston1991');
	define('DB_DATABASE', 'novusprintflow');
} else{
	// fake site
	// DIR
	define('DIR_IMAGE', '/home/redwoodtechlinux/public_html/novusprintflow.com/image/');
	define('IMAGESUBDIR_CATALOG', 'Catalog_FakeStore');
	define('DIR_CACHE', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storageFakeStore/cache/');
	define('DIR_DOWNLOAD', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storageFakeStore/download/');
	define('DIR_LOGS', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storageFakeStore/logs/');
	define('DIR_MODIFICATION', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storageFakeStore/modification/');
	define('DIR_UPLOAD', '/home/redwoodtechlinux/public_html/novusprintflow.com/system/storageFakeStore/upload/');
	// HTTP, HTTPS
	define('HTTP_SERVER', 'http://fakestore.novusprintflow.com/admin/');
	define('HTTP_CATALOG', 'http://fakestore.novusprintflow.com/');
	define('HTTPS_SERVER', 'http://fakestore.novusprintflow.com/admin/');
	define('HTTPS_CATALOG', 'http://fakestore.novusprintflow.com/');
	// DB
    	define('DB_USERNAME', 'dgannon');
    	define('DB_PASSWORD', '@Boston1991');
	define('DB_DATABASE', 'NewStoreTemp');
	
	
}




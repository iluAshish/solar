<?php

date_default_timezone_set('America/New_York');

$BASE_URL = 'http://admin.test/';

define("HOSTNAME", 'localhost');
define("USERNAME", "root");
define("PASSWORD", '');
define("DATABASE", "u923514998_solar_admin");
// $BASE_URL = 'https://' . $_SERVER['HTTP_HOST'] . '/';
define("EMAIL_PASSWORD", "JAY@deep123");
define("EMAILID",'riyom.infotech@gmail.com');
define("WEBSITE_NAME", "Scopnix Solar");
define("WEBSITE_EMAIL", "riyom.infotech@gmail.com");


define('UPLOAD_DIR', 'uploads/');
define('UPLOAD', '/uploads/');
define('PRODUCT_DIR', 'products/');
define('USERS', 'users/');

define('BASE_URL', $BASE_URL);
define('DEFAULT_AVATAR', BASE_URL.'admin/assets/img/profiles/default_avatar_wogjep.jpg');

define('UNKNOWN_ERROR', 'There was an unknown error that occurred. You will need to refresh the page to continue working.');

define('HEADER_DETAILS', '<li class="text-primary"><b>Authorization</b> :Basic YWRtaW46YWRtaW4= (username : admin , Password : admin)</li><li class="text-primary"><b>X-SIMPLE-API-KEY</b> : ow400c888s4c8wck8w0c0w8co0kc00o0wgoosw80</li><li class="text-primary"><b>X-SIMPLE-LOGIN-TOKEN</b> : login after get</li><li class="text-primary">User-Id : login after get</li>');

define('API_HEADER_DETAILS', '<li class="text-primary"><b>Authorization</b> :Basic YWRtaW46YWRtaW4= (username : admin , Password : admin</li><li class="text-primary"><b>X-SIMPLE-API-KEY</b> : ow400c888s4c8wck8w0c0w8co0kc00o0wgoosw80</li>');

define('CASHFREE_VERI_CLIENTID','CF32970CUO2V7E1DJ6C738J886G');
define('CASHFREE_VERI_SECRET_KEY','cfsk_ma_prod_99000f521098fc3c43315876eb047799_38a4755c');
define('CF_APP_ID', 'TEST104317514bc1e4513feedf5a172315713401'); // Replace with your test app id
define('CF_SECRET_KEY', 'cfsk_ma_test_a483778104a02d5d1af5fe996b164add_da4ea158'); // Replace with your test secret key
define('CF_API_BASE_URL', 'https://sandbox.cashfree.com/pg/'); // Test environment URL
define('CF_RETURN_URL', $BASE_URL.'payments/cfReturn/?order_id={order_id}'); // Test environment URL
define('CF_WEBHOOK_URL', $BASE_URL.'payments/cfWebhook'); // Test environment URL

?>
<?php




require_once WEB_ROOT. '/includes/lib/upacp_sdk_php/utf8/func/log.class.php';
define('SDK_CVN2_ENC', 0);
define('SDK_DATE_ENC', 0);
define('SDK_PAN_ENC', 0);

define('SDK_FRONT_TRANS_URL', $configs['qtjyqqdz']);
define('SDK_BACK_TRANS_URL', 'https://gateway.95516.com/gateway/api/backTransReq.do');
define('SDK_BATCH_TRANS_URL', 'https://gateway.95516.com/gateway/api/batchTrans.do');
define('SDK_SINGLE_QUERY_URL', 'https://gateway.95516.com/gateway/api/batchTrans.do');
define('SDK_FILE_QUERY_URL', 'https://filedownload.95516.com/');
define('SDK_Card_Request_Url', 'https://gateway.95516.com/gateway/api/cardTransReq.do');
define('SDK_App_Request_Url', 'https://gateway.95516.com/gateway/api/appTransReq.do');

define('SDK_FRONT_NOTIFY_URL', WEBSITE_ROOT.'notify/unionpay_front_url.php');
define('SDK_BACK_NOTIFY_URL', WEBSITE_ROOT.'notify/unionpay_return_url.php');
define('SDK_FILE_DOWN_PATH', 0);
define('SDK_LOG_FILE_PATH', WEBSITE_ROOT . '/cache/');
define('SDK_LOG_LEVEL', PhpLog::OFF);

define('SDK_SIGN_CERT_PATH', WEB_ROOT . $configs['shsy']);
define('SDK_SIGN_CERT_PWD', $configs['bank_pwd']);
define('SDK_ENCRYPT_CERT_PATH',WEB_ROOT . $configs['ylgy']);
define('SDK_VERIFY_CERT_DIR', WEB_ROOT."/config/bank_key/");
define('SDK_VERIFY_CERT_PATH', WEB_ROOT . $configs['ylgy']);
define('SDK_MERID', $configs['merid']);

include_once WEB_ROOT. '/includes/lib/upacp_sdk_php/utf8/func/common.php';
include_once WEB_ROOT. '/includes/lib/upacp_sdk_php/utf8/func/secureUtil.php';
include_once WEB_ROOT. '/includes/lib/upacp_sdk_php/utf8/func/PublicEncrypte.php';
include_once WEB_ROOT. '/includes/lib/upacp_sdk_php/utf8/func/PinBlock.php';
<?php



function sign(&$params) {
	if(isset($params['transTempUrl'])){
		unset($params['transTempUrl']);
	}
		$params_str = coverParamsToString ( $params );
	
	$params_sha1x16 = sha1 ( $params_str, FALSE );
		$cert_path = SDK_SIGN_CERT_PATH;
	$private_key = getPrivateKey ( $cert_path );
		$sign_falg = openssl_sign ( $params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1 );
	if ($sign_falg) {
		$signature_base64 = base64_encode ( $signature );
		$params ['signature'] = $signature_base64;
	} else {
	}
}


function verify($params) {
		$public_key = getPulbicKeyByCertId ( $params ['certId'] );	
		$signature_str = $params ['signature'];
	unset ( $params ['signature'] );
	$params_str = coverParamsToString ( $params );
	$signature = base64_decode ( $signature_str );
	$params_sha1x16 = sha1 ( $params_str, FALSE );
	$isSuccess = openssl_verify ( $params_sha1x16, $signature,$public_key, OPENSSL_ALGO_SHA1 );
	return $isSuccess;
}


function getPulbicKeyByCertId($certId) {
		$cert_dir = SDK_VERIFY_CERT_DIR;
	$handle = opendir ( $cert_dir );
	if ($handle) {
		while ( $file = readdir ( $handle ) ) {
			clearstatcache ();
			$filePath = $cert_dir . '/' . $file;
			if (is_file ( $filePath )) {
				if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'cer') {
					if (getCertIdByCerPath ( $filePath ) == $certId) {
						closedir ( $handle );
						return getPublicKey ( $filePath );
					}
				}
			}
		}
	} else {
	}
	closedir ( $handle );
	return null;
}


function getCertId($cert_path) {
	$pkcs12certdata = file_get_contents ( $cert_path );

	openssl_pkcs12_read ( $pkcs12certdata, $certs, SDK_SIGN_CERT_PWD );
	$x509data = $certs ['cert'];
	openssl_x509_read ( $x509data );
	$certdata = openssl_x509_parse ( $x509data );
	$cert_id = $certdata ['serialNumber'];
	return $cert_id;
}


function getCertIdByCerPath($cert_path) {
	$x509data = file_get_contents ( $cert_path );
	openssl_x509_read ( $x509data );
	$certdata = openssl_x509_parse ( $x509data );
	$cert_id = $certdata ['serialNumber'];
	return $cert_id;
}


function getSignCertId() {
		
	return getCertId ( SDK_SIGN_CERT_PATH );
}
function getEncryptCertId() {
		return getCertIdByCerPath ( SDK_ENCRYPT_CERT_PATH );
}


function getPublicKey($cert_path) {
	return file_get_contents ( $cert_path );
}

function getPrivateKey($cert_path) {
	$pkcs12 = file_get_contents ( $cert_path );
	openssl_pkcs12_read ( $pkcs12, $certs, SDK_SIGN_CERT_PWD );
	
	return $certs ['pkey'];
}


function encryptPan($pan) {
	$cert_path = MPI_ENCRYPT_CERT_PATH;
	$public_key = getPublicKey ( $cert_path );
	
	openssl_public_encrypt ( $pan, $cryptPan, $public_key );
	return base64_encode ( $cryptPan );
}

function encryptPin($pan, $pwd) {
	$cert_path = SDK_ENCRYPT_CERT_PATH;
	$public_key = getPublicKey ( $cert_path );

	return EncryptedPin ( $pwd, $pan, $public_key );
}

function encryptCvn2($cvn2) {
	$cert_path = SDK_ENCRYPT_CERT_PATH;
	$public_key = getPublicKey ( $cert_path );
	
	openssl_public_encrypt ( $cvn2, $crypted, $public_key );
	
	return base64_encode ( $crypted );
}

function encryptDate($certDate) {
	$cert_path = SDK_ENCRYPT_CERT_PATH;
	$public_key = getPublicKey ( $cert_path );
	
	openssl_public_encrypt ( $certDate, $crypted, $public_key );
	
	return base64_encode ( $crypted );
}


function encryptDateType($certDataType) {
	$cert_path = SDK_ENCRYPT_CERT_PATH;
	$public_key = getPublicKey ( $cert_path );

	openssl_public_encrypt ( $certDataType, $crypted, $public_key );

	return base64_encode ( $crypted );
}

?>
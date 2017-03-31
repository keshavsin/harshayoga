<?php
$email = 'WWV3YWQrK1BpVExUVWFpMXhiZ0pUaW80M1hjK01aSDVnTFd4SUwrSWc4bz0=';
function my_simple_crypt( $string, $action = 'e' ) {
$secret_key = 'D69e4K13w9KFFly5J3wHcCG3MNa';
$secret_iv = 'S8TW2ET26nem';
$output = false;
$encrypt_method = "AES-256-CBC";
$key = hash( 'sha256', $secret_key );
$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
}
return $output;
}
$activation_lnk = my_simple_crypt( $email, 'd' );
echo $activation_lnk;
 ?>

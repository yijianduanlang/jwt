<?php
use \JWT\JWT;
require __DIR__ . '/JWT.php';
//默认使用的是hs256加密方式：对称加密；加密解密使用同一秘钥
//https://github.com/firebase/php-jwt

/*$key = "example_key";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$jwt = JWT::encode($token, $key);

JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key, array('HS256'));

print_r($decoded);*/


//为了安全起见，使用rs256非对称加密方式加密
$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIICeQIBADANBgkqhkiG9w0BAQEFAASCAmMwggJfAgEAAoGBAN4sbpMBCT0RKJ2s
Vbjozdjss5WUdFPcAowxziPj2njpp2kfdAFsjDXQk3N6jVNUsZ1YJ9Yh1vl64Mi4
nrGLSPq8P85LEis025rjqivHyxTfNMqQA4/qaH6RwqgfVdVcfsUHlAxwTPjhrnnG
+iAqa3da3EJYwudyzfsRbxPBFFx5AgMBAAECgYEAsxYHr5FnPAVHwwj2NE3cF958
x7bZqfsvRoijDIUPRuW432DOJpOz1XEiWjRQFPqxDQ7RVacDXSgyZzmCGcUXdhyo
l7EiX7REKmVBDf7pC736JlFk6rIoVpG//P9jzp/BuYtADiH52nwPrf1NAUIYzNrg
w9pLtBYbCNZfm+I1NDECQQDwXe56sI2rW+BnSLqoGQCpI86eB9XeI5J/XI7jJWd3
EA1l5ICvqzNCWvPM6nzSQbOSLapLPysYm6S99ty611tlAkEA7J+VhC6wgZEQc7V9
ZOHBcjXtvmpyp/xdPYBYhGy5JaokdpyMNnK3Coie7JRbmAr87zbmHefrlRqmc+qR
29rNhQJBAKLLy7BXEayErqjlbl5ZiMQF13Pa9LPePeN66d/YPoo6WgivyaSw/Cet
+D/KdT3md9vCh/sszmB9UgfDQd5d660CQQDOMLGFIXpFLTd83KWMBv0enMeyqeeH
Ym2Nbg20N1mO7Jghk4DK4WOHFk4GMbEu6ERH3zrezH2IzFRHphu7zQpRAkEAlP91
/5zt8YE/HV2tu+5NY4y7lqWnwgtbio3hArW5Wg2Sc1phERm4oxoAADH6qm80QtUE
rE0qbv3wWkR1uIEyCw==
-----END PRIVATE KEY-----
EOD;

$publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDeLG6TAQk9ESidrFW46M3Y7LOV
lHRT3AKMMc4j49p46adpH3QBbIw10JNzeo1TVLGdWCfWIdb5euDIuJ6xi0j6vD/O
SxIrNNua46orx8sU3zTKkAOP6mh+kcKoH1XVXH7FB5QMcEz44a55xvogKmt3WtxC
WMLncs37EW8TwRRceQIDAQAB
-----END PUBLIC KEY-----
EOD;
$token = array(
    "iss" => "签发主题",
    "aud" => "代表这个JWT的接收对象",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$jwt = JWT::encode($token, $privateKey, 'RS256');
echo "Encode:\n" . print_r($jwt, true) . "\n".'<br>';

$decoded = JWT::decode($jwt, $publicKey, array('RS256'));
/*
注意：现在这将是一个对象而不是一个关联数组。要获得
关联数组，您需要将其转换为：
*/
$decoded_array = $decoded;
echo "Decode:\n" . print_r($decoded_array, true) . "\n";
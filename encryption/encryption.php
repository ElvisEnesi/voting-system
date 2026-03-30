<?php
    // encryption settings
    $my_key = "my_super_key_2026";
    $method = "aes-256-cbc";

    function encrypt_data($data) {
        global $my_key, $method;

        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $encrypted = openssl_encrypt($data, $method, $my_key, 0, $iv);

        // store IV + encrypted data
        return base64_encode($iv . $encrypted);
    }

    function decrypt_data($data) {
        global $my_key, $method;

        $data = base64_decode($data);

        $iv_length = openssl_cipher_iv_length($method);

        $iv = substr($data, 0, $iv_length);
        $encrypted = substr($data, $iv_length);

        return openssl_decrypt($encrypted, $method, $my_key, 0, $iv);
    }
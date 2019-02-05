<?php

namespace App;

class EduTatarAuth {
    private function etap1($login, $password) {
        $post = [
            "main_login" => $login,
            "main_password" => $password
        ];

        $ch = curl_init('https://edu.tatar.ru/logon');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36",
            "Referer: https://edu.tatar.ru/logon"
        ));
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo curl_error($ch);
        }

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        return $cookies["DNSID"];
    }

    private function etap2($key) {
        $ch = curl_init("https://edu.tatar.ru/start/logon-process");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36",
            "Referer: https://edu.tatar.ru/logon",
            "Cookie: DNSID=$key"
        ));
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo curl_error($ch);
        }

        // close the connection, release resources used
        curl_close($ch);
        return $key;
    }

    private function etap3($key) {
        $ch = curl_init("https://edu.tatar.ru/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36",
            "Referer: https://edu.tatar.ru/logon-process",
            "Cookie: DNSID=$key"
        ));
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo curl_error($ch);
        }

        // close the connection, release resources used
        curl_close($ch);
        return $response;
    }

    private function etap4($response) {
        if (!preg_match_all('#IТ-лицей#ms', $response, $matches2))
            return null;
        preg_match_all('/<td>Имя:.+?<b>(.+?)<\/b></ms', $response, $matches1);
        return $matches1[1][0];
    }

    public function login($login, $password) {
        $a = $this->etap1($login, $password);
        $a = $this->etap2($a);
        $a = $this->etap3($a);
        $a = $this->etap4($a);

        if (!$a)
            return $a;

        $a = explode(' ', $a);
        return User::where("family_name", $a[0])
                   ->where("given_name", $a[1])
                   ->where("father_name", $a[2])
                   ->first();
    }
}

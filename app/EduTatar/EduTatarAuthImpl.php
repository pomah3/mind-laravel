<?php

namespace App\EduTatar;
use Illuminate\Support\Facades\Cache;

class EduTatarAuthImpl implements EduTatarAuth {
    private $link = "https://edu.tatar.ru";

    private function get_curl($url) {
        $curl = curl_init($this->link . $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_COOKIEFILE, "");

        return $curl;
    }

    private function set_headers($curl, $headers = []) {
        $arr = collect([
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36",
            "Referer: ".$this->link
        ]);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $arr->merge($headers)->all());
    }

    private function get_post($url, $post) {
        $curl = $this->get_curl($url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

        $this->set_headers($curl);

        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }

    private function get_cookies($page) {
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $page, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        return $cookies;
    }

    public function get_key($login, $password) {
        return Cache::remember("edu.$login.dnsid", 30, function() use ($login, $password) {
            $page = $this->get_post("/logon", [
                "main_login" => $login,
                "main_password" => $password
            ]);

            $cookies = $this->get_cookies($page);
            return $cookies["DNSID"];
        });
    }

    public function get_page($url, $key) {
        $curl = $this->get_curl($url);
        $this->set_headers($curl, [
            "Cookie: DNSID=$key"
        ]);

        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }

    public function get_user($login, $password) {
        $key = $this->get_key($login, $password);
        $page = $this->get_page("/", $key);

        if (!preg_match('#IТ-лицей#ms', $page))
            return null;
        preg_match_all('/<td>Имя:.+?<b>(.+?)<\/b></ms', $page, $matches);
        $name = $matches[1][0];

        $a = explode(' ', $name);
        return \App\User::where("family_name", $a[0])
                   ->where("given_name", $a[1])
                   ->where("father_name", $a[2])
                   ->first();
    }
}

<?php

namespace App\EduTatar;

interface EduTatarAuth {
    public function get_key($login, $password);
    public function get_page($url, $key);

    public function get_user($login, $password);
}

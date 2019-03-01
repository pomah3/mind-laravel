<?php

namespace App;

class Roles {
    const ADMIN = "admin";
    const MODERATOR = "moderator";

    const TEACHER  = "teacher";
    const DIRIC    = "diric";
    const PREDMET  = "predmet";
    const ZAM      = "zam";
    const CLASSRUK = "classruk";
    const PEDORG   = "pedorg";
    const SOCPED   = "socped";
    const MEDIC    = "medic";
    const VOSPIT   = "vospit";

    const STUDENT   = "student";
    const PRESIDENT = "president";
    const SECRETAR  = "secretar";
    const DEPUTAT   = "deputat";
    const STAROSTA  = "starosta";
    const AUCTIONER = "auctioner";

    public static function get_all_roles() {
        $class = new \ReflectionClass(static::class);
        $consts = $class->getConstants();
        return array_values($consts);
    }
}

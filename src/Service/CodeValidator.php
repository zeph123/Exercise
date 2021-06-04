<?php

declare(strict_types=1);

namespace App\Service;

class CodeValidator 
{
    // regexp
    // ^0{4,}[0-9]+(1M)*$
    private $pattern = "^0{4,}[0-9]+(1M)*$";

    public function validateCode(string $number) : bool
    {
        // correct code
        // dump(preg_match("/$this->pattern/", "000000049617410"));
        // incorrect code
        // dump(preg_match("/$this->pattern/", "000126472561551"));
        // die;

        if(preg_match("/$this->pattern/", $number)) {
            return true;
        } else {
            return false;
        }
    }

}
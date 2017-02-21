<?php

namespace Jac\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JacUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}

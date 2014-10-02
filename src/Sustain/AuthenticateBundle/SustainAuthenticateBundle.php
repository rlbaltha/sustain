<?php

namespace Sustain\AuthenticateBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SustainAuthenticateBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

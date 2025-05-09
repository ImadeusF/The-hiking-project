<?php

namespace Application\Controllers\User;

class Logout
{
    public function execute()
    {
        //session_start();
        session_destroy();
        header('Location: ' . BASE_PATH);
        exit();
    }
}

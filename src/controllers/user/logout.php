<?php
namespace Application\Controllers\User;

class Logout
{
    public function execute()
    {
        //session_start();
        session_destroy();
        echo "<script>window.location.href='" . BASE_PATH . "'</script>";
    }
}
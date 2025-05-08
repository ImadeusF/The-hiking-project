<?php
namespace Application\Controllers;

class Footer
{
    public function execute()
    {
        require(__DIR__ . '/../view/footer.view.php');
    }
}
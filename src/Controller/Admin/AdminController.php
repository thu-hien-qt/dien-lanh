<?php
namespace App\Ecommerce\Controller\Admin;

use App\Ecommerce\Kernel\Router;

abstract class AdminController
{
    public function checkPermission() {
        if(!isset($_SESSION["name"])) {
            $router = new Router;
            $router->redirect("admin.login", "login");
        }
    }
}
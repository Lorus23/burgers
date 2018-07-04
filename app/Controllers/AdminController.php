<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\User;

class AdminController extends MainController
{
    public function index()
    {

        $users   = User::usersList();
        $orders   = Order::orders();
        $data = ['users' => $users, 'orders' => $orders];

        $this->view->twigLoad('admin', $data);
    }
}
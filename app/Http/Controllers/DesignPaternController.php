<?php

namespace App\Http\Controllers;

use common\BusinessLogics\BusinessLogics;
use Illuminate\Http\Request;
use common\designPatern\FactoryDesignPatern;

class DesignPaternController extends Controller
{
    public function index()
    {
//        $design = new FactoryDesignPatern();
//        return $design->index();
        return FactoryDesignPatern::helloPrint();
//        return BusinessLogics::print();
    }
}

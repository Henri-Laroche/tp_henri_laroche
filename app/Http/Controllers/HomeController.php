<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class HomeController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('home');
    }
}

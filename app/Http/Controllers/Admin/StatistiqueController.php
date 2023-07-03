<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index(){
        return view('Admin.statistique.index');
    }
}

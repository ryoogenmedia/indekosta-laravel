<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;

class LoginUserController extends Controller
{
    public function index(){
        $kost = Kost::all();

        return view('auth.login-user', compact('kost'));
    }
}

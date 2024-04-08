<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function theme()
    {

        $theme = User::where('email','admin@gmail.com')->value('theme');

        if($theme == 'theme1'){
            return view('theme.them1');
        }else{
            return view('theme.theme2');
        }


    }
}

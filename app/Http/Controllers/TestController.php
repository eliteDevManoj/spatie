<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function fakeUsers(Request $request){

        User::factory()->count(5)->create();
    }
}

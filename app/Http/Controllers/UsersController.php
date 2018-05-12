<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * 显示用户列表
     *
     * @return Response
     */
    public function index()
    {
      $users = DB::table('user') -> get();

      return view('users.list', ['users' => $users]);
    }
}

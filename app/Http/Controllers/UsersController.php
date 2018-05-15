<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * 显示用户列表页面
     *
     * @return Response
     */
    public function index()
    {
      $users = DB::table('user') -> get();

      return view('users.list', ['users'=>$users]);
    }

    /**
     * 显示新增用户页面
     */
    public function create() {
      return view('users.add');
    }

    /**
     * 新增用户-存入数据库
     *
     */
    public function store(Request $request) {
      return response()->json([
        'code'=>200,
        'msg'=>'保存成功'
      ]);
    }
}

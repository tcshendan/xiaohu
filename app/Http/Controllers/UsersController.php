<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * 存储新增用户
     * @param Request $request
     * @return Response
     *
     */
    public function store(Request $request) {
      $input = $request->all();

      if(mb_strlen($input['name']) == 0) {
        return response()->json([
          'code'=>10008,
          'msg'=>'用户名不能为空'
        ]);
      }
      if(mb_strlen($input['password']) == 0) {
        return response()->json([
          'code'=>10008,
          'msg'=>'密码不能为空'
        ]);
      }
      if(mb_strlen($input['email']) == 0) {
        return response()->json([
          'code'=>10008,
          'msg'=>'email不能为空'
        ]);
      }

      //存入数据库
      $bool = DB::table('user') -> insert([
        'name'=>$input['name'],
        'password'=>bcrypt($input['password']),
        'email'=>$input['email'],
        'created_at'=>date('Y-m-d H:i:s'),
        'updated_at'=>date('Y-m-d H:i:s')
      ]);
      if($bool) {
        return response()->json([
          'code'=>200,
          'msg'=>'新增用户成功'
        ]);
      }
    }

    /**
     * 删除用户
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request) {
      return response()->json([
        'msg'=>'删除用户操作'
      ]);
    }
}

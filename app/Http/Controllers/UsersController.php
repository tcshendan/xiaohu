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
      $users = DB::table('user')->get();

      return view('users.list', ['users'=>$users]);
    }

    /**
     * 显示新增用户页面
     *
     * @return Response
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

      $bool = DB::table('user')->insert([
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
      else {
        return response()->json([
          'code'=>-1,
          'msg'=>'新增用户失败'
        ]);
      }
    }

    /**
     * 显示修改用户页面
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request) {
      $id = $request->route('id');

      $user = DB::table('user')->where('id', $id)->first();

      return view('users.edit', ['user'=>$user]);
    }

    /**
     * 修改用户
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request) {
      $input = $request->all();

      $bool = DB::table('user')->where('id', $input['id'])->update([
        'name'=>$input['name'],
        'password'=>$input['password'],
        'email'=>$input['email'],
        'updated_at'=>date('Y-m-d H:i:s')
      ]);
      if($bool) {
        return response()->json([
          'code'=>200,
          'msg'=>'修改用户成功'
        ]);
      }
      else {
        return response()->json([
          'code'=>-1,
          'msg'=>'修改用户失败'
        ]);
      }
    }

    /**
     * 删除用户
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request) {
      $data = $request->all();
      //var_dump($data['id']);

      $bool = DB::table('user')->where('id', '=', $data['id'])->delete();
      if($bool) {
        return response()->json([
          'code'=>200,
          'msg'=>'删除用户成功'
        ]);
      }
      else {
        return response()->json([
          'code'=>-1,
          'msg'=>'删除用户失败'
        ]);
      }
    }
}

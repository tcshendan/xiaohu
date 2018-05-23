<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Tool\Helper;
use App\Tool\M3Result;
use App\Tool\ErrorCode;

class UsersController extends Controller
{
    /**
     * 显示用户列表页面
     *
     * @return Response
     */
    public function index()
    {
      /**
       * DB facade
       */
      //$users = DB::select('select * from user');

      /**
       * 查询构造器
       */
      //$users = DB::table('user')->get();

      /**
       * Eloquent ORM
       */
      $users = User::all();

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
        return M3Result::init(ErrorCode::$invalid_name);
      }
      if(mb_strlen($input['password']) == 0) {
        return M3Result::init(ErrorCode::$invalid_password);
      }
      if(mb_strlen($input['email']) == 0) {
        return M3Result::init(ErrorCode::$invalid_email);
      }

      /**
       * DB facade
       */
      // date_default_timezone_set('PRC');
      // $bool = DB::insert('insert into user (name,password,email,created_at,updated_at) values(?,?,?,?,?)',
      //     [$input['name'],$input['password'],$input['email'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
      // if($bool) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'新增用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'新增用户失败'
      //   ]);
      // }

      /**
       * 查询构造器
       */
      // $bool = DB::table('user')->insert([
      //   'name'=>$input['name'],
      //   'password'=>bcrypt($input['password']),
      //   'email'=>$input['email'],
      //   'created_at'=>date('Y-m-d H:i:s'),
      //   'updated_at'=>date('Y-m-d H:i:s')
      // ]);
      // if($bool) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'新增用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'新增用户失败'
      //   ]);
      // }

      /**
       * Eloquent ORM
       */
      try {
        DB::beginTransaction();

        User::insert([
          'name'=>$input['name'],
          'password'=>$input['password'],
          'email'=>$input['email'],
          'created_at'=>date('Y-m-d H:i:s'),
          'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::commit();
        return M3Result::init([200, '新增用户成功']);
      } catch(\Exception $e) {
        DB::rollBack();
        return M3Result::init([-1, '新增用户失败']);
      }
    }

    /**
     * 显示修改用户页面
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request) {
      $id = $request->route('id');

      /**
       * DB facade
       */
      //$user = DB::select('select * from user where id='.$id);

      /**
       * 查询构造器
       */
      //$user = DB::table('user')->where('id', $id)->first();

      /**
       * Eloquent ORM
       */
      $user = User::where('id', $id)->first();

      return view('users.edit', ['user'=>$user]);
    }

    /**
     * 修改用户
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request) {
      $input = $request->all();

      date_default_timezone_set('PRC');

      /**
       * DB facade
       */
      // $num = DB::update('update user set name="'.$input['name'].'", password="'.$input['password'].'", email="'.$input['email'].'", updated_at="'.date('Y-m-d H:i:s').'" where id='.$input['id']);
      // if($num) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'修改用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'修改用户失败'
      //   ]);
      // }

      /**
       * 查询构造器
       */
      // $bool = DB::table('user')->where('id', $input['id'])->update([
      //   'name'=>$input['name'],
      //   'password'=>$input['password'],
      //   'email'=>$input['email'],
      //   'updated_at'=>date('Y-m-d H:i:s')
      // ]);
      // if($bool) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'修改用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'修改用户失败'
      //   ]);
      // }

      /**
       * Eloquent ORM
       */
      try {
        DB::beginTransaction();

        User::where('id', $input['id'])->update([
          'name'=>$input['name'],
          'password'=>$input['password'],
          'email'=>$input['email'],
          'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::commit();
        return M3Result::init([200, '修改用户成功']);
      } catch(\Exception $e) {
        DB::rollBack();
        return M3Result::init([-1, '修改用户失败']);
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

      /**
       * DB facade
       */
      // $num = DB::delete('delete from user where id='.$data['id']);
      // if($num) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'删除用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'删除用户失败'
      //   ]);
      // }

      /**
       * 查询构造器
       */
      // $bool = DB::table('user')->where('id', '=', $data['id'])->delete();
      // if($bool) {
      //   return response()->json([
      //     'code'=>200,
      //     'msg'=>'删除用户成功'
      //   ]);
      // }
      // else {
      //   return response()->json([
      //     'code'=>-1,
      //     'msg'=>'删除用户失败'
      //   ]);
      // }

      /**
       * Eloquent ORM
       */
      try {
        DB::beginTransaction();

        User::where('id', '=', $data['id'])->delete();
        DB::commit();
        return M3Result::init([200, '删除用户成功']);
      } catch(\Exception $e) {
        DB::rollBack();
        return M3Result::init([-1, '删除用户失败']);
      }
    }
}

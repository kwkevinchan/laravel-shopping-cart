<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;


class UserController extends Controller
{
    public function index()
    {
        $user = User::with('roles')->get();
        $role = Role::get(['name'])->push(collect(['name' => '一般使用者']));
        $data = $role->pluck('name')
            ->flip()
            ->transform(function($item, $key){
                return $item = collect([]);
            })->
            put('一般使用者', collect([]));
        foreach($user as $u){
            if($u->roles->isNotEmpty()){
                $data[$u->roles[0]->name]->push(collect([
                    'id' => $u->id,
                    'name' => $u->name,
                    'role' => $u->roles[0]->name
                ]));
            } else {
                $data['一般使用者']->push(collect([
                    'id' => $u->id,
                    'name' => $u->name,
                    'role' => '一般使用者'
                ]));
            }
        }
        // return dd($data);

        return view('user.index', [
            'data' => $data,
            'role' => $role
        ]);
    }

    public function create()
    {
        $role = Role::get(['name'])->reverse();
        return view('user.create', [
            'role' => $role
        ]);
    }

    public function store(Request $request)
    {
        // return dd($request->request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('123456')
        ]);

        if($request->role != null){
            $user->assignRole($request->role);
        } else {
            $request->role = '一般使用者';
        }

        session()->flash('status', 'success');
        session()->flash('message', '已新增使用者:'. $request->name .' ！<br>使用者權限:' . $request->role);
        return redirect('/user');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        $role = Role::get(['name']);
        return view('user.edit', [
            'user' => $user,
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        // return dd($request->request);
        $user = User::where('id', $id)->with('roles')->first();

        $new_user =  User::where('id', $id);
        $new_user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        //檢查使用者權限是否存在並更新
        if($user->roles->isNotEmpty()){
            if($user->roles[0]->name !== $request->name){
                $new_user->first()->removeRole($user->roles[0]->name);
                if($request->role != null){
                    $new_user->first()->assignRole($request->role);
                } else {
                    $request->role = '一般使用者';
                }
            }
        } else {
            if($request->role){
                $new_user->first()->assignRole($request->role);
            } else {
                $request->role = '一般使用者';
            }
        }

        session()->flash('status', 'success');
        session()->flash('message', $request->name. '修改成功!!<br>使用者權限:' . $request->role);
        return redirect('/user/'. $id .'/edit');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->with('roles')->get();
        $name = $user->name;
        if($user->roles->isNotEmpty()){
            $user->removeRole($user->roles[0]->name);
        }
        $user->delete();

        return dd($user);
        session()->flash('status', 'success');
        session()->flash('message', '已刪除使用者:'. $name .' ,與其權限！');
        return redirect('/user');
    }

}

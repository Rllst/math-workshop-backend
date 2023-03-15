<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Domain\Mapper;

class AdminController extends Controller
{
    public function create(Request $request){
        $user = Mapper::JsonToUser($request->getContent());
        $user->password = bcrypt($user->password);
        $user->save();
    }
    public function read($id){
        return User::find($id);
    }
    public function readAll(){
        return User::all();
    }
    public function update(Request $request, $id){
        $user = Mapper::JsonToUser($request->getContent());
        unset($user->password);
        $this->read($id)->update($user->toArray());
    }
    public function delete($id){
        User::find($id)->delete();
    }
}

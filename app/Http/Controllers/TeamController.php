<?php

namespace App\Http\Controllers;

use App\Domain\Mapper;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    function create(Request $request){
        $member = Mapper::JsonToTeamMember($request->getContent());
        $member->save();
        return $member->id;
    }
    function readAll(){
        return TeamMember::all();
    }
    function read($id){
        return TeamMember::find($id);
    }
    function readImage($id){
        return Storage::disk('local')->get('team_images/'.$id);
    }
    function update(Request $request, $id){
        return $this->read($id)->update(Mapper::JsonToTeamMember($request->getContent())->toArray());
    }
    function updateImage(Request $request, $id){
        if(Storage::disk('local')->exists('team_images/'.$id)){
            Storage::disk('local')->delete('team_images/'.$id);
        }
        Storage::disk('local')->putFileAs('team_images', $request->file('image'),$id);
    }
    function delete($id){
        return TeamMember::find($id)->delete();
    }
}

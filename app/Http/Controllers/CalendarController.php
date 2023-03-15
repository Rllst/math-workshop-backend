<?php

namespace App\Http\Controllers;

use App\Domain\Mapper;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function create(Request $request){
        $event = Mapper::JsonToEvent($request->getContent());
        $event->save();
        return $event->id;
    }
    function readAll(){
        return Event::all();
    }
    function read($id){
        return Event::find($id);
    }
    function update(Request $request, $id){
        return Event::find($id)->update(Mapper::JsonToEvent($request->getContent())->toArray());

    }
    function delete($id){
        return Event::find($id)->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Domain\Mapper;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    function create(Request $request){
        $quote = Mapper::JsonToQuote($request->getContent());
        $quote->save();
        return $quote->id;
    }
    function readAll(){
        return Quote::all();
    }
    function read($id){
        return Quote::find($id);
    }
    function readRand(){
        return Quote::inRandomOrder()->first();
    }
    function update(Request $request, $id){
        return $this->read($id)->update(Mapper::JsonToQuote($request->getContent())->toArray());
    }
    function delete($id){
        return Quote::find($id)->delete();
    }
}

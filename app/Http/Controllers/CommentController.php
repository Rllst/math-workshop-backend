<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Domain\Mapper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Nette\Utils\DateTime;

class CommentController extends Controller
{
    function create(Request $request, $id){
        $comment = Mapper::JsonToComment($request->getContent());
        $comment->post_id=$id;
        $comment->date = new DateTime();
        ///???????????
        if(Auth::user()){
            $comment->is_administrator = true;
            $comment->approved = true;
        }
        else{
            $comment->is_administrator = false;
            $comment->approved = false;
            //send email to admin;
        }
        $comment->save();
    }
    function readUnapproved(){
        return Comment::where('approved', false)->get();
    }
    function read($id){
        return Comment::find($id);
    }
    function approve(Request $request, $id){
        $decision = $request->query('judgement');
        $question = Comment::find($id);
        $user = Auth::user();
        $answer = Mapper::JsonToComment($request->getContent());
        if($decision){
        $answer = Mapper::JsonToComment($request->getContent());
        $question->approved = true;
        $answer->is_administrator = true;
        $answer->approved = true;
        $answer->post_id = $question->post_id;
        $answer->email = $user->email;
        $answer->name = $user->name;
        $answer->date = new DateTime();
        $question->save();
        $answer->save();
        //send email to user
        }
        else {
            $question->delete();
        }
        return true;
    }
    function delete($id){
        Comment::find($id)->delete();
    }
}

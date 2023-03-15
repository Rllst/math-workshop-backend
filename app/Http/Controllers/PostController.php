<?php

namespace App\Http\Controllers;

use App\Domain\Mapper;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\DateTime;


class PostController extends Controller
{
    public function create(Request $request){
        $post = Mapper::JsonToPost($request->getContent());
        $post->views = 0;
        $post->date = new DateTime();
        $categories = $post->categories;
        unset($post->categories);
        $post->save();
        $post->categories()->sync($categories);
        return $post->id;
    }
    public function readPage(Request $request, $page){
        $query = $request->query('query');
        $requestedCategory =json_decode($request->query('categories'));
        $posts = Post::select('*')
        ->with('categories')
        ->where('title', 'ilike', '%'.$query.'%')
        ->get();
        $result= new \stdClass;
        $result->posts = array();
        $result->totalCount = 0;
        foreach($posts as &$post){
            if(empty(array_diff($requestedCategory, $post->categories()->get()->map(fn($category)=>$category->id)->toArray()))){
                array_push($result->posts, $post);
           }
        }
        $result->totalCount = count($result->posts);
        return $result;
    }
    public function read($id){
        $post = Post::with('comments', 'categories')->find($id);
        $post->views += 1;
        $post->save();
        return $post;
    }
    public function readAll(){
        return Post::all();
    }
    public function readImage($id){
        return Storage::disk('local')->get('post_images/'.$id);
    }
    public function update(Request $request, $id){
        $previous = Post::find($id);
        $updated = Mapper::JsonToPost($request->getContent());
        $previous->title = $updated->title;
        $previous->description = $updated->description;
        $previous->content = $updated->content;
        $previous->categories()->sync($updated->categories);
        $previous->save();
        return $previous->id;
    }
    public function updateImage(Request $request, $id){
    
        if(Storage::disk('local')->exists('post_images/'.$id)){
            Storage::disk('local')->delete('post_images/'.$id);
        }
        Storage::disk('local')->putFileAs('post_images', $request->file('image'),$id);
    }

    public function delete($id){
        Post::find($id)->delete();
        Storage::disk('local')->delete('post_images'.$id);
    }

}

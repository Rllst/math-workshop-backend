<?php

namespace App\Http\Controllers;

use App\Models\GalleryFolder;
use App\Domain\Mapper;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    function create(Request $request){
        Mapper::JsonToGalleryFolder($request->getContent())->save();
    }
    function createImage(Request $request, $id){
        $image = new GalleryImage();
        $image->gallery_folder_id=$id;
        $image->save();
        Storage::disk('local')->putFileAs('gallery_images', $request->file('image'),$image->id);
    }
    function readAll(){
        return GalleryFolder::all();
    }
    function read($id){
        return GalleryFolder::with('images')->find($id);
    }
    function readImage($id){
        return Storage::disk('local')->get('gallery_images/'.$id);
    }

    function readRandomImage(){
        $files = Storage::disk('local')->allFiles('gallery_images');
        return Storage::disk('local')->get($files[rand(0, count($files) - 1)]);
    }
    function update(Request $request, $id){
        $updated = Mapper::JsonToGalleryFolder($request->getContent());
        return GalleryFolder::find($id)->update($updated->toArray());
    }
    function deleteImage($id){
        Storage::disk('local')->delete('gallery_images/'.$id);
        GalleryImage::find($id)->delete();
    }
    function delete($id){
        $images = $this->read($id)->images()->get()->toArray();
        foreach($images as $image){
            $this->deleteImage($image['id']);
        }
        $this->read($id)->delete(); 
    }
}

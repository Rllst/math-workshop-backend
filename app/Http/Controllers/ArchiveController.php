<?php

namespace App\Http\Controllers;

use App\Models\ArchiveFile;
use App\Models\ArchiveFolder;
use Illuminate\Http\Request;
use App\Domain\Mapper;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\DateTime;

class ArchiveController extends Controller
{
    function create(Request $request){
        $folder = Mapper::JsonToArchiveFolder($request->getContent());
        $folder->save();
        return $folder->id;
    }

    function createFile(Request $request, $id){
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        Storage::disk('google')->putFileAs('archive', $file, $name);

        $record = new ArchiveFile(['name'=>$name, 'date'=>new DateTime()]);
        $record->archive_folder_id = $id;
        $record->save();
        return $record->id;
    }
    function readAll(){
        return ArchiveFolder::all();
    }
    function read($id){
        return ArchiveFolder::with('files')->find($id);
    }
    function readFile($id){
        $record = ArchiveFile::find($id);
        return Storage::disk('google')->download('archive/'.$record->name);
    }
    function update(Request $request, $id){
        return $this->read($id)->update(Mapper::JsonToArchiveFolder($request->getContent())->toArray());
    }
    function delete($id){
        $files = $this->read($id)->files()->get()->toArray();
        foreach($files as $file){
            $this-> deleteFile($file['id']);
        }
        $this->read($id)->delete();
    }

    function deleteFile($id){

        $record = ArchiveFile::find($id);
        Storage::disk('google')->delete('archive/'.$record->name);
        $record->delete();
    }
}

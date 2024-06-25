<?php

namespace App\Repositories;

use App\Interfaces\BookmarkRepositoryInterface;
use App\Models\Bookmark;

class BookmarkRepository implements BookmarkRepositoryInterface{

    public function all($userId){
        return Bookmark::where('user_id',$userId)->paginate(50);
    }

    public function create(array $data){
      return  Bookmark::create($data);
    }

    public function update($id, array $data){
       $bookmark = Bookmark::findOrFail($id);
      return $bookmark->update($data);
    }

    public function delete($id){
        $bookmark = Bookmark::findOrFail($id);
        return $bookmark->delete();
    }

    public function find($id){
        return Bookmark::findOrFail($id);
    }
}

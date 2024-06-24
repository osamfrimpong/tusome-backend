<?php

namespace App\Services;

use App\Interfaces\BookmarkRepositoryInterface;

class BookmarkService{
    protected BookmarkRepositoryInterface $bookmarkRepository;

    public function __construct(BookmarkRepositoryInterface $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * Get all bookmarks for a given user
     */
    public function getAll($userId){
        $bookmarks = $this->bookmarkRepository->all($userId);
        if($bookmarks){
            return ['status' => 'success', 'data' => $bookmarks];
        }
        return ['status' => 'fail', 'message' => "could not find any bookmarks"];
    }

    /**
     * Create a new bookmark
     */
    public function create(array $data){
        $bookmark = $this->bookmarkRepository->create($data);
        if($bookmark){
            return ['status' => 'success', 'data' => $bookmark];
        }
        return ['status' => 'fail', 'message' => "could not create bookmark"];
    }

    /**
     * Get a bookmark by its ID
     */
    public function getById($id){
        $bookmark = $this->bookmarkRepository->find($id);
        if($bookmark){
            return ['status' => 'success', 'data' => $bookmark];
        }
        return ['status' => 'fail', 'message' => "bookmark not found"];
    }

    /**
     * Update a bookmark
     */
    public function update(array $data, $id){
        $bookmark = $this->bookmarkRepository->update($id, $data);
        if($bookmark){
            return ['status' => 'success', 'data' => $bookmark];
        }
        return ['status' => 'fail', 'message' => "could not update bookmark"];
    }

    /**
     * Delete a bookmark by its ID
     */
    public function deleteById($id){
        $bookmark = $this->bookmarkRepository->find($id);
        if($bookmark){
            if($this->bookmarkRepository->delete($id)){
                return ['status' => 'success', 'message' => "bookmark successfully deleted"];
            }
            return ['status' => 'fail', 'message' => "bookmark could not be deleted"];
        }
        return ['status' => 'fail', 'message' => "bookmark not found"];
    }
}

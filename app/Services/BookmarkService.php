<?php

namespace App\Services;

use App\Interfaces\BookmarkRepositoryInterface;

class BookmarkService{
    protected BookmarkRepositoryInterface $bookmarkRepository;

    public function __construct(BookmarkRepositoryInterface $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }
}

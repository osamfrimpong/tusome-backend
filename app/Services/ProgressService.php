<?php

namespace App\Services;

use App\Interfaces\ProgressRepositoryInterface;


class ProgressService {

    protected ProgressRepositoryInterface $progressRepository;

    public function __construct(ProgressRepositoryInterface $progressRepository)
    {
        $this->progressRepository = $progressRepository;
    }


}

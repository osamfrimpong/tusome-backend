<?php

namespace App\Interfaces;

interface ProgressRepositoryInterface
{
    public function all($userId);
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}

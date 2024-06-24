<?php

namespace App\Services;

use App\Interfaces\ProgressRepositoryInterface;

class ProgressService {

    protected ProgressRepositoryInterface $progressRepository;

    public function __construct(ProgressRepositoryInterface $progressRepository)
    {
        $this->progressRepository = $progressRepository;
    }

    /**
     * Get all progress records for a given user
     * Returns a list of progress records for the specified user
     */
    public function getAll($userId){
        $progressRecords = $this->progressRepository->all($userId);
        if($progressRecords){
            return ['status' => 'success', 'data' => $progressRecords];
        }
        return ['status' => 'fail', 'message' => "could not find any progress records"];
    }

    /**
     * Create a new progress record
     * Creates a new progress record with the provided data and returns it
     */
    public function create(array $data){
        $progress = $this->progressRepository->create($data);
        if($progress){
            return ['status' => 'success', 'data' => $progress];
        }
        return ['status' => 'fail', 'message' => "could not create progress record"];
    }

    /**
     * Get a progress record by its ID
     * Retrieves a specific progress record by its ID
     */
    public function getById($id){
        $progress = $this->progressRepository->find($id);
        if($progress){
            return ['status' => 'success', 'data' => $progress];
        }
        return ['status' => 'fail', 'message' => "progress record not found"];
    }

    /**
     * Update a progress record
     * Updates the specified progress record with the provided data and returns the updated record
     */
    public function update(array $data, $id){
        $progress = $this->progressRepository->update($id, $data);
        if($progress){
            return ['status' => 'success', 'data' => $progress];
        }
        return ['status' => 'fail', 'message' => "could not update progress record"];
    }

    /**
     * Delete a progress record by its ID
     * Deletes the specified progress record and returns a success or failure message
     */
    public function deleteById($id){
        $progress = $this->progressRepository->find($id);
        if($progress){
            if($this->progressRepository->delete($id)){
                return ['status' => 'success', 'message' => "progress record successfully deleted"];
            }
            return ['status' => 'fail', 'message' => "progress record could not be deleted"];
        }
        return ['status' => 'fail', 'message' => "progress record not found"];
    }
}

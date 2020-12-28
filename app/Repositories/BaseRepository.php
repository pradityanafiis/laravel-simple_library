<?php

namespace App\Repositories;

interface BaseRepository
{
    public function getAll();

    public function findById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}

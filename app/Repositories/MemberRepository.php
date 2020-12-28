<?php

namespace App\Repositories;

use App\Models\Member;

class MemberRepository implements BaseRepository
{
    private $member;

    public function __construct()
    {
        $this->member = new Member();
    }

    public function getAll()
    {
        return $this->member->all();
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function create(array $data)
    {
        return $this->member->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->member->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->member->findOrFail($id)->delete();
    }

    public function countAll()
    {
        return $this->member->all()->count();
    }
}

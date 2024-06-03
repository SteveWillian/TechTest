<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public const MODEL_CLASS = User::class;

    public function table()
    {
        $data = $this->model->query()->get()->toArray();
        return $data;
    }

    public function find($id)
    {
        $data = $this->model->query()->where('id', $id)->first()->toArray();
        return $data;
    }
}

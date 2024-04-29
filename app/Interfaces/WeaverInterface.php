<?php

namespace App\Interfaces;

interface WeaverInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $user);

    public function delete($user);

    public function find($user);

    public function search($request, $model, $conditions);

    public function assignRoleWeaver(array $data);
}

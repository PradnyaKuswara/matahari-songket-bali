<?php

namespace App\Interfaces;

interface WeaverInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $weaver);

    public function toogleActive($weaver);

    public function find($weaver);

    public function search($request, $model, $conditions);

    public function assignRoleWeaver(array $data);
}

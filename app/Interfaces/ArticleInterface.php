<?php

namespace App\Interfaces;

interface ArticleInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $article);

    public function toggleActive($article);

    public function delete($article);

    public function find($article);

    public function search($request, $model, $conditions, $relations);
}

<?php

namespace App\Services;

use Illuminate\Http\Request;

class SearchService
{
    private string $key = 'keyword';

    public function handle(Request $request, object $table, array $conditions)
    {
        $model = $table;

        if (! empty($request->get($this->key))) {

            foreach ($conditions as $key => $value) {
                if ($key === 0) {
                    $model = $model->where($value, 'LIKE', '%'.$request->get($this->key).'%');

                    continue;
                }

                $model = $model->orWhere($value, 'LIKE', '%'.$request->get($this->key).'%');
            }

            session()->flash('keyword', $request->get($this->key));
        }

        return $model;
    }

    public function setKey(string $key): SearchService
    {
        $this->key = $key;

        return $this;
    }
}

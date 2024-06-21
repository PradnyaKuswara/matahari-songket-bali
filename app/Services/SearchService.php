<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SearchService
{
    private string $key = 'keyword';

    public function handle(Request $request, object $table, array $conditions, ?array $relations = null)
    {
        $model = $table;

        if ($table instanceof \Illuminate\Database\Eloquent\Builder) {
            $model = $model->getModel();

            $columns = Schema::getColumnListing($model->getTable());
            $validConditions = array_filter($conditions, function ($condition) use ($columns) {
                return in_array($condition, $columns);
            });

            $model = $table;

            $model = $this->searchQueryBuilder($model, $validConditions, $request, $relations, $conditions);
        }

        if ($table instanceof \Illuminate\Database\Eloquent\Model) {
            $columns = Schema::getColumnListing($model->getTable());
            $validConditions = array_filter($conditions, function ($condition) use ($columns) {
                return in_array($condition, $columns);
            });

            $model = $this->searchQueryModel($model, $validConditions, $request, $relations, $conditions);
        }

        session()->flash('keyword', $request->get($this->key));

        return $model;
    }

    private function searchQueryBuilder(object $model, array $validations, object $request, ?array $relations = null, ?array $conditions = null)
    {
        if (! empty($request->get($this->key))) {
            $model = $model->where(function ($query) use ($validations, $request, $relations, $model, $conditions) {
                foreach ($validations as $key => $value) {
                    if ($key === 0) {
                        $query->where($value, 'LIKE', '%'.$request->get($this->key).'%');

                        continue;
                    }

                    $query->orWhere($value, 'LIKE', '%'.$request->get($this->key).'%');
                }

                if (! empty($relations)) {
                    foreach ($relations as $relation) {
                        $model = $model->with($relation);
                        $relatedModel = $model->getRelation($relation)->getRelated();
                        $relatedColumns = Schema::getColumnListing($relatedModel->getTable());

                        $validRelationConditions = array_filter($conditions, function ($condition) use ($relatedColumns) {
                            return in_array($condition, $relatedColumns);
                        });

                        if (! empty($validRelationConditions)) {
                            $query->orWhere(function ($query2) use ($validRelationConditions, $request, $relation) {
                                foreach ($validRelationConditions as $key => $value2) {
                                    if ($key === 0) {
                                        $query2->whereHas($relation, function ($query3) use ($value2, $request) {
                                            $query3->where($value2, 'LIKE', '%'.$request->get($this->key).'%');
                                        });

                                        continue;
                                    }

                                    $query2->orWhereHas($relation, function ($query3) use ($value2, $request) {
                                        $query3->where($value2, 'LIKE', '%'.$request->get($this->key).'%');
                                    });
                                }
                            });
                        }
                    }
                }
            });
        }

        return $model;
    }

    private function searchQueryModel(object $model, array $validations, object $request, ?array $relations = null, ?array $conditions = null)
    {
        if (! empty($request->get($this->key))) {
            $model = $model->where(function ($query) use ($validations, $request) {
                foreach ($validations as $key => $value) {
                    if ($key === 0) {
                        $query->where($value, 'LIKE', '%'.$request->get($this->key).'%');

                        continue;
                    }

                    $query->orWhere($value, 'LIKE', '%'.$request->get($this->key).'%');
                }
            });

            if (! empty($relations)) {
                foreach ($relations as $relation) {
                    $model = $model->with($relation);
                    $relatedModel = $model->getRelation($relation)->getRelated();
                    $relatedColumns = Schema::getColumnListing($relatedModel->getTable());
                    $validRelationConditions = array_filter($conditions, function ($condition) use ($relatedColumns) {
                        return in_array($condition, $relatedColumns);
                    });

                    if (! empty($validRelationConditions)) {
                        $model = $model->orWhereHas($relation, function ($query) use ($validRelationConditions, $request) {
                            foreach ($validRelationConditions as $key => $value) {
                                if ($key === 0) {
                                    $query->where($value, 'LIKE', '%'.$request->get($this->key).'%');

                                    continue;
                                }

                                $query->orWhere($value, 'LIKE', '%'.$request->get($this->key).'%');
                            }
                        });
                    }
                }
            }
        }

        return $model;
    }

    public function setKey(string $key): SearchService
    {
        $this->key = $key;

        return $this;
    }
}

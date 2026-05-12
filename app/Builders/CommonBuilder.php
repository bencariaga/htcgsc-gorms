<?php

namespace App\Builders;

use App\Services\Miscellaneous\ModelInstanceCache;
use Illuminate\{Database\Eloquent\Builder, Database\Eloquent\Model, Support\Arr};

class CommonBuilder extends Builder
{
    /** @param mixed $id */
    public function find($id, $columns = ['*'])
    {
        $class = $this->getModel()::class;

        if ($columns === ['*'] && Arr::wrap($id) && $instance = ModelInstanceCache::get($class, $id)) {
            return $instance;
        }

        $instance = parent::find($id, $columns);

        if ($instance instanceof Model && $columns === ['*'] && Arr::wrap($id)) {
            ModelInstanceCache::set($class, $instance->getKey(), $instance);
        }

        return $instance;
    }

    public function first($columns = ['*'])
    {
        $model = $this->getModel();
        $class = $model::class;
        $query = $this->getQuery();

        if ($columns === ['*'] && count($query->wheres) === 1) {
            $where = $query->wheres[0];
            $key = $model->getKeyName();
            $qualifiedKey = $model->getQualifiedKeyName();

            if ($where['type'] === 'Basic' && ($where['column'] === $key || $where['column'] === $qualifiedKey) && ($where['operator'] === '=' || !isset($where['operator']))) {
                $id = $where['value'];

                if ($instance = ModelInstanceCache::get($class, $id)) {
                    return $instance;
                }
            }
        }

        $instance = parent::first($columns);

        if ($instance instanceof Model && $columns === ['*']) {
            ModelInstanceCache::set($class, $instance->getKey(), $instance);
        }

        return $instance;
    }
}

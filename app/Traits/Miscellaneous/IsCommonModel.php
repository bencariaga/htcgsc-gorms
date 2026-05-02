<?php

namespace App\Traits\Miscellaneous;

use App\Actions\Data\GenerateDatabaseTableRowId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\HasParamLimitFixAndRecursiveRelationships;
use Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * @property string $table
 * @property string $primaryKey
 * @property string $keyType
 * @property bool $incrementing
 * @property bool $timestamps
 */
trait IsCommonModel
{
    use BelongsToThrough, HasEagerLimit, HasFactory, HasMergedRelationships, HasParamLimitFixAndRecursiveRelationships, HasRelationships, QueriesExpressions {
        HasEagerLimit::newBaseQueryBuilder insteadof HasParamLimitFixAndRecursiveRelationships, QueriesExpressions;
    }

    public function initializeIsCommonModel(): void
    {
        static $cache = [];
        $class = static::class;

        if (!collect($cache)->has($class)) {
            $className = class_basename($class);
            $cache[$class] = collect(['table' => 's', 'key' => '_id'])->map(fn ($suffix, $key) => str($className)->snake()->append($suffix)->toString())->toArray();
        }

        $this->table = $cache[$class]['table'];
        $this->primaryKey = $cache[$class]['key'];
        $this->keyType = 'int';
        $this->incrementing = false;
    }

    protected static function bootIsCommonModel(): void
    {
        static::creating(fn ($model) => $model->{$model->getKeyName()} ??= GenerateDatabaseTableRowId::execute($model->getTable(), $model->getKeyName()));
    }
}

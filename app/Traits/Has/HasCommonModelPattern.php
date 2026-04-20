<?php

namespace App\Traits\Has;

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
trait HasCommonModelPattern
{
    use BelongsToThrough, HasEagerLimit, HasFactory, HasMergedRelationships, HasParamLimitFixAndRecursiveRelationships, HasRelationships, QueriesExpressions {
        HasEagerLimit::newBaseQueryBuilder insteadof HasParamLimitFixAndRecursiveRelationships, QueriesExpressions;
    }

    public function initializeHasCommonModelPattern(): void
    {
        $className = class_basename($this);

        $this->table = str($className)->snake() . 's';

        $this->primaryKey = str($className)->snake() . '_id';

        $this->keyType = 'string';

        $this->incrementing = false;

        $this->timestamps = true;
    }

    protected static function bootHasCommonModelPattern(): void
    {
        static::creating(fn ($model) => str($model->{$model->getKeyName()})->isEmpty() && $model->{$model->getKeyName()} = GenerateDatabaseTableRowId::execute($model->getTable(), $model->getKeyName()));
    }
}

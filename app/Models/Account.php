<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 *
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SimCard[] $simCards
 */
class Account extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function simCards(): HasMany
    {
        return $this->hasMany(SimCard::class);
    }

}

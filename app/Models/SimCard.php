<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $account_id
 * @property string $iccid
 * @property boolean $is_active
 * @property string $imei
 * @property string $notes
 *
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Account $account
 */
class SimCard extends Model
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
    protected $fillable = ['account_id', 'iccid', 'is_active', 'imei', 'notes', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

}

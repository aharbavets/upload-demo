<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $path
 * @property string $filename
 * @property int $size
 * @property string $username
 * @property string $created_at
 */
class Upload extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}

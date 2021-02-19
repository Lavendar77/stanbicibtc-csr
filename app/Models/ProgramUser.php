<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramUser extends Pivot
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'applied' => 'boolean',
    ];
}

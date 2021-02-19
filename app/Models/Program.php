<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'photo',
    ];

    /**
     * Get the program's photo.
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        return $this->attributes['photo'] ?? asset('images/program-placeholder.jpg');
    }

    /**
     * Get the user that is coordinating the program.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programCoordinator()
    {
        return $this->belongsTo(User::class);
    }
}

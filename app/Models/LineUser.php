<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineUser extends Model
{
    use HasFactory;

    protected $table = 'line_users';

    protected $fillable = [
        'displayName',
        'pictureUrl',
        'userId',
    ];

    function cases()
    {
        return $this->hasMany(CasePain::class);
    }
}

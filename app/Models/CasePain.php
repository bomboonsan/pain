<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasePain extends Model
{
    use HasFactory;
    // table name
    protected $table = 'case_pains';

    protected $fillable = [
        'user_id',
        // 'pains',
        'positions',
        'level',
        'symptom',
        'meds',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(LineUser::class);
    }
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}

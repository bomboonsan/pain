<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';

    protected $fillable = [
        'case_id',
        'level',
        'meds',
        'date',
    ];

    public function case()
    {
        return $this->belongsTo(CasePain::class, 'case_id');
    }

}

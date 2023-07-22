<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruit extends Model
{
    protected $table = 'tb_recruit';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}

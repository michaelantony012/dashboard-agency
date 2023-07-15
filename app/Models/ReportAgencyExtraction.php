<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAgencyExtraction extends Model
{
    use HasFactory;

    protected $table = 'tb_extraction';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function reportAgency(): BelongsTo
    {
        return $this->belongsTo(ReportAgency::class);
    }
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}

<?php

namespace App\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reviewer extends Model
{
    use HasFactory;

    protected $table = 'reviewer';
    protected $primaryKey = 'rev_id';
    protected $fillable = [
        'rev_name'
    ];
    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'rating')->withPivot('rev_stars', 'num_o_ratings');
    }

}

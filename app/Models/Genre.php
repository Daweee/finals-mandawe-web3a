<?php

namespace App\Models;

use App\Models\MovieGenre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'gen_id';
    protected $fillable = [
        'gen_title'
    ];
    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_genres');
    }

}

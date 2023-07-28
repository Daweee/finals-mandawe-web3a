<?php

namespace App\Models;

use App\Models\MovieDirection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Director extends Model
{
    use HasFactory;

    protected $table = 'director';
    protected $primaryKey = 'dir_id';
    protected $fillable = [
        'dir_fname',
        'dir_lname',
    ];
    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_direction');
    }

}

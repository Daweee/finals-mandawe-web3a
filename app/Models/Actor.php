<?php

namespace App\Models;

use App\Models\MovieCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory;

    protected $table = 'actor';
    protected $primaryKey = 'act_id';
    protected $fillable = [
        'act_fname',
        'act_lname',
        'act_gender'
    ];
    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_cast')->withPivot('role');
    }

}

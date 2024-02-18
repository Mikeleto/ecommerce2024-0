<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','education_level','salary','sector','experience_required'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
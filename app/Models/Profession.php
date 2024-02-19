<?php
namespace App\Models;

use App\Filters\ProfessionFilter;
use App\Queries\ProfessionBuilder;
use Illuminate\Database\Eloquent\Builder;

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


    public function newEloquentBuilder($query)
    {
        return new ProfessionBuilder($query);
    }

    public function newQueryFilter()
    {
        return new ProfessionFilter();
    }
}
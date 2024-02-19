<?php

namespace App\Filters;
use App\Filters\QueryFilter;

class ProfessionFilter extends QueryFilter
{
 

    public function filterRules(): array
    {
        return [
            'search' => 'filled',
            'nameFilter' => 'filled',

        ];
    }

  

    public function search($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->whereRaw('CONCAT(first_name, " ", last_name) like ?', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('team', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        });
    }

    public function nameFilter($query, $nameFilter)
    {
        if ($nameFilter) {
            $query->nameFilter($nameFilter);
        }
    }

  
}
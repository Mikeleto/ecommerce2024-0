<?php

namespace App\Filters;
use App\Filters\QueryFilter;

class ProductFilter extends QueryFilter
{
 

    public function filterRules(): array
    {
        return [
            'search' => 'filled',
            'nameFilter' => 'filled',
            'maxPriceFilter' => 'filled',
            'minPriceFilter' => 'filled',
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

    public function maxPriceFilter($query, $maxPriceFilter)
    {
        if ($maxPriceFilter) {
            $query->maxPriceFilter($maxPriceFilter);
        }
    }

    public function minPriceFilter($query, $minPriceFilter)
    {
        if ($minPriceFilter) {
            $query->minPriceFilter($minPriceFilter);
        }
    }
  
}
<?php

namespace App\Queries;

class ProductBuilder extends QueryBuilder
{
 public function nameFilter($nameFilter){
        $this->where('name', 'LIKE', "%{$nameFilter}%");
    }

    public function maxPriceFilter($maxPriceFilter){
        $this->where('price', '<=', "$maxPriceFilter");
    }

    public function minPriceFilter($minPriceFilter){
        $this->where('price', '>=', "$minPriceFilter");
    }

}
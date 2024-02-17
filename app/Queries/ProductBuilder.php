<?php

namespace App\Queries;

class ProductBuilder extends QueryBuilder
{
 public function nameFilter($nameFilter){
        $this->where('name', 'LIKE', "%{$nameFilter}%");
    }
}
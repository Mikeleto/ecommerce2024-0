<?php

namespace App\Queries;

class ProfessionBuilder extends QueryBuilder
{
 public function nameFilter($nameFilter){
        $this->where('title', 'LIKE', "%{$nameFilter}%")
        ->orWhere('sector', 'LIKE', "%{$nameFilter}%");
    }
}
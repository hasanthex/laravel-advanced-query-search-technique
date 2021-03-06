<?php
namespace App\CarSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Name implements Filter{
    
    public static function apply(Builder $builder, $value){
        return $builder->where('name', $value);
    }

}

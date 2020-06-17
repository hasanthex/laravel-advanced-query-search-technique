<?php

namespace App\CarSearch;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Car;
use Illuminate\Support\Str;

class CarSearch
{
    public static function apply(Request $request){
        $query = static::applyDecoratorsFormRequest($request, (new Car)->newQuery());

        return static::getResults($query);
    }

    private static function applyDecoratorsFormRequest(Request $request, Builder $query){
        foreach( $request->all() as $filterName => $value){
            // echo $filterName;
            $decorator = static::createFilterDecorator($filterName);

            if( static::isValidDecorator($decorator)){
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }

    private static function createFilterDecorator($name){
        return __NAMESPACE__.'\\Filters\\'.Str::studly($name);   
    }

    private static function isValidDecorator($decorator){
        return class_exists($decorator);
    }

    private static function getResults(Builder $query){
        return $query->get();
    }

}
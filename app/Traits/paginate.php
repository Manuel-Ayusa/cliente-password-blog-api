<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

trait Paginate{

    public function paginate($items, $perPage)
    {
        if (!is_array($items)) {
            $items = $items->toArray();
        }

        $page = request()->input('page');

        if ($page == null) {
            $page = 1; 
        }

        $url = url()->current();
        $elementsPage = array_slice($items, $perPage * ($page - 1), $perPage);

        $result = new LengthAwarePaginator($elementsPage, count($items), $perPage, $page);

        $result->setPath($url);
        
        return $result;
    }
}
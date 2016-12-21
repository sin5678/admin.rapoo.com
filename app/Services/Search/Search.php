<?php

namespace App\Services\Search;

use App\Services\AbstractSearch;
use App\Services\MCAManager;
use Config,View,Input;

class Search extends AbstractSearch
{   
    public function getSearch($query, array $searchData = array(), $sort = null, $offset = 0, $limit = 0)
    {
        $MCA = app()->make(MCAManager::MAC_BIND_NAME);
        $controller = $MCA->getController();
        $action     = $MCA->getAction();
        !$searchData && $searchData = $input = Input::all();
        
        foreach($searchData as $searchKey => $searchValue){
            if(empty($searchValue)) continue;
            if(empty($search = Config::get('search.'.$controller.'.'.$searchKey))) continue;
            
            $query->whereRaw($search['search'], [$searchValue]);
        }
        $query = $this->applySort($query, $sort);
        $query = $this->applyOffset($query, $offset);
        $query = $this->applyLimit($query, $limit);
        View::share('input', $input);
        return $query;
    }
    
}
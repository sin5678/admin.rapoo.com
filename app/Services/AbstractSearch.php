<?php 

namespace App\Services;

use Illuminate\Database\Query\Builder;
use Config, Input;

abstract class AbstractSearch
{	
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var User
     */
    protected $actor;

    /**
     * @var array
     */
    protected $defaultSort = [];

    public function __construct()
    {

    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getActor()
    {
        return $this->actor;
    }

    public function getDefaultSort()
    {
        return $this->defaultSort;
    }

    public function setDefaultSort(array $defaultSort)
    {
        $this->defaultSort = $defaultSort;
    }

    /**
     * @return array
     */
    public function getSearch($query, array $searchData = array(), $sort = null, $offset = 0, $limit = 0){}

    /**
     * @param AbstractSearch $search
     * @param array $sort
     */
    protected function applySort($query, array $sort = null)
    {
        $sort = $sort ?: $this->getDefaultSort();

        foreach ($sort as $field => $order) {
            if (is_array($order)) {
                foreach ($order as $value) {
                    $query->orderByRaw($field.' != ?', [$value]);
                }
            } else {
                $query->orderBy($field, $order);
            }
        }
        return $query;
    }

    /**
     * @param AbstractSearch $search
     * @param int $offset
     */
    protected function applyOffset($query, $offset)
    {
        if ($offset > 0) {
            $query->skip($offset);
        }
        return $query;
    }

    /**
     * @param AbstractSearch $search
     * @param int|null $limit
     */
    protected function applyLimit($query, $limit)
    {
        if ($limit > 0) {
            $query->take($limit);
        }
        return $query;
    }

}

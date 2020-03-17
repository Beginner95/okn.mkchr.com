<?php

namespace App\Http;


use App\Http\Controllers\IndexController;

class Filter
{
    protected $builder;
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply()
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    public function district($value)
    {
        if ($value === null) return;
        $district = new IndexController;
        $district_id = $district->getDistrictId($value);
        $this->builder->where('district_id', $district_id);
    }

    public function category($value)
    {
        if ($value === null) return;
        $this->builder->where('category', $value);
    }

    public function owner($value)
    {
        if ($value === null) return;
        $this->builder->where('owner', $value);
    }

    public function state($value)
    {
        if ($value === null) return;
        $this->builder->where('state', $value);
    }

    public function status($value)
    {
        if ($value === null) return;
        $this->builder->where('status', $value);
    }

    public function filters()
    {
        return $this->request->all();
    }
}
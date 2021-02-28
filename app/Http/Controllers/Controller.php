<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Matthenning\EloquentApiFilter\Traits\FiltersEloquentApi;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FiltersEloquentApi;

    protected $request;
    protected $model;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function list()
    {
        $query = $this->model::query();

        return $this->filterApiRequest($this->request, $query)->simplePaginate(
            $this->request->get('per_page'),
            ['*'],
            'page',
            $this->request->get('page')
        );
    }
}

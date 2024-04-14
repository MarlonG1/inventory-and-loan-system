<?php

namespace App\Http\Controllers;

use App\Http\Filters\AulaFilter;
use App\Http\Resources\Collection;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AulaFilter();
        $queryItems = $filter->transform($request);
        $aula = Aula::where($queryItems);

        return new Collection($aula->get());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Filters\PrestamoHistoricoFilter;
use App\Http\Resources\PrestamoHistoricoCollection;
use App\Models\PrestamoHistorico;
use Illuminate\Http\Request;

class PrestamoHistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PrestamoHistoricoFilter();
        $queryItems = $filter->transform($request);
        $includeEquipos = $request->query('includeEquipos');
        $prestamoHistoricos = PrestamoHistorico::where($queryItems);

        if ($includeEquipos) {
            $prestamoHistoricos = $prestamoHistoricos->with('equipos');
        }

        return new PrestamoHistoricoCollection($prestamoHistoricos->paginate()->appends($request->query()));
    }
}

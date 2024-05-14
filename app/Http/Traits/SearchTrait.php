<?php

namespace App\Http\Traits;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

trait SearchTrait
{
    /**
     * Realiza una búsqueda en las tablas y campos especificados.
     *
     * @param string $searchTerm El término de búsqueda.
     * @param array $tables Las tablas donde buscar.
     * @param array $fields Los campos donde buscar, organizados por tabla.
     * @param array $joins Los joins necesarios para relacionar las tablas.
     * @return AnonymousResourceCollection
     */
    protected function searchQuery($searchTerm, $tables, $fields, $joins = [])
    {
        $model = $this->getModel();
        $relations = $this->getRelations();
        $query = DB::table($tables[0]);

        foreach ($joins as $join) {
            $query->join(
                $join['table'],
                $join['firstKey'],
                $join['operator'] ?? '=',
                $join['secondKey']
            );
        }

        $conditions = [];
        foreach ($tables as $table) {
            foreach ($fields[$table] as $field) {
                $conditions[] = [$table . '.' . $field, 'like', '%' . $searchTerm . '%'];
            }
        }

        $query->where(function ($query) use ($conditions) {
            foreach ($conditions as $condition) {
                $query->orWhere(...$condition);
            }
        });


        $modelIds = $query->pluck($model->getTable() . '.' . $model->getKeyName())->toArray();
        $models = $model::whereIn($model->getKeyName(), $modelIds)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->get();

        return $models;
    }
}

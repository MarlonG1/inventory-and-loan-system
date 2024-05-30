<?php

namespace App\Http\Interfaces;
interface ISearch
{
    function getModel();
   function getRelations(): array;
    function getTables(): array;
    function getFields(): array;
    function getJoins(): array;
}

?>

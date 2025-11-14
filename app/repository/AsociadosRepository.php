<?php
namespace dwes\app\repository;

use dwes\core\database\QueryBuilder;

class AsociadosRepository extends QueryBuilder
{
    public function __construct(
        string $table = 'asociados',
        string $classEntity = \dwes\app\entity\Asociado::class
    ) {
        parent::__construct($table, $classEntity);
    }
}

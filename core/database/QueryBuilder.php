<?php
namespace dwes\core\database;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\NotFoundException;

use dwes\app\entity\IEntity;
use dwes\app\entity\Imagen;

use dwes\core\App;

use PDO;
use PDOException;

abstract class QueryBuilder
{
    /**
     * @var PDO
     */
    private $connection;

    private $table;
    private $classEntity;
    public function __construct(string $table, string $classEntity)

    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }
    /* Función que le pasamos el nombre de la tabla y el nombre
 de la clase a la cual queremos convertir los datos extraidos
 de la tabla.
 La función devolverá un array de objetos de la clase classEntity. */
    /**
     * @param string $tabla
     * @param string $classEntity
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->table";
        $pdoStatement = $this->connection->prepare($sql);
        if ($pdoStatement->execute() === false)
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        /* PDO::FETCH_CLASS indica que queremos que devuelva los datos en un array de clases. Los
nombres
 de los campos de la BD deben coincidir con los nombres de los atributos de la clase.
 PDO::FETCH_PROPS_LATE hace que se llame al constructor de la clase antes que se asignen los
valores. */
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    /**
     * @param int $id
     * @return IEntity
     * @throws NotFoundException
     * @throws QueryException
     */
    public function find(int $id): IEntity
{
    try {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);

        if ($stmt->execute([':id' => $id]) === false) {
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
        $entity = $stmt->fetch();

        if (!$entity) {
            throw new NotFoundException("No se ha encontrado ningún elemento con id $id.");
        }

        return $entity;
    } catch (PDOException $e) {
        throw new QueryException("Error al ejecutar la consulta. " . $e->getMessage());
    }
}

    /**
     * @param IEntity $entity
     * @return void
     * @throws QueryException
     */
    public function save(IEntity $entity): void
    {
        try {
            $parametrers = $entity->toArray();
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parametrers)),
                ':' . implode(', :', array_keys($parametrers))
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parametrers);
        } catch (PDOException $exception) {
            throw new QueryException("Error al insertar en la base de datos. ".$exception);
        }
    }
}

<?php
/**
 *
 * @author aduartem
 *
 */
require 'Notes_class.php';

// Ejemplo de uso:
// Desde línea de comando ir al directorio del proyecto e ingresar:
// php cli.php listar
// php cli.php listar 1

if (PHP_SAPI === 'cli') 
{
    $notas = new Notes();

    if( ! array_key_exists(1, $argv))
    {
        exit("Debe ingresar la acción a realizar." . PHP_EOL);
    }

    $method = $argv[1];

    $resp = array();

    switch($method)
    {
        case 'listar':

            $id = NULL;
            if( array_key_exists(2, $argv))
                $id = $argv[2];

            $resp = $notas->get($id);
            break;

        case 'agregar':

            if( ! array_key_exists(2, $argv))
            {
                exit("Debe ingresar el título." . PHP_EOL);
            }

            if( ! array_key_exists(3, $argv))
            {
                exit("Debe ingresar el contenido." . PHP_EOL);
            }

            $title = $argv[2];
            $body = $argv[3];
            $resp = $notas->create($title, $body);
            break;

        case 'editar':

            if( ! array_key_exists(2, $argv))
            {
                exit("Debe ingresar el id." . PHP_EOL);
            }

            if( ! array_key_exists(3, $argv))
            {
                exit("Debe ingresar el título." . PHP_EOL);
            }

            if( ! array_key_exists(4, $argv))
            {
                exit("Debe ingresar el contenido." . PHP_EOL);
            }

            $id = $argv[2];
            $title = $argv[3];
            $body = $argv[4];
            $resp = $notas->update($id, $title, $body);
            break;

        case 'eliminar':

            if( ! array_key_exists(2, $argv))
            {
                exit("Debe ingresar el id." . PHP_EOL);
            }

            $id = $argv[2];
            $resp = $notas->delete($id);
            break;

        default:

            echo "Opcion no válida." . PHP_EOL;

            break;
    }
    var_dump($resp);
}
?>
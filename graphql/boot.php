<?php

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

require('types.php');
require('query.php');
/**Esquema */
$schema = new Schema([
    'query' => $rootQuery,
    'mutation' => null
]);

/**Try */

try {
    /**Obtenemos los inputs de la petición */
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput,true);
    /**La consulta que recibimos */
    $query = $input['query'];
    /**Ejecutamos la consulta */
    $result = GraphQL::executeQuery($schema,$query);
    /**Convertimos en el resultado a un array */
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'error' =>[
            'message' => $e->getMessage()
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($output);
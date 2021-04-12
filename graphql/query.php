<?php

use App\Models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**Query principal */
$rootQuery = new ObjectType([
    /**Nombre del Type */
    'name' => 'Query',
    /**Campos */
    'fields' => [
        /**Como resolver cuando se pide un usuario */
        'user' =>[
            /**Tipo de dato de la consulta */
            'type'=> $userType,
            /**Parámetros para ejecutar la consulta */
            'args' =>[
                'id'=> Type::nonNull(Type::int())
            ],
            'resolve'=> function($root,$args){
                $user = User::find($args["id"])->toArray();
                return $user;
            }
        ]
    ]
]);
<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**Tipo de Datos de Usuario */
$userType = new ObjectType([
    /**Nombre del Type */
    'name' => 'User',
    /**Descripción del Tipo */
    'description' => 'Este es el tipo de dato Usuario',
    /**Creamos una closure y pasamos la variable por referencia */
    'fields' => function () use (&$addressType) {
        return  [
            /**Campos */
            'id' => Type::int(),
            'first_name' => Type::string(),
            'last_name' => Type::string(),
            'email' => Type::string(),
            /**Para resolver la direcciones */
            'addresses' => [
                'type' => Type::listOf($addressType),
                'resolve' => function ($root, $args) {
                    /**El padre seria el usuario */
                    $userId = $root['id'];
                    $user = User::where('id', $userId)->with(['addresses'])->first();
                    return $user->addresses->toArray();
                }
            ]

        ];
    }
]);

/**Tipo de Datos de Dirección */
$addressType = new ObjectType([
    /**Nombre del Type */
    'name' => 'Address',
    /**Descripción del Tipo */
    'description' => 'Este es el tipo de dato Dirección',
    /**Campos */
    'fields' => [
        'id' => Type::int(),
        'user_id' => Type::int(),
        'name' => Type::string(),
        'description' => Type::string(),
    ]
]);

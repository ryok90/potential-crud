<?php
return [
    'service_manager' => [
        'factories' => [
            \PotentialCrud\V1\Rest\Developer\DeveloperResource::class => \PotentialCrud\V1\Rest\Developer\DeveloperResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'potential-crud.rest.developer' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/developers[/:developer_id]',
                    'defaults' => [
                        'controller' => 'PotentialCrud\\V1\\Rest\\Developer\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'potential-crud.rest.developer',
        ],
    ],
    'api-tools-rest' => [
        'PotentialCrud\\V1\\Rest\\Developer\\Controller' => [
            'listener' => \PotentialCrud\V1\Rest\Developer\DeveloperResource::class,
            'route_name' => 'potential-crud.rest.developer',
            'route_identifier_name' => 'developer_id',
            'collection_name' => 'developer',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'datanascimento',
                1 => 'sexo',
                2 => 'nome',
                3 => 'idade',
                4 => 'hobby',
            ],
            'page_size' => '-1',
            'page_size_param' => 'page_size',
            'entity_class' => \Application\Entity\Developer::class,
            'collection_class' => \PotentialCrud\V1\Rest\Developer\DeveloperCollection::class,
            'service_name' => 'Developer',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'PotentialCrud\\V1\\Rest\\Developer\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'PotentialCrud\\V1\\Rest\\Developer\\Controller' => [
                0 => 'application/vnd.potential-crud.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'PotentialCrud\\V1\\Rest\\Developer\\Controller' => [
                0 => 'application/vnd.potential-crud.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            'PotentialCrud\\V1\\Rest\\Developer\\DeveloperEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'potential-crud.rest.developer',
                'route_identifier_name' => 'developer_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \PotentialCrud\V1\Rest\Developer\DeveloperCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'potential-crud.rest.developer',
                'route_identifier_name' => 'developer_id',
                'is_collection' => true,
            ],
            \Application\Entity\Developer::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'potential-crud.rest.developer',
                'route_identifier_name' => 'developer_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'PotentialCrud\\V1\\Rest\\Developer\\Controller' => [
            'input_filter' => 'PotentialCrud\\V1\\Rest\\Developer\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'PotentialCrud\\V1\\Rest\\Developer\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'message' => 'Máximo de 64 caracteres',
                        ],
                    ],
                    1 => [
                        'name' => \Laminas\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'O valor não deve ser vazio',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'nome',
                'description' => 'Nome do Desenvolvedor',
                'field_type' => 'string',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Date::class,
                        'options' => [
                            'message' => 'Deve estar no formato "Y-m-d". Ex: "2010-10-20"',
                            'format' => 'Y-m-d',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\ToNull::class,
                        'options' => [],
                    ],
                ],
                'name' => 'datanascimento',
                'field_type' => \DateTime::class,
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'message' => 'Máximo de 64 caracteres',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\ToNull::class,
                        'options' => [],
                    ],
                ],
                'name' => 'hobby',
            ],
            3 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '1',
                            'message' => 'Máximo de 1 caractere',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StringToUpper::class,
                        'options' => [],
                    ],
                    2 => [
                        'name' => \Laminas\Filter\ToNull::class,
                        'options' => [],
                    ],
                ],
                'name' => 'sexo',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '10',
                            'message' => 'Máximo de 10 dígitos',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\Digits::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\ToNull::class,
                        'options' => [],
                    ],
                ],
                'name' => 'idade',
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'PotentialCrud\\V1\\Rest\\Developer\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];

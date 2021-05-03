<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        	
        'nameProduct' => $faker->name,
        'unit' => 1,
        'price' => 1,
        'stock' => 1,
        'id_creator' => 1,
        'idStore' => 1,
    ];
});

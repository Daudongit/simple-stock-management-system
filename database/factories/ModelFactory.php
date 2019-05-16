<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
//use Faker\Generator as Faker;
//use Faker\Generator\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function ($faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone'=>$faker->phoneNumber,
        'role_id'=>function(){
            return factory('App\Models\Role')->create()->id;
        },
        'address'=>$faker->address,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Item::class,function($faker){
    return  [
        'name'=>$faker->bs,
        'price'=>$faker->numberBetween(100,2000)
    ];
});

$factory->define(App\Models\Sale::class,function($faker){
    return  [
        'user_id'=>function(){
            return factory('App\Models\User')->create()->id;
        },
        'buyer'=>$faker->name,
        'discount'=>$faker->numberBetween(0,20)
    ];
});

$factory->define(App\Models\Role::class,function($faker){
    return  [
        'title'=>$faker->word,
    ];
});

$factory->define(App\Models\Journal::class,function($faker){
    $type = ['credit','debit'];
    
    return  [
        'type'=>$type[$faker->numberBetween(0,1)],
        'user_id'=>function(){
            return factory('App\Models\User')->create()->id;
        },
        'buyer'=>$faker->name
    ];
});

$factory->define(App\Models\Purchase::class,function($faker){
    return  [
        'user_id'=>function(){
            return factory('App\Models\User')->create()->id;
        },
        'purchaser'=>$faker->name
    ];
});

$factory->define(App\Models\Miscellaneous::class,function($faker){
    return  [
        'amount'=>$faker->numberBetween(500,3000),
        'purpose'=>$faker->sentence
    ];
});
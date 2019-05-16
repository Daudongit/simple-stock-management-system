<?php

use Illuminate\Database\Seeder;

class DBSeeder extends Seeder
{   
    protected $count = [
        'user'=>5,
        'item'=>20,
        'sale'=>40,
        'role'=>3,
        'journal'=>10,
        'purchase'=>20,
        'miscellaneous'=>10
    ];

    protected $userRoles = ['Admin','secretry','staff'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\Item',$this->count['item'])->create();
        factory('App\Models\Miscellaneous',$this->count['miscellaneous'])->create();
        
        $this->customizedFactories();
    }

    private function customizedFactories()
    {   
        $this->admin();
        $this->users();
        $this->sales();
        $this->roles();
        $this->journals();
        $this->purchases();
    }

    private function admin()
    {
        factory('App\Models\User')->create([
            'email'=>'admin@mail.com',
            'role_id'=>1
        ]);
    }
    private function users()
    {
        factory('App\Models\User',$this->count['user'])->create([
            'role_id'=>rand(2,$this->count['role'])
        ]);
    }

    private function sales()
    {
        factory('App\Models\Sale',$this->count['sale'])->create([
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    private function roles()
    {   
        collect($this->userRoles)->each(function($role){
            factory('App\Models\Role')->create([
                'title'=>$role
            ]);
        });
    }

    private function journals()
    {
        factory('App\Models\Journal',$this->count['journal'])->create([
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    private function purchases()
    {
        factory('App\Models\Purchase',$this->count['purchase'])->create([
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }
}

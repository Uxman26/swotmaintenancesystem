<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the role IDs
        $salesPersonRoleId = Role::where('display_name', 'Sales Person')->value('id');
        // Add more roles as needed...
        
        // Create the first user
        $user1 = \App\Models\User::create([
            'role_id' => $salesPersonRoleId,
            'name' => 'Sales Representative 1',
            'email' => 'salesperson1@mail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now()
        ]);
        
        // Create the second user
        $user2 = \App\Models\User::create([
            'role_id' => $salesPersonRoleId,
            'name' => 'Sales Representative 2',
            'email' => 'salesperson2@mail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now()
        ]);
    }
    
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Are you sure to refresh migration ?')) {
            $this->command->call('migrate:fresh');
            $this->command->line('fresh done');

            factory(\App\Entities\Hotel::class, 10)->create();

            $this->call(FacilitiesSeeder::class);
        }
    }
}
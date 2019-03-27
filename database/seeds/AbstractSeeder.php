<?php

abstract class AbstractSeeder extends \Illuminate\Database\Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('zh_TW');
    }

    abstract public function run();
}
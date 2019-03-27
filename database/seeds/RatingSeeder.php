<?php

class RatingSeeder extends AbstractSeeder
{
    public function run()
    {
        /** @var \Illuminate\Database\Eloquent\Builder $entity */
        $entity = App::make(\App\Entities\HotelRating::class);

        for ($i = 1; $i <= HotelSeeder::$hotelNums; $i++) {
            $entity->create([
                'hotel_id' => $i,
                'overall'  => $this->faker->numberBetween(10, 100),
                'facility' => $this->faker->numberBetween(10, 100),
                'position' => $this->faker->numberBetween(10, 100),
                'service'  => $this->faker->numberBetween(10, 100),
                'cp'       => $this->faker->numberBetween(10, 100)
            ]);
        }
    }
}
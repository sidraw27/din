<?php

class RatingSeeder extends AbstractSeeder
{
    public function run()
    {
        /** @var \Illuminate\Database\Eloquent\Builder $entity */
        $entity = App::make(\App\Entities\HotelRating::class);
        /** @var \Illuminate\Database\Eloquent\Builder $entity */
        $agodaEntity = App::make(\App\Entities\AgodaRating::class);
        /** @var \Illuminate\Database\Eloquent\Builder $entity */
        $bookingEntity = App::make(\App\Entities\BookingRating::class);

        for ($hotelId = 1; $hotelId <= HotelSeeder::$hotelNums; $hotelId++) {
            $agodaId = $agodaEntity->insertGetId([
                'overall'     => $this->faker->numberBetween(10, 100),
                'facility'    => $this->faker->numberBetween(10, 100),
                'position'    => $this->faker->numberBetween(10, 100),
                'comfortable' => $this->faker->numberBetween(10, 100),
                'service'     => $this->faker->numberBetween(10, 100),
                'cp'          => $this->faker->numberBetween(10, 100)
            ]);

            $bookingId = $bookingEntity->insertGetId([
                'quality'     => $this->faker->numberBetween(10, 100),
                'facility'    => $this->faker->numberBetween(10, 100),
                'clear'       => $this->faker->numberBetween(10, 100),
                'comfortable' => $this->faker->numberBetween(10, 100),
                'cp'          => $this->faker->numberBetween(10, 100),
                'position'    => $this->faker->numberBetween(10, 100),
                'free_wifi'   => $this->faker->numberBetween(10, 100)
            ]);

            $entity->create([
                'hotel_id'   => $hotelId,
                'agoda_id'   => $agodaId,
                'booking_id' => $bookingId,
            ]);
        }
    }
}
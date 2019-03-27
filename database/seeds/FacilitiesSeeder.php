<?php

class FacilitiesSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $facilities = [
            '可使用語言' => [
                '英語',
                '日語',
                '韓語'
            ],
            '網路服務' => [
                '公共區域Wi-Fi',
                '房內免費Wi-Fi'
            ],
            '休閒娛樂設施' => [
                '按摩'
            ],
            '餐飲服務' => [
                '自動販賣',
                '餐廳'
            ],
            '服務與便利設施' => [
                '可寄放行李',
                '保險箱',
                '乾洗服務',
                '吸煙區',
                '送洗服務'
            ],
            '接待設施'=> [
                '電梯',
                '無障礙友善設施',
                '輪椅友善設施'
            ]
        ];

        /** @var \Illuminate\Database\Eloquent\Builder $entity */
        $entity = App::make(\App\Entities\HotelFacility::class);

        foreach ($facilities as $group => $item) {
            foreach ($item as $facility) {
                $entity->create([
                    'group' => $group,
                    'name'  => $facility
                ]);
            }
        }

        $facilities = \App\Entities\HotelFacility::all();

        $count = $facilities->count();

        $entity = App::make(\App\Entities\HotelSupportFacility::class);

        for ($i = 1; $i <= 10; $i++) {
            $supportFacilities = $facilities->random(random_int(5, $count));

            foreach ($supportFacilities as $facility) {
                $entity->create([
                    'hotel_id'    => $i,
                    'facility_id' => $facility->id,
                    'is_active'   => true
                ]);
            }
        }
    }
}
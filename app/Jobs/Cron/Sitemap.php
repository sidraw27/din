<?php

namespace App\Jobs;

use App\Http\Controllers\Controller;
use App\Repositories\HotelRepository;

class SitemapJob extends Controller
{
    const PER_NUMS = 20000;

    private $hotelRepo;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepo = $hotelRepository;
    }

    public function updateRobots()
    {
        $content[] = 'User-agent: *';
        $content[] = 'Disallow: /api/';

        $hotelSitemap = $this->generateHotelSitemap();

        $content = array_merge($content, $hotelSitemap);
        $content = implode(PHP_EOL, $content);

        $robot = 'robots.txt';
        \Storage::disk('site_public')->delete($robot);
        \Storage::disk('site_public')->put($robot, $content);
    }

    private function generateHotelSitemap()
    {
        $content   = [];
        $total     = $this->hotelRepo->getTotal();
        $totalPage = ceil($total / self::PER_NUMS);

        for ($i = 1; $i <= $totalPage; $i++) {
            $start   = ($i - 1) * self::PER_NUMS;
            $hotels  = $this->hotelRepo->getByRange($start, self::PER_NUMS);
            $sitemap = [];

            foreach ($hotels as $hotel) {
                $sitemap[] = [
                    'link'       => route("hotel", ['urlId' => $hotel->url_id]),
                    'modifyDate' => date('Y-m-d', strtotime($hotel->posted_at)),
                    'priority'   => 0.9
                ];
            }

            $fileName  = "hotel/{$i}.xml";
            $view      = \View::make('sitemap', compact('sitemap'));
            $content[] = 'Sitemap: ' . route('index') . '/' . $fileName;

            \Storage::disk('sitemap')->deleteDir('hotel');
            \Storage::disk('sitemap')->makeDirectory('hotel');
            \Storage::disk('sitemap')->put($fileName, $view);
        }

        return $content;
    }
}

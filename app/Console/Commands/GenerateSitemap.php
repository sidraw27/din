<?php

namespace App\Jobs;

use App\Repositories\HotelRepository;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate sitemap begin';

    const PER_NUMS = 20000;

    private $hotelRepo;

    public function __construct(HotelRepository $hotelRepository)
    {
        parent::__construct();
        $this->hotelRepo = $hotelRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $content[] = 'User-agent: *';
        $content[] = 'Disallow: /api/';

        $hotelSitemap = $this->generateHotelSitemap();

        $content = array_merge($content, $hotelSitemap);
        $content = implode(PHP_EOL, $content);

        $robot = 'robots.txt';
        \Storage::disk('site_public')->delete($robot);
        \Storage::disk('site_public')->put($robot, $content);

        echo "generate successful\n";
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

            $fileName  = "sitemap/hotel/{$i}.xml";
            $view      = \View::make('sitemap', compact('sitemap'));
            $content[] = 'Sitemap: ' . route('index') . '/' . $fileName;

            \Storage::disk('site_public')->deleteDir('sitemap/hotel');
            \Storage::disk('site_public')->put($fileName, $view);
        }

        return $content;
    }
}

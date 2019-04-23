<?php

namespace App\Http\Controllers;

use App\Services\Hotel\HotelService;
use App\Transformer\HotelTransformer;
use App\Exceptions\HotelException;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index()
    {
        return view('index');
    }

    public function page(string $urlId)
    {
        $searchData = $this->hotelService::formatHotelParameter(\Request::all());

        try {
            $hotel     = $this->hotelService->getHotel($urlId);
            $hotelView = HotelTransformer::transToHotelView($hotel);

            if (is_null($searchData['target']) || strlen($searchData['target']) === 0) {
                $searchData['target'] = $hotelView['name']['origin'];
            }

            $buildLink = $searchData;
            $buildLink['target'] = $hotelView['name']['origin'];
            $listLink = route('list') . '?' . http_build_query($buildLink);
            $isShowSearchBar = ( ! \Agent::isMobile());
        } catch (HotelException $e) {
            abort(404);
        }

        return view('hotel', compact(
            'hotelView',
            'searchData',
            'isShowSearchBar',
            'listLink'
        ));
    }

    public function list()
    {
        $searchData = $this->hotelService::formatHotelParameter(\Request::all());

        $list = $this->hotelService->getList($searchData['target'], \Request::get('page', 1), 10, $searchData);

        $isShowSearchBar = true;

        return view('list', compact('searchData', 'list', 'isShowSearchBar'));
    }
}

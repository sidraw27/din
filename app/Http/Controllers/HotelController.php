<?php

namespace App\Http\Controllers;

use App\Services\Hotel\HotelService;
use App\Services\Meta\MetaGenerator;
use App\Transformer\HotelTransformer;
use App\Exceptions\HotelException;

class HotelController extends Controller
{
    private $hotelService;
    private $metaGenerator;
    private $isShowSearchBar;

    public function __construct(HotelService $hotelService, MetaGenerator $metaGenerator)
    {
        $this->hotelService    = $hotelService;
        $this->metaGenerator   = $metaGenerator;

        $this->isShowSearchBar = true;
    }

    public function index()
    {
        $meta = $this->metaGenerator->getIndexMeta();

        return view('index', compact('meta'));
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

            $meta = $this->metaGenerator->getHotelMeta($hotelView);
        } catch (HotelException $e) {
            abort(404);
        }

        $isShowSearchBar = ($this->isShowSearchBar && ( ! \Agent::isMobile()));

        return view('hotel', compact(
            'hotelView',
            'searchData',
            'isShowSearchBar',
            'listLink',
            'meta'
        ));
    }

    public function list()
    {
        $searchData  = $this->hotelService::formatHotelParameter(\Request::all());

        $currentPage = \Request::get('page', 1);
        if ($currentPage > 99) {
            $currentPage = 99;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $list = $this->hotelService->getList($searchData['target'], $currentPage, 10, $searchData);

        $meta = $this->metaGenerator->getListMeta($list, $searchData, $currentPage);

        $viewData = array_merge([
            'isShowSearchBar' => $this->isShowSearchBar
        ], compact('searchData', 'list', 'meta'));

        return view('list', $viewData);
    }
}

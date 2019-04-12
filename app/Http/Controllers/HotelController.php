<?php

namespace App\Http\Controllers;

use App\Services\HotelService;
use App\Transformer\HotelTransformer;
use App\Exceptions\HotelException;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(string $urlId)
    {
        try {
            $hotel     = $this->hotelService->getHotel($urlId);
            $hotelView = HotelTransformer::transToHotelView($hotel);
        } catch (HotelException $e) {
            abort(404);
        }

        return view('hotel', compact('hotelView'));
    }

    public function list()
    {
        $validator = $this->validateHotelParameter();

        if ($validator->fails()) {
            $response['message'] = implode(',', $validator->messages()->all());

            return response()->json($response, 422);
        }

        $searchData = $validator->getData();

        return view('list', compact('searchData'));
    }

    private function validateHotelParameter()
    {
        $searchData = \Request::all([
            'search', 'check-in', 'check-out', 'adult'
        ]);

        $dateReg = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';

        return \Validator::make($searchData, [
            'search'    => ['required', 'string'],
            'check-in'  => ['required', "regex:{$dateReg}"],
            'check-out' => ['required', "regex:{$dateReg}"],
            'adult'     => ['required', 'numeric']
        ], [
            'required' => ':attribute was required',
            'regex'    => 'Invalid request format: :attribute'
        ]);
    }
}

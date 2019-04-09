<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ProviderException;
use App\Http\Controllers\Controller;
use App\Services\AffiliateService;
use Illuminate\Support\Arr;

class AffiliateController extends Controller
{
    private $affiliateService;

    public function __construct(AffiliateService $affiliateService)
    {
        $this->affiliateService = $affiliateService;
    }

    public function getPrice(int $hotelId)
    {
        $data = \Request::all();
        $data = Arr::add($data, 'hotel-id', $hotelId);

        $dateReg = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';

        $validator = \Validator::make($data, [
            'hotel-id'  => ['required', 'numeric'],
            'check-in'  => ['required', "regex:{$dateReg}"],
            'check-out' => ['required', "regex:{$dateReg}"],
            'provider'  => ['required'],
            'nums'      => ['required', 'numeric']
        ], [
            'required' => ':attribute was required',
            'regex'    => 'Invalid request format: :attribute'
        ]);

        $response = ['message' => 'ok'];

        if ($validator->fails()) {
            $response['message'] = implode(',', $validator->messages()->all());

            return response()->json($response, 422);
        }

        try {
            $response['message'] = $this->affiliateService->getPriceByProvider(
                $data['provider'],
                $data['hotel-id'],
                $data['check-in'],
                $data['check-out'],
                $data['nums']
            );
        } catch (ProviderException $e) {
            $response['message'] = $e->getMessage();

            return response()->json($response, 404);
        }

        return response()->json($response, 202);
    }
}
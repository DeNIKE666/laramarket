<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\InOutRequest;
use App\Services\Payments\ComissionsService;
use Illuminate\Http\Response;

class ComissionsPayInOutController extends Controller
{
    /**
     * Рассчитать сумму комиссии при пополнении
     *
     * @param InOutRequest $request
     *
     * @return Response
     */
    public function getPayinFee(InOutRequest $request): Response
    {
        $amount = (new ComissionsService())
            ->method($request->input('method'))
            ->amount($request->input('amount'))
            ->payinComission($request->input('is_total_amount'));

        return response(compact('amount', Response::HTTP_OK));
    }
}

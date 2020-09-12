<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\InOutRequest;
use App\Services\Payments\CommissionsService;
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
        $paySystem = $request->input('method');

        $withPaySystem = (new CommissionsService())->paySystem($paySystem);

        $amount = $request->input('is_total_amount')
            ? $withPaySystem->depositWithoutCommission($request->input('amount'))
            : $withPaySystem->depositWithCommission($request->input('amount'));

        return response(compact('amount', 'paySystem'), Response::HTTP_OK);
    }

    /**
     * Рассчитать сумму комиссии при снятии
     *
     * @param InOutRequest $request
     *
     * @return Response
     */
    public function getPayoutFee(InOutRequest $request)
    {
        $paySystem = $request->input('method');

        $withPaySystem = (new CommissionsService())->paySystem($paySystem);

        $amount = $request->input('is_total_amount')
            ? $withPaySystem->withdrawWithoutCommission($request->input('amount'))
            : $withPaySystem->withdrawWithCommission($request->input('amount'));

        return response(compact('amount', 'paySystem'), Response::HTTP_OK);
    }
}

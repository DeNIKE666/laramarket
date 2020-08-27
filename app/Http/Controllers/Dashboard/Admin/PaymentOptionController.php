<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\PaymentOptionRepository;
use App\Models\PaymentOption;

class PaymentOptionController extends Controller
{
    protected $adminPaymentOptionRepository;

    public function __construct(
        PaymentOptionRepository $adminPaymentOptionRepository
    )
    {
        $this->adminPaymentOptionRepository = $adminPaymentOptionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = $this->adminPaymentOptionRepository->listPayments();
        //dump($attributes);
        return  view('dashboard.admin.payment_option.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.payment_option.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'depositeMoney' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'withdrawMoney' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sort' =>  'required|integer'
        ]);

        $data = [
            'title' => $request['title'],
            'ico' => $request['ico'],
            'sort' => $request['sort'],
            'is_refill' => $request['is_refill'] ? $request['is_refill'] : 0,
            'is_withdrawal' => $request['is_withdrawal'] ? $request['is_withdrawal'] : 0,
            'depositeMoney' => $request['depositeMoney'],
            'withdrawMoney' => $request['withdrawMoney']
        ];

        $payment_option = PaymentOption::create($data);


        return redirect()->route('admin.payment_option.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentOption $paymentOption)
    {
        return view('dashboard.admin.payment_option.edit', compact('paymentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentOption $paymentOption)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'depositeMoney' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'withdrawMoney' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sort' =>  'required|integer'
        ]);

        $data = [
            'title' => $request['title'],
            'ico' => $request['ico'],
            'sort' => $request['sort'],
            'is_refill' => $request['is_refill'] ? $request['is_refill'] : 0,
            'is_withdrawal' => $request['is_withdrawal'] ? $request['is_withdrawal'] : 0,
            'depositeMoney' => $request['depositeMoney'],
            'withdrawMoney' => $request['withdrawMoney']
            ];

        $paymentOption->update($data);


        return redirect()->back()->with('status', 'ок');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

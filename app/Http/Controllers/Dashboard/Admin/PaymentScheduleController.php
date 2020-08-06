<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\SettingPaymentScheduleRepository;
use App\Models\PaymentSchedule;

class PaymentScheduleController extends Controller
{
    protected $adminSettingPaymentScheduleRepository;

    public function __construct(
        SettingPaymentScheduleRepository $adminSettingPaymentScheduleRepository
    )
    {
        $this->adminSettingPaymentScheduleRepository = $adminSettingPaymentScheduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->adminSettingPaymentScheduleRepository->listSettings();
        return view(
            'dashboard.admin.setting_payment_schedule_list',
            compact(
                'settings'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'min_percent' => 'required|integer',
            'max_percent' => 'required|integer',
            'quantity_pay_every_month' => 'required|integer',
            'quantity_pay_each_quarter' => 'required|integer',
            'quantity_pay_every_six_months' => 'required|integer',
            'quantity_pay_single' => 'required|integer',
        ]);

        $data = [
            'min_percent' => $request['min_percent'],
            'max_percent' => $request['max_percent'],
            'quantity_pay_every_month' => $request['quantity_pay_every_month'],
            'quantity_pay_each_quarter' => $request['quantity_pay_each_quarter'],
            'quantity_pay_every_six_months' => $request['quantity_pay_every_six_months'],
            'quantity_pay_single' => $request['quantity_pay_single'],
        ];

        PaymentSchedule::create($data);

        return redirect()->route('admin.setting_schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

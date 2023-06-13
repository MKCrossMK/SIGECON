<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Branch_Office;
use App\Models\Policy;
use App\Models\PolicyCancelation;
use App\Models\PolicyPayment;
use App\Models\PolicyRenovation;
use App\Rules\DateGreaterThan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_offices = Branch_Office::all();
        return view('reports.index')->with('branch_offices', $branch_offices);
    }

    public function view(Branch_Office $branch_Office)
    {

        return view('reports.view')->with('branch_Office', $branch_Office);
    }


    public function reportToday(Branch_Office $branch_Office)
    {
        $t_policies = 0;
        $t_payment = 0;
        $t_renovation = 0;
        $t_cancelation = 0;

        $total = 0;

        $policies = Policy::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('DAY(created_at) = DAY(CURDATE())')->get();


        foreach ($policies as $policie) {
            $t_policies += $policie->loan_value;
        }

        $p_payment = PolicyPayment::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('DAY(created_at) = DAY(CURDATE())')->get();

        foreach ($p_payment as $payment) {
            $t_payment += $payment->amount;
        }

        $p_renovation = PolicyRenovation::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('DAY(created_at) = DAY(CURDATE())')->get();

        foreach ($p_renovation as $renovation) {
            $t_renovation += $renovation->amount;
        }

        $p_cancelation = PolicyCancelation::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('DAY(created_at) = DAY(CURDATE())')->get();

        foreach ($p_cancelation as $cancelation) {
            $t_cancelation += $cancelation->amount;
        }

        $total = $t_policies + $t_payment + $t_renovation + $t_cancelation;

        return view('reports.today')
            ->with('branch_Office', $branch_Office)
            ->with('policies', $policies)
            ->with('p_payment', $p_payment)
            ->with('p_renovation', $p_renovation)
            ->with('p_cancelation', $p_cancelation)
            ->with('t_policies', $t_policies)
            ->with('t_payment', $t_payment)
            ->with('t_renovation', $t_renovation)
            ->with('t_cancelation', $t_cancelation)
            ->with('total', $total);
    }



    public function reportMonth(Branch_Office $branch_Office)
    {
        $t_policies = 0;
        $t_payment = 0;
        $t_renovation = 0;
        $t_cancelation = 0;


        $policies = Policy::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->get();


        foreach ($policies as $policie) {
            $t_policies += $policie->loan_value;
        }

        $p_payment = PolicyPayment::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->get();

        foreach ($p_payment as $payment) {
            $t_payment += $payment->amount;
        }

        $p_renovation = PolicyRenovation::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->get();

        foreach ($p_renovation as $renovation) {
            $t_renovation += $renovation->amount;
        }

        $p_cancelation = PolicyCancelation::where('branch_offices_id', $branch_Office->id)
            ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->get();

        foreach ($p_cancelation as $cancelation) {
            $t_cancelation += $cancelation->amount;
        }

        return view('reports.month')
            ->with('branch_Office', $branch_Office)
            ->with('policies', $policies)
            ->with('p_payment', $p_payment)
            ->with('p_renovation', $p_renovation)
            ->with('p_cancelation', $p_cancelation)
            ->with('t_policies', $t_policies)
            ->with('t_payment', $t_payment)
            ->with('t_renovation', $t_renovation)
            ->with('t_cancelation', $t_cancelation);
    }

    public function getReportPerDate(Branch_Office $branch_Office, Request $request)
    {
        $t_policies = 0;
        $t_payment = 0;
        $t_renovation = 0;
        $t_cancelation = 0;


        $request->validate([
            'start_date' => ['required', 'date', new DateGreaterThan($request->end_date)],
            'end_date' => 'required', 'date',
        ], [
            'start_date.required' => 'Fecha de Inicio "DESDE" es requerido',
            'end_date.required'  => 'Fecha de Limite "HASTA" es requerido'
        ]);

        $policies = Policy::where('branch_offices_id', $branch_Office->id)
            ->where('created_at', '>=', $request->start_date . ' 00:00:00')
            ->where('created_at', '<=', $request->end_date . ' 23:59:59')->get();

            
            foreach ($policies as $policie) {
                $t_policies += $policie->loan_value;
            }

        $p_payment = PolicyPayment::where('branch_offices_id', $branch_Office->id)
            ->where('created_at', '>=', $request->start_date . ' 00:00:00')
            ->where('created_at', '<=', $request->end_date . ' 23:59:59')->get();

            foreach ($p_payment as $payment) {
                $t_payment += $payment->amount;
            }

        $p_renovation = PolicyRenovation::where('branch_offices_id', $branch_Office->id)
            ->where('created_at', '>=', $request->start_date . ' 00:00:00')
            ->where('created_at', '<=', $request->end_date . ' 23:59:59')->get();

            foreach ($p_renovation as $renovation) {
                $t_renovation += $renovation->amount;
            }

        $p_cancelation = PolicyCancelation::where('branch_offices_id', $branch_Office->id)
            ->where('created_at', '>=', $request->start_date . ' 00:00:00')
            ->where('created_at', '<=', $request->end_date . ' 23:59:59')->get();

            foreach ($p_cancelation as $cancelation) {
                $t_cancelation += $cancelation->amount;
            }
        
            return view('reports.dates')
            ->with('branch_Office', $branch_Office)
            ->with('policies', $policies)
            ->with('p_payment', $p_payment)
            ->with('p_renovation', $p_renovation)
            ->with('p_cancelation', $p_cancelation)
            ->with('t_policies', $t_policies)
            ->with('t_payment', $t_payment)
            ->with('t_renovation', $t_renovation)
            ->with('t_cancelation', $t_cancelation)
            ->with('start_date', $request->start_date)
            ->with('end_date', $request->end_date);

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
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}

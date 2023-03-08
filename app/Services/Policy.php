<?php

namespace App\Services;

use App\Models\Policy as PolicyModel;
use App\Models\PolicyPayment;
use Illuminate\Support\Facades\DB;
class Policy {

    /**
     * updatePolicyInterestAndContract 
     * @param PolicyModel $policy
     * @return void
     */
    public static function updatePolicyInterestRate(PolicyModel $policy): void
    {
        // Sumar el residuo de la tabla de pagos al insterest_pay

        // Probar al hacer aumentar el interes

        $interest_paid_residuary =  0;
        if($policy->status_credit_pay === 1) {
            $payments_maked = PolicyPayment::select('interest_rate_paid_residuary')->latest('id')->Where('policy_id', $policy->id)->first();
            $interest_paid_residuary = $payments_maked->interest_rate_paid_residuary;
        }


        $policy->interest_rate += $policy->base_interest_rate;
        $policy->interest_pay  = $policy->capital_pay * ( $policy->interest_rate / 100 ) + $interest_paid_residuary;
        $policy->c_interest_pay  = $policy->capital_pay * ( $policy->interest_rate / 100 ) + $interest_paid_residuary;
        $policy->last_updated_interest = date('Y-m-d');
        $policy->save();
        
    }

    /**
     *  getAllExpiredPolicy
     *  @return Simple
     */
    public static function getExpiredPolicyInterest()
    {
        // last_updated_interest

        return PolicyModel::whereIn('status', [PolicyModel::STATUS_APPROVED, PolicyModel::STATUS_RENOVATED])
            ->where(DB::raw('TIMESTAMPDIFF(MONTH, last_updated_interest, CURRENT_DATE)'), 1)
            ->get();
    }



    public static function updatePolicyContractRate(PolicyModel $policy): void 
    {
         // Sumar el residuo de la tabla de pagos al insterest_pay


        // Probar al hacer aumentar el interes

        $contract_paid_residuary =  0;
        if($policy->status_credit_pay === 1) {
            $payments_maked = PolicyPayment::select('contract_rate_paid_residuary')->latest('id')->Where('policy_id', $policy->id)->first();
            $contract_paid_residuary = $payments_maked->contract_rate_paid_residuary;
        }


        $policy->contract_rate += $policy->base_contract_rate;
        $policy->contract_pay  = $policy->capital_pay * ( $policy->contract_rate / 100 ) + $contract_paid_residuary;
        $policy->c_contract_pay  = $policy->capital_pay * ( $policy->contract_rate / 100 ) + $contract_paid_residuary;
        $policy->last_updated_contract = date('Y-m-d');
        $policy->save();
    }

      /**
     *  getExpiredPolicyContract
     *  @return Simple
     */
    public static function getExpiredPolicyContract()
    {
        // last_updated_contract

        return PolicyModel::whereIn('status', [PolicyModel::STATUS_APPROVED, PolicyModel::STATUS_RENOVATED])
            ->where(DB::raw('TIMESTAMPDIFF(MONTH, last_updated_contract, CURRENT_DATE)'), 4)
            ->get();
    }



    public static function getExpiredPolicy(){

        return PolicyModel::whereIn('status', [PolicyModel::STATUS_APPROVED, PolicyModel::STATUS_RENOVATED])->
        where(DB::raw('TIMESTAMPDIFF(DAY, date_start, CURRENT_DATE)'), 125)->get();
    }

    public static function updatePolicyStatusToExpired(PolicyModel $policy):void
    {
        $policy->update([
            'status' => PolicyModel::STATUS_EXPIRED,
        ]);
    }


    public static function getExpiredPolicyNineMonth (){

        return PolicyModel::whereIn('status', [PolicyModel::STATUS_APPROVED, PolicyModel::STATUS_RENOVATED])
        ->where(DB::raw('TIMESTAMPDIFF(MONTH, last_updated_interest, CURRENT_DATE)'), 9)
        ->get();

    }

    public static function updateExpiredPolicyNineMonthd(PolicyModel $policy):void
    {
        $policy->update([
            'status',   // Poner el cierre de correspondiente
        ]);
    }



    // Relacion entre los modelos 
    // Poliza nueva
    // Poliza vieja

    // Subasta(fecha, )
    // Detalle Subasta(id, id_subasta, id_poliza, poliza_class_name ) 

    //

    // No voy a ser una relacion eloquent sino un funcion 







}
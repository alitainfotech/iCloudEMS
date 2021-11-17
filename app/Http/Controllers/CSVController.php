<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CommonFeeCollection;
use App\Models\CommonFeeCollectionHeadwise;
use App\Models\feeCategory;
use App\Models\feeCollectionType;
use App\Models\feeType;
use App\Models\FinancialTrans;
use App\Models\FinancialTransDetails;
use Illuminate\Http\Request;

class CSVController extends Controller
{

    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        //Read excel file
        $name = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($name));
        foreach ($data as $key => $value) {
            if ($key >= 6) {

                // Branch
                $branchs = Branch::where('name', $value['11'])->first();
                if (empty($branchs)) {
                    $data[] = [
                        'name' => $value['11']
                    ];
                }

                // Fees category
                $feecategoryRecord = feeCategory::where('feeCategory', '=', $value['10'])->first();
                if (empty($feecategoryRecord)) {
                    $feecategory = feeCategory::create([
                        'feeCategory' => $value['10'],
                        'br_id' => $branch_id
                    ]);
                    $feecategory_id = $feecategory->id;
                } else {
                    $feecategory_id = $feecategoryRecord['id'];
                }


                //feeCollectionType
                $feecollectionRecord = feeCollectionType::where('collectionhead', '=', 'Academic')->where('br_id', '=', $branch_id)->first();
                if (empty($feecollectionRecord)) {
                    $feecollectiontype = feeCollectionType::create([
                        'collectionhead' => 'Academic',
                        'collectionDescription' => 'Academic',
                        'br_id' => $branch_id
                    ]);
                    $feecollectiontype_id = $feecollectiontype->id;
                } else {
                    $feecollectiontype_id = $feecollectionRecord->id;
                }


                //feetype
                $feetypeRecord = feeType::where('f_name', '=', $value['16'])->where('br_id', '=', $branch_id)->where('fee_type_ledger', '=', $value['16'])->first();
                if (empty($feetypeRecord)) {
                    $feetype = feeType::create([
                        'fee_id' => $feecategory_id,
                        'f_name' => $value[16],
                        'collection_id' => $feecollectiontype_id,
                        'br_id' => $branch_id,
                        'fee_type_ledger' => $value[16],
                    ]);

                }

                $module_id = 1;

                $academic_misc_arr = array('fine fee', 'exam paper fine fee', 'adjustable_excess_amount', 'library fine fee', 'security fee', 'reckeking/security fee');
                $hostel_arr = array('mess fee');
                if (in_array(strtolower($value[16]), $academic_misc_arr)) {
                    $module_id = 11;
                } elseif (in_array(strtolower($value[16]), $hostel_arr)) {
                    $module_id = 2;
                }
                $financial_trans_find = FinancialTrans::where('tran_id', '=', $value[6])->where('module_id', '=', $module_id)->where('br_id', '=', $branch_id)->first();
                if (empty($financial_trans_find)) {
                    $time = strtotime($value[1]);
                    $tran_date = date('Y-m-d', $time);
                    $financial_trans = FinancialTrans::create([
                        'module_id' => $module_id,
                        'tran_id' => $value[6],
                        'amount' => $value[18],
                        'tranDate' => $tran_date,
                        'acadYear' => $value[2],
                        'entrymode' => $value[2],
                        'Voucherno' => $value[6],
                        'br_id' => $branch_id,
                        'due_amount' => $value[17],
                        'scholarship' => $value[20],
                        'duerev' => $value[21],
                        'scholarship_rev' => $value[22],
                    ]);
                    $financial_trans_id = $financial_trans->id;
                } else {
                    $financial_trans_find->amount = $financial_trans_find->amount + $value[18];
                    $financial_trans_find->due_amount = $financial_trans_find->due_amount + $value[17];
                    $financial_trans_find->scholarship = $financial_trans_find->scholarship + $value[20];
                    $financial_trans_find->duerev = $financial_trans_find->duerev + $value[21];
                    $financial_trans_find->scholarship_rev = $financial_trans_find->scholarship_rev + $value[22];
                    $financial_trans_find->save();
                    $financial_trans_id = $financial_trans_find->id;
                }
                $head = feeType::where('br_id', '=', $branch_id)->where('f_name', '=', $value[16])->first();
                $head_id = $head['id'];
                $financial_trans_details_find = FinancialTransDetails::where('financialtran_id', '=', $financial_trans_id)->where('module_id', '=', $module_id)->where('head_id', '=', $head_id)->first();
                $cr_dr = '0';
                if ($value[17] > 0 || $value[19] > 0 || $value[20] > 0 || $value[22] > 0 || $value[23] > 0 || $value[24] > 0) {
                    $cr_dr = '1';
                }
                if (empty($financial_trans_details_find)) {
                    $time = strtotime($value[1]);
                    $tran_date = date('Y-m-d', $time);
                    $financial_trans = FinancialTransDetails::create([
                        'financialtran_id' => $financial_trans_id,
                        'module_id' => $module_id,
                        'amount' => $value[18],
                        'head_id' => $head_id,
                        'crdr' => $cr_dr,
                        'br_id' => $branch_id,
                        'head_name' => $value[16]
                    ]);
                }

                $common_fee_collection = CommonFeeCollection::where('trans_id', '=', $financial_trans_id)->where('module_id', '=', $module_id)->where('admno', '=', $value[8])->first();
                if (empty($common_fee_collection)) {
                    $common_fee_collection_create = CommonFeeCollection::create([
                        'module_id' => $module_id,
                        'trans_id' => $financial_trans_id,
                        'admno' => $value[8],
                        'rollno' => $value[7],
                        'amount' => $value[18],
                        'br_id' => $branch_id,
                        'acadamicYear' => $value[2],
                        'financialYear' => $value[3],
                        'displayReceiptNo' => $value[15],
                        'Entrymode' => $cr_dr
                    ]);
                    $common_fee_collection_id = $common_fee_collection_create->id;
                } else {
                    $common_fee_collection['amount'] = $common_fee_collection['amount'] + $value[18];
                    $common_fee_collection->save();
                    $common_fee_collection_id = $common_fee_collection->id;
                }

                $common_fee_collection_headwise = CommonFeeCollectionHeadwise::where('module_id', '=', $module_id)->where('receipt_id', '=', $value[15])->where('head_id', '=', $head_id)->where('br_id', '=', $branch_id)->first();
                if (empty($common_fee_collection_headwise)) {
                    $common_fee_collection_headwise_create = CommonFeeCollectionHeadwise::create([
                        'module_id' => $module_id,
                        'receipt_id' => $value[15],
                        'head_id' => $head_id,
                        'headName' => $value[16],
                        'br_id' => $branch_id,
                        'amount' => $value[18]
                    ]);
                }
            }
        }
//        Branch::insert($data);
//        \Maatwebsite\Excel\Facades\Excel::import(new ExcelImport(),$request->file('file'));
        return back()->with('success', 'Uplode file successfully!');
    }

    //List Branche
    public function listbranch()
    {
        $listBranchdata = Branch::all();

        return view('listBranch', compact('listBranchdata'));
    }

    //List Feecategory
    public function listFeeCategory()
    {
        $listFeeCategorydata = feeCategory::with(['branch'])->get();

        return view('listFeeCategory', compact('listFeeCategorydata'));
    }


    //FeeCollectionType List
    public function listFeeCollectionType()
    {
        $listFeeCollectionTypeData = feeCollectionType::with(['branch' => function ($query) {
            $query->groupBy('name');
        }])->groupBy('br_id')->get();

        return view('listFeeCollectionType', compact('listFeeCollectionTypeData'));
    }

    //List FeeType
    public function listFeeType()
    {
        $listFeeTypeData = feeType::with(['branch'])->groupBy('br_id')->get();

        return view('listFeeType', compact('listFeeTypeData'));
    }


    //List  FinancialTrans
    public function listfinancialTrans()
    {
        $listfinancialTransData = FinancialTrans::with(['branch'])->get();

        return view('listfinancialTrans', compact('listfinancialTransData'));
    }

    //List Financial Transdetail
    public function listfinancialTransdetail()
    {
        $listfinancialTransdetaildata = FinancialTransDetails::with(['branch'], ['module'])->get();
        return view('financialTransdetail', compact('listfinancialTransdetaildata'));
    }
}

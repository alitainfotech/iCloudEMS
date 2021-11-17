<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\feeCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToCollection
{
    private $feeCategory,$branch;

    public function __construct()
    {
        $this->feeCategory = feeCategory::with('branch')->select('id','feeCategory','br_id')->get();
        $this->branch = Branch::where('id','name')->get();
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $branch = $this->branch->where('name',$row['11'])->first();
            return new feeCategory([
                'br_id' =>$branch->id,
                'feeCategory' => $collection['10']
            ]);
        }

//        $feeCategory = $this->feeCategory->where('branch.name',$collection['11'])->first();

    }
}

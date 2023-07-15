<?php

namespace App\Imports;

use App\Models\ReportAgencyExtraction;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportReportAgencyExtraction implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd('import : '.$row[0]. ' '.$row[1]. ' '.$row[2]);

        return new ReportAgencyExtraction([
            
        ]);
    }
}

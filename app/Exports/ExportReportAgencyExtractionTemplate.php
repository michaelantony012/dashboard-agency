<?php

namespace App\Exports;

use App\Models\ReportAgencyExtraction;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportReportAgencyExtractionTemplate implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReportAgencyExtraction::all();
    }
}

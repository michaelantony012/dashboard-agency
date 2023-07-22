<?php

namespace App\Imports;

use App\Models\Host;
use App\Models\Agency;
use App\Models\Platform;
use App\Models\ReportExtraction;
use App\Models\ReportAgencyExtraction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportReportAgencyExtraction implements ToModel, WithStartRow
{

    private $report_code;
    private $report_idl;

    public function __construct(string $report_code, int $report_id) 
    {
        $this->report_code = $report_code;
        $this->report_id = $report_id;
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd('import : '.$row[0]. ' '.$row[1]. ' '.$row[2]);
        // dd($this->report_id . " ". $this->report_code);

        // dd($row[4]);

        $host = Host::where('host_uid', $row[1])->first();
        $agency = Agency::where('agency_name', $row[2])->first();
        $platform = Platform::where('platform_name', $row[3])->first();
        return new ReportAgencyExtraction([
            'report_id' => $this->report_id,
            'report_order' => $row[0],
            'report_code' => $this->report_code,
            'host_id' => $host?$host['id']:null,
            'host_uid' => $row[1],
            'agency_id' => $agency?$agency['id']:null,
            'agency_name' => $row[2],
            'platform_id' => $platform?$platform['id']:null,
            'platform_name' => $row[3],
            'total_salary' => $row[4],

        ]);
    }
}

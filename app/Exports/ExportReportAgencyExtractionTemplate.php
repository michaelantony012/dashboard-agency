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
        // return ReportAgencyExtraction::all();
        $collection = collect([
            (object) [ 'no', 'host_uid', 'total_salary' ],
            (object) [ '=IF(AND(C2>0,C2<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C3>0,C3<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C4>0,C4<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C5>0,C5<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C6>0,C6<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C7>0,C7<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C8>0,C8<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C9>0,C9<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C10>0,C10<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C11>0,C11<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C12>0,C12<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C13>0,C13<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C14>0,C14<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C15>0,C15<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C16>0,C16<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C17>0,C17<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C18>0,C18<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C19>0,C19<>""),ROW()-1,"")', '', '' ],
            (object) [ '=IF(AND(C20>0,C20<>""),ROW()-1,"")', '', '' ],
        ]);

        return $collection;
    }
}

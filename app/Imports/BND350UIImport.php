<?php

namespace App\Imports;

use App\Models\BND350UIModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class BND350UIImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
   /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        date_default_timezone_set("Asia/Jakarta");
        return new BND350UIModel([
            'oo_batch' => $row[0],
            'batch' => $row[1],
            'seqnum' => $row[2],
            'type' => $row[3],
            'txn_date' => $this->transformDate($row[4]),
            'auth' => $row[5],
            'cardnum' => $row[6],
            'amount' => $row[7],
            'rate' => $row[8],
            'disc_amount' => $row[9],
            'mid' => $row[10],
            'mname' => $row[11],
            'alamat' => $row[12],
            'account_number' => $row[13],
            'proc_date' => $this->transformDate($row[14]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

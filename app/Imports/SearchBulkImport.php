<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SearchBulkImport implements ToCollection, WithHeadingRow
{
    function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            DB::table('data_bulk_'.$this->user_id.'')->insert([
                'cardnum' => $row['card_number'],
                'txn_date' => $row['txn_date'],
                'proc_date' => $row['proc_date'],
                'amount' => $row['amount'],
                'disc_amount' => $row['disc_amount'],
                'auth' => $row['auth'],
                'rate' => $row['rate'],
                'mid' => $row['mid'],
                'account_number' => $row['account_number'],
                'mname' => $row['mname'],
                'alamat' => $row['alamat']
            ]);
        }
    }
}

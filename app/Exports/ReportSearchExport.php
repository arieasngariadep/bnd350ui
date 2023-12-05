<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\BND350UIModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ReportSearchExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder, WithColumnFormatting
{
    function __construct($txn_date, $proc_date, $mid, $cardnum, $auth, $amount)
    {
        $this->txn_date = $txn_date;
        $this->proc_date = $proc_date;
        $this->mid = $mid;
        $this->cardnum = $cardnum;
        $this->auth = $auth;
        $this->amount = $amount;
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@',
            'D' => '@',
            'E' => NumberFormat::FORMAT_DATE_YYYYMMDD2,
            'F' => '@',
            'G' => '@',
            'H' => '@',
            'J' => NumberFormat::FORMAT_DATE_YYYYMMDD2,
            'K' => '@',
            'L' => '@',
            'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'O' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = BND350UIModel::getReportSearch($this->txn_date, $this->proc_date, $this->mid, $this->cardnum, $this->auth, $this->amount);

        foreach ($data as $d) {
            $export[] = array( 
                'MID' => $d->mid,
                'MECHANT NAME' => $d->mname,
                'ALAMAT' => $d->alamat,
                'ACCOUNT NUMBER' => $d->account_number,
                'PROC DATE' => $d->proc_date,
                'OO BATCH' => $d->oo_batch,
                'BATCH' => $d->batch,
                'SEQ NUM' => $d->seqnum,
                'TYPE' => $d->type,
                'TXN DATE' => $d->txn_date,
                'ATUH' => $d->auth,
                'CARD NUM' => $d->cardnum,
                'AMOUNT' => $d->amount,
                'RATE' => $d->rate,
                'DISC. AMOUNT' => $d->disc_amount,
            );
        }
        return collect($export);
    }

    public function headings(): array
    {
        return [
            'MID',
            'MECHANT NAME',
            'ALAMAT',
            'ACCOUNT NUMBER',
            'PROC DATE',
            'OO BATCH',
            'BATCH',
            'SEQ NUM',
            'TYPE',
            'TXN DATE',
            'ATUH',
            'CARD NUM',
            'AMOUNT',
            'RATE',
            'DISC. AMOUNT',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A' || $cell->getColumn() == 'B' || $cell->getColumn() == 'C' || $cell->getColumn() == 'D' || $cell->getColumn() == 'F' || $cell->getColumn() == 'G' || $cell->getColumn() == 'H' || $cell->getColumn() == 'I' || $cell->getColumn() == 'K' || $cell->getColumn() == 'L') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}

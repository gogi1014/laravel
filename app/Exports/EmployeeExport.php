<?php

namespace App\Exports;

use App\Bulk;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'age',
            'address',
            'section',
            'salary'
        ];
    }
    public function query()
    {
         return Bulk::query()->whereRaw('search> 5');
    }
    public function map($bulk): array
    {
        return [
            $bulk->id,
            $bulk->name,
            $bulk->age,
            $bulk->address,
            $bulk->section,
            $bulk->salary
        ];
    }
}

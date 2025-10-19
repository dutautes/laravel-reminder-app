<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class UserExport implements FromCollection, WithMapping, WithHeadings
{
    private $key = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::orderBy('role', 'ASC')->get();
    }

    // th
    public function headings(): array
    {
        return ['No', 'Nama', 'Email', 'Role', 'Tanggal Registrasi'];
    }

    // td
    public function map($users): array
    {
        return [
            ++$this->key,
            $users->name,
            $users->email,
            $users->role,
            Carbon::parse($users->created_at)->format('d-m-y'),
        ];
    }
}

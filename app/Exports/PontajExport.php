<?php

namespace App\Exports;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Events\AfterSheet;

class PontajExport implements
    FromCollection,
    WithHeadings,
    WithTitle,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    public $week;
    public $year;

    public function __construct($week, $year)
    {
        $this->week = $week;
        $this->year = $year;
    }

    public function collection(): Collection
    {
        $activities = Activity::with('employee', 'activityDay')
            ->whereHas('activityDay', function ($q) {
                $q->where('week', $this->week)->whereYear('date', $this->year);
            })
            ->orderBy('date')
            ->get()
            ->map(function ($activity) {
                $date = Carbon::parse($activity->date);
                return [
                    'Data' => $date->format('Y-m-d'),
                    'Zi' => ucfirst($date->locale('ro')->isoFormat('dddd')),
                    'Angajat' => $activity->employee->first_name . ' ' . $activity->employee->last_name,
                    'Tip activitate' => ucfirst($activity->type),
                    'Suma' => $activity->price,
                    'Săptămână' => $activity->activityDay->week ?? '',
                ];
            });

        return collect($activities);
    }

    public function headings(): array
    {
        return ['Data', 'Zi', 'Angajat', 'Tip activitate', 'Suma', 'Săptămână'];
    }

    public function title(): string
    {
        return "Pontaj Săpt. {$this->week}";
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->setAutoFilter($sheet->calculateWorksheetDimension());

                $highestRow = $sheet->getHighestRow();
                $totalRow = $highestRow + 1;

                $sheet->getStyle('A2:A' . $highestRow)->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF3E5F5');

                $sheet->getStyle('A1:F1')->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE0E0E0');

                $sheet->setCellValue("D{$totalRow}", 'Total general:');

                $sheet->setCellValue("E{$totalRow}", "=SUM(E2:E{$highestRow})");

                $sheet->getStyle("D{$totalRow}:E{$totalRow}")->getFont()->setBold(true);
                $sheet->getStyle("D{$totalRow}:E{$totalRow}")->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFDCE775');
            }
        ];
    }
}

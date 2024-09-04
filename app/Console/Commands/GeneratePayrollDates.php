<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use League\Csv\Writer;
use SplTempFileObject;

class GeneratePayrollDates extends Command
{
    protected $signature = 'generate:payment-dates {year?}';
    protected $description = 'Generate salary and bonus payment dates for the remainder of the year';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $year = $this->argument('year') ?? Carbon::now()->year;
        //$year = Carbon::now()->year;
        $months = range(1, 12);
        $data = [];

        foreach ($months as $month) {
            $baseSalaryDate = $this->getBaseSalaryDate($year, $month);
            $bonusDate = $this->getBonusDate($year, $month);
            $data[] = [$this->getMonthName($month), $baseSalaryDate, $bonusDate];
        }

        $filePath = storage_path('app/payment_dates_'.$year.'.csv');
        $this->generateCsv($data, $filePath);
        $this->info('Payment dates CSV generated successfully at ' . $filePath);
    }

    private function getBaseSalaryDate($year, $month)
    {
        $lastDay = Carbon::create($year, $month)->endOfMonth();
        if ($lastDay->isWeekend()) {
            return $lastDay->previous(Carbon::FRIDAY)->toDateString();
        }
        return $lastDay->toDateString();
    }

    private function getBonusDate($year, $month)
    {
        $bonusDate = Carbon::create($year, $month, 15);
        if ($bonusDate->isWeekend()) {
            return $bonusDate->next(Carbon::WEDNESDAY)->toDateString();
        }
        return $bonusDate->toDateString();
    }

    private function getMonthName($month)
    {
        return Carbon::create()->month($month)->format('F');
    }

    private function generateCsv($data, $filePath)
    {
        $csv = Writer::createFromPath($filePath, 'w+');
        $csv->insertOne(['Month', 'Salary Payment Date', 'Bonus Payment Date']);
        $csv->insertAll($data);
    }
}

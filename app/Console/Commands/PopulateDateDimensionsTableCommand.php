<?php

namespace App\Console\Commands;

use App\Models\DateDimension;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use function ceil;
use function now;

class PopulateDateDimensionsTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:PopulateDateDimensionsTableCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate data for date dimensions table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(now()->toDateTimeString() . " Start: app:PopulateDateDimensionsTableCommand");

        // Truncate all records
        DateDimension::truncate();

        // Create an empty array and save the transformed input to array
        $dataToInsert = [];

        // Get the date range
        // @NOTE - update the start and end date as per your choice
        $dates = CarbonPeriod::create('2015-01-01', '2030-12-31');

        // For each dates create a transformed data
        foreach ($dates as $date) {

            // Get the quarter details, as ABC has a different quarter system
            // @note - Carbon does not allow to override the quarters
            $quarterDetails = $this->getQuarterDetails($date);

            // Main transformer
            $dataToInsert[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->day,
                'month' => $date->month,
                'year' => $date->year,
                'day_name' => $date->dayName,
                'day_suffix' => $this->getDaySuffix($date->day),
                'day_of_week' => $date->dayOfWeek,
                'day_of_year' => $date->dayOfYear,
                'is_weekend' => (int) $date->isWeekend(),
                'week' => $date->week,
                'iso_week' => $date->isoWeek,
                'week_of_month' => $date->weekOfMonth,
                'week_of_year' => $date->weekOfYear,
                'iso_week_in_year' => $date->isoWeeksInYear,
                'month_name' => $date->monthName,
                'month_year' => $date->format('mY'),
                'month_name_year' => $date->format('MY'),
                'first_day_of_month' => $date->clone()->firstOfMonth()->format('Y-m-d'),
                'last_day_of_month' => $date->clone()->lastOfMonth()->format('Y-m-d'),
                'first_day_of_next_month' => $date->clone()->addMonthNoOverflow()->firstOfMonth()->format('Y-m-d'),
                'quarter' => $quarterDetails['value'],
                'quarter_name' => $quarterDetails['name'],
                'first_day_of_quarter' => $quarterDetails['first_day_of_quarter'],
                'last_day_of_quarter' => $quarterDetails['last_day_of_quarter'],
                'first_day_of_year' => $date->clone()->firstOfYear()->format('Y-m-d'),
                'last_day_of_year' => $date->clone()->lastOfYear()->format('Y-m-d'),
                'first_day_of_next_year' => $date->clone()->addYear()->firstOfYear()->format('Y-m-d'),
                'dow_in_month' => (int)ceil($date->day/7),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Create chunks for faster insertion
        // @note - SQL Server supports a maximum of 2100 parameters.
        $chunks = collect($dataToInsert)->chunk(50);

        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            DateDimension::insert($chunk->toArray());
        }

        $this->info(now()->toDateTimeString() . " Complete: app:PopulateDateDimensionsTableCommand");
    }

    /**
     * Get Quarter details
     * @OTE - Depending on your companies quarter update the map and logic below
     *
     * @param Carbon $date
     * @return array
     */
    private function getQuarterDetails(Carbon $date)
    {
        $quarterMonthMap = [
            1 => ['value' => 1, 'name' => 'First'],
            2 => ['value' => 2, 'name' => 'Second'],
            3 => ['value' => 2, 'name' => 'Second'],
            4 => ['value' => 2, 'name' => 'Second'],
            5 => ['value' => 3, 'name' => 'Third'],
            6 => ['value' => 3, 'name' => 'Third'],
            7 => ['value' => 3, 'name' => 'Third'],
            8 => ['value' => 4, 'name' => 'Fourth'],
            9 => ['value' => 4, 'name' => 'Fourth'],
            10 => ['value' => 4, 'name' => 'Fourth'],
            11 => ['value' => 1, 'name' => 'First'],
            12 => ['value' => 1, 'name' => 'First'],
        ];

        $output['value'] = $quarterMonthMap[$date->month]['value'];
        $output['name'] = $quarterMonthMap[$date->month]['name'];

        switch ($output['value']) {
            case 1:
                $output['first_day_of_quarter'] = Carbon::parse($date->year - 1 . '-11-01')->firstOfMonth()->format('Y-m-d');
                $output['last_day_of_quarter'] = Carbon::parse($date->year . '-01-01')->lastOfMonth()->format('Y-m-d');

                break;
            case 2:
                $output['first_day_of_quarter'] = Carbon::parse($date->year . '-02-01')->firstOfMonth()->format('Y-m-d');
                $output['last_day_of_quarter'] = Carbon::parse($date->year . '-04-01')->lastOfMonth()->format('Y-m-d');

                break;
            case 3:
                $output['first_day_of_quarter'] = Carbon::parse($date->year . '-05-01')->firstOfMonth()->format('Y-m-d');
                $output['last_day_of_quarter'] = Carbon::parse($date->year . '-07-01')->lastOfMonth()->format('Y-m-d');

                break;
            case 4:
                $output['first_day_of_quarter'] = Carbon::parse($date->year . '-08-01')->firstOfMonth()->format('Y-m-d');
                $output['last_day_of_quarter'] = Carbon::parse($date->year . '-10-01')->lastOfMonth()->format('Y-m-d');

                break;
        }

        return $output;
    }

    /**
     * Get the Day Suffix
     * Copied logic from - https://www.mssqltips.com/sqlservertip/4054/creating-a-date-dimension-or-calendar-table-in-sql-server/
     *
     * @param $day
     * @return string
     */
    private function getDaySuffix($day)
    {
        if ($day/10 == 1) {
            return "th";
        }
        $right = substr($day, -1);

        if ($right == 1) {
            return 'st';
        }

        if ($right == 2) {
            return 'nd';
        }

        if ($right == 3) {
            return 'rd';
        }

        return 'th';
    }
}
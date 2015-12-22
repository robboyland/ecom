<?php

use Illuminate\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = date("Y-m-d", strtotime('-2 months'));
        $endDate = date('Y-m-d', strtotime('+10 years'));

        $begin = new DateTime( $startDate );
        $end = new DateTime( $endDate );
        $interval = new DateInterval('P1D');

        $daterange = new DatePeriod($begin, $interval, $end);

        $days = [];

        foreach($daterange as $date) {
            $days[] = ['datefield' => $date->format("Y-m-d 00:00:00")];
        }

        DB::table('calendar')->insert($days);

    }
}

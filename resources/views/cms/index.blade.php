@extends('layouts.cms')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Daily sales</div>

    <table class="table">
    <thead>
        <tr>
            <th>day</th>
            <th>date</th>
            <th>total (£)</th>
        </tr>
    </thead>

    @foreach($daily_sales as $day)
        <?php
            $date = date_create($day->day);
            $dayOfWeek = date_format($date, 'D');

            if ($dayOfWeek == 'Sat' || $dayOfWeek == 'Sun') {
                echo '<tr class="active">';
            } else {
                echo '<tr>';
            }
        ?>
            <td>{{ date_format($date, 'D') }}</td>
            <td>{{ date_format($date, 'jS M Y') }}</td>
            <td>{{ $day->total }}</td>
        </tr>
    @endforeach
  </table>
</div>

@stop

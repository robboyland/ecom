<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $daily_sales = DB::select(' SELECT date(datefield) AS day, IFNULL(round(sum(price/100),2), 0) AS total
                                    FROM calendar
                                    LEFT JOIN order_items ON
                                        date(calendar.datefield) = date(order_items.created_at)
                                    WHERE datefield BETWEEN NOW() - INTERVAL 1 MONTH AND NOW()
                                    GROUP BY datefield
                                    ORDER BY datefield DESC');

        return view('cms.index', compact('daily_sales'));
    }
}

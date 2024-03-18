<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookChartController extends Controller
{
    // retrieve data from model
    public function bookChart()
    {
        $users = Book::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('year', 'month')
                    ->orderBy('year')
                    ->orderBy('month') 
                    ->get();

        $labels = [];
        $data = [];
        $colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#ff9900', '#9900ff', '#0099ff', '#ffcc00'];

        foreach ($users as $user) {
            $monthYear = date('F Y', mktime(0, 0, 0, $user->month, 1, $user->year));
            $count = $user->count;

            array_push($labels, $monthYear);
            array_push($data, $count);
        }

        $datasets = [
            [
                'label' => 'Users',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('BookChart', compact('datasets', 'labels'));
    }
}

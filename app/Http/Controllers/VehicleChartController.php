<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade

class VehicleChartController extends Controller
{
    // retrieve data from model
    public function vehicleChart()
    {
        $vehicleModels = Book::select('veModel', DB::raw('COUNT(*) as count'))
                    ->groupBy('veModel')
                    ->orderBy('count', 'DESC') // Optional: order by count in descending order
                    ->get();

        $labels = [];
        $data = [];
        $colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#ff9900', '#9900ff', '#0099ff', '#ffcc00'];

        foreach ($vehicleModels as $vehicleModel) {
            $modelName = $vehicleModel->veModel;
            $count = $vehicleModel->count;

            array_push($labels, $modelName);
            array_push($data, $count);
        }

        $datasets = [
            [
                'label' => 'Vehicle Models',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('VehicleChart', compact('datasets', 'labels'));
    }
}
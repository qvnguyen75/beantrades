<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Spatie\FlareClient\Time\Time;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use App\Http\Api\KucoinApi;

class HomeController extends Controller
{
    private KucoinApi $api;

    public function __construct ()
    {
        $this->api =  new KucoinApi(env('KUCOIN_API_KEY'),  env('KUCOIN_SECRET'), env('KUCOIN_PASSPHRASE'));
    }

    public function index() {
        return Inertia::render('Index', [
            'trades' => $this->api->getOrders(),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function search (Request $request)
    {
        if ($request->clear) {
            $trades = $this->api->getOrders();
            $data = [
                'trades' => $trades
            ];
    
            return view('index')->with($data);
        }

        $trades = $this->api->getOrdersBySymbol($request->symbol);
 
        $data = [
            'trades' => $trades
        ];

        return view('index')->with($data);
    }

    public function read(string $orderId)
    {
        $orderDetails = $this->api->getOrderDetails($orderId);
     
        $data = [
            'orderDetails' => $orderDetails
        ];

        return view('order')->with($data);
    }

    public function getFillById(string $orderId) {
        $filledItems = $this->api->getFillById($orderId);

        $data = [
            'orderDetails' => $filledItems
        ];

        return view('order')->with($data);
    }
}

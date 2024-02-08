<?php

namespace App\Http\Api;
use Illuminate\Support\Facades\Http;
use DateTime;
use DateTimeImmutable;

class KucoinApi extends Api {
    private string $key;
    private string $secret;
    private string $passphrase;

    public function __construct($key, $secret, $passphrase) {
      $this->key = $key;
      $this->secret = $secret;
      $this->passphrase = $passphrase;
    }

    protected function signature($request_path = '', $body = '', $timestamp = false, $method = 'GET') {

      $body = is_array($body) ? json_encode($body) : $body; // Body must be in json format

      $timestamp = $timestamp ? $timestamp : time() * 1000;

      $what = $timestamp . $method . $request_path . $body;

      return base64_encode(hash_hmac("sha256", $what, $this->secret, true));
    }

    protected function getKey(){
        return $this->key;
    }

    protected function getPassphrase()
    {
        return base64_encode(hash_hmac('sha256', $this->passphrase, $this->secret, true));
    }

    protected function getTimestampInMilliseconds()
    {
      return round(microtime(true) * 1000);
    }

    public function getOrders()
    {
      $response = $this->call('/api/v1/orders', 'GET');
      $responseData = json_decode($response->body());
      $trades = $responseData->data->items;
      $orders = $this->formatOrders($trades);

      return $orders;
    }

    public function getOrdersBySymbol (string $symbol)
    {
      $response = $this->call('/api/v1/orders?symbol=' . $symbol, 'GET');
      $responseData = json_decode($response->body());
      $trades = $responseData->data->items;
      $orders = $this->formatOrders($trades);

      return $orders;
    }
    
    private function formatOrders (array $orders)
    {
      foreach ($orders as $order) {
        $order->tradingPair = substr($order->symbol, 0, 3) . ' / ' . substr($order->symbol, 3);
        $order->dateBuy = date('d-m-y H:i:s', ($order->createdAt / 1000));
        $order->cancelled = ! is_null($order->remark) ? 'Cancelled' : null; 
      };

      return $orders;
    }

    public function getOrderDetails (string $orderId)
    {
      $response     = $this->call('/api/v1/orders/' . $orderId, 'GET');
      $responseData = json_decode($response->body());
      $orderDetails = $responseData->data;

      return $orderDetails;
     
    }

    private function getStartPoint ()
    {
      $date = date('01-01-2023');
      return strtotime($date) * 1000;
    }

    public function getFillById(string $orderId) {
      // $date = new DateTimeImmutable('2024-01-20');
      // $dateMiliseconds = strtotime($date) * 1000;

      $response     = $this->call('/api/v1/fills?orderId=' . $orderId, 'GET');
      $responseData = json_decode($response->body());
      dd($responseData);
      $orderDetails = $responseData->data;
    }
}

?>
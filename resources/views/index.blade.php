<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Laravel</title>

    </head>
    <body >
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
        <div class="container">
            <section>
                <div class="container">
                    <div class="d-inline-block">
                        <form method="POST" action="/search">
                        @csrf                            
                        <input type="text" class="mb-2 " name="symbol" placeholder="Search pair">
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                        <button class="btn btn-danger mb-2" name="clear" type="submit" value="clear">Clear filter</button>                       
                        </form>
                    </div>
                </div>
            </section>
            <section>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Pair</th>
                                <th>Type</th>
                                <th>Side</th>
                                <th>Value</th>
                                <th>Created at</th>
                                <th>status</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr onclick="window.location='{{ url('order', ['orderId' => $order->id]) }}'">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->tradingPair }}</td>
                                <td>{{ $order->type }}</td>
                                <td>{{ $order->side }}</td>
                                <td>{{ $order->value }}</td>
                                <td>{{ $order->dateBuy }}</td>
                                <td>{{ $order->cancelled }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    <table>
                </div>
            </section>
        </div>
        
    </body>
</html>

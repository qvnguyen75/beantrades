<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Laravel</title>

    </head>
    <body >
        <div class="container">
            <section>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pair</th>
                            <th>Type</th>
                            <th>Side</th>
                            <th>Size</th>
                            <th>Value</th>
                            <th>Date</th>
                            <th>Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $orderDetails->symbol }}</td>
                            <td>{{ $orderDetails->type }}</td>
                            <td>{{ $orderDetails->side }}</td>
                            <td>{{ $orderDetails->size }}</td>
                            <td>{{ $orderDetails->value }}</td>
                            <td>{{ $orderDetails->createdAt }}</td>
                            <td>{{ $orderDetails->fee }}</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </body>
</html>

@php
    $ticket = json_decode($data);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            height: 842px;
            width: 595px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }

        .pynm {
            background-color: yellowgreen;
            width: fit-content;
        }

        .payrept {
            font-size: 2em;
            font-weight: 600;
        }

        .tablehead {
            font-weight: 600;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        thead {
            background-color: bisque;
            color: #ac2c2c;
        }

        * {
            margin: 0px;
            padding: 0px;
            font-family: 'Inter', sans-serif;
        }

        .graphic-container {
            padding: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .color {
            background-color: rgb(2, 73, 50);
            min-width: 60px;
            height: 35px;
            margin: 10px;
            border-radius: 15px 0px 15px 0px;
        }

        .colorg1 {
            background-color: rgb(2, 73, 50);
            min-width: 200px;
            height: 35px;
            margin: 10px;
            border-radius: 15px 0px 15px 0px;
        }


        body {
            margin-top: 20px;
        }

        .spacer {
            height: 50px;
        }

        .hallTitle {
            padding: 10px;
            text-align: center;

        }

        .customerInfo,
        .ticket-info {
            padding: 10px;
            margin-left: 20px;
        }

        .stablished {
            text-align: center;
        }

        td {
            padding: 10px;
            min-width: 250px;
            background-color: #f2f2f2;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div id="a4">
        <div class="spacer"></div>

        <div class="header">
            <h1 class="hallTitle"> Book My Show </h1>
            <h3 class="stablished"> Stablished in 2022 </h3>
            <hr>
        </div>

        <div class="spacer"></div>

        <div class="graphic-container">
            <div class="colorg1">
            </div>
            <div class="payrept">
                Payment Recipt
            </div>
            <div class="color">
            </div>
        </div>


        <div class="spacer"></div>

        <div class="customerInfo">
            <table>
                <div class="tablehead">Customer Information</div>
                <tbody>
                    <tr>
                        <td>Customer Name </td>
                        <td>{{ $ticket->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Customer Email </td>
                        <td>{{ $ticket->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method </td>
                        <td class="pynm">Card </td>
                    </tr>




                </tbody>
            </table>
        </div>

        <div class="spacer"></div>

        <div class="ticket-info">
            <div class="tablehead">Ticket Information</div>
            <table>
                <tbody>
                    <tr>
                        <td>Ticket Id </td>
                        <td>#{{ $ticket->id }} </td>
                    </tr>
                    <tr>
                        <td>Show Name </td>
                        <td> {{ $ticket->show->title }} </td>
                    </tr>
                    <tr>
                        <td>Movie Name </td>
                        <td>{{ $ticket->show->movie->title }} </td>
                    </tr>
                    <tr>
                        <td>Show Time </td>
                        <td>{{ date('d M, Y h:i A', strtotime($ticket->show->date)) . ' (GMT)' }} </td>
                    </tr>
                    <tr>
                        <td>Payment status </td>
                        <td> {{ $ticket->payment_status }} </td>
                    </tr>
                    <tr>
                        <td>Seat Number </td>
                        <td>{{ json_encode($ticket->seat_number) }}</td>
                    </tr>
                    <tr>
                        <td>Ticket Price</td>
                        <td>${{ $ticket->paid_amount }}</td>
                    </tr>
                    <tr>
                        <td>Purchase Time</td>
                        <td>{{ date('d M, Y h:i A', strtotime($ticket->payment_time)) . ' (GMT)' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="spacer"></div>

        </div>


    </div>

</body>

</html>

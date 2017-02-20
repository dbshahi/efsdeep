@extends('app')
@section('content')
    <h1>Customer </h1>

    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr class="bg-info">
            <tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Cust Number</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>


            </tbody>
        </table>
    </div>
    <?php
    $sum_stock = 0;
    ?>
    <div class="container">
        <br>
        <h2><?php echo ($customer['name']); ?> Stocks </h2>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Trading Symbol</th>
                <th>Stock Name</th>
                <th>No. of Shares</th>
                <th>Purchase Price ($)</th>
                <th>Purchase Date</th>
                <th>Stock Total Value ($)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customer->stocks as $stock)
                <tr>
                    <td>{{ $stock->symbol }}</td>
                    <td>{{ $stock->name }}</td>
                    <td>{{ $stock->shares }}</td>
                    <td>{{ $stock->purchase_price }}</td>
                    <td>{{ $stock->purchased }}</td>
                    <td> <?php echo '$'. $stock['shares']*$stock['purchase_price'];
                        $sum_stock = $sum_stock + $stock['shares'] * $stock['purchase_price']?>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h5>
            <?php echo 'Sum Of Stock Portfolio : $' , number_format($sum_stock,2) ; ?>
        </h5>
    </div>

    <?php
    $suminvest_init = 0;
    $suminvest_curr=0;
    ?>
    <br>
    <div class="container">
        <h2> <?php echo ($customer['name']); ?> Investments </h2>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Category </th>
                <th>Description</th>
                <th>Acquired Value ($)</th>
                <th>Acquired Date</th>
                <th>Recent Value ($)</th>
                <th>Recent Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customer->investments as $investment)
                <tr>
                    <td>{{ $investment->category }}</td>
                    <td>{{ $investment->description }}</td>
                    <td>{{ $investment->acquired_value }}
                        <?php $suminvest_init = $suminvest_init + $investment['acquired_value'] ?>
                    </td>
                    <td>{{ $investment->acquired_date }}</td>
                    <td>{{ $investment->recent_value }}
                        <?php
                        $suminvest_curr = $suminvest_curr + $investment['recent_value']
                        ?>
                    </td>

                    <td>{{ $investment->recent_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h5>
            <?php echo 'Sum Of Initial Investment Portfolio : $' ,number_format( $suminvest_init,2); ?>
            <br>
            <br>
            <?php echo 'Sum Of Current Investment Portfolio : $' ,number_format( $suminvest_curr,2); ?>
        </h5>
    </div>
    <?php
    $port_init=0;
    $port_curr=0;

    ?>
    <br>
    <br>
    <div class="table table-striped table-bordered table-hover">
        <h3> <?php echo ($customer['name']); ?> Portfolio Summary</h3>
        <br>

        <?php $port_init = $suminvest_init+$sum_stock;
        $port_curr = $suminvest_curr+$sum_stock;
        ?>


        <?php echo 'Sum Of Initial Portfolio : $' , number_format($port_init,2); ?>

        <br>
        <br>

        <?php echo 'Sum Of Current Portfolio : $' , number_format($port_curr,2); ?>

    </div>



@endsection

@section('footer')
    <style>
        .table td { border: 0px !important; }
        .tooltip-inner { white-space:pre-wrap; max-width: 400px; }
    </style>

    <script>
        $(document).ready(function() {
            $('table.cds-datatable').on( 'draw.dt', function () {
                $('tr').tooltip({html: true, placement: 'auto' });
            } );
            $('tr').tooltip({html: true, placement: 'auto' });
        } );
    </script>

@stop



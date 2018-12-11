@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;



        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <style>
        td{
            color: #000;
            font-weight: 400;
        }
    </style>
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    @php
                    $id = $dataTypeContent->getKey();
                    @endphp
                    @php
                        $order = App\Order::where('id', $id)->with(['orderDetails', 'customer', 'modifier'])->first();
                    @endphp
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Order Id</td>
                                <td>{{ $order->id }}</td>
                            </tr>

                            <tr>
                                <td>Customer name</td>
                                <td>{{ $order->customer->name }}</td>
                            </tr>


                            <tr>
                                <td>Customer Phone no</td>
                                <td>{{ $order->customer->phone }}</td>
                            </tr>

                            <tr>
                                <td>Customer Email</td>
                                <td>{{ $order->customer->email }}</td>
                            </tr>

                            <tr>
                                <td>Price</td>
                                <td>{{ setting('site.currency') }} {{ $order->total }}</td>
                            </tr>

                            <tr>
                                <td>Payment Method</td>
                                <td>{{ strtoupper($order->payment_type) }}</td>
                            </tr>

                            <tr>
                                <td>Order Status</td>
                                <td>{{ ucfirst($order->order_status) }}</td>
                            </tr>
                            @if($order->send_to_modifier == 1)
                            <tr>
                                <td>Modifier shop name</td>
                                <td>{{ $order->modifier->shop_name }}</td>
                            </tr>

                            <tr>
                                <td>Modifier Address</td>
                                <td>{{ $order->modifier->address }}</td>
                            </tr>
                                <tr>
                                    <td>Measurement</td>
                                    <td>{{ $order->measurement }}</td>
                                </tr>
                            @endif


                            <tr>
                                <td>Shipping Address</td>
                                <td>{{ $order->shipping_address }}</td>
                            </tr>

                            <tr>
                                <td>Order Date</td>
                                <td>{{ date('M d, Y', strtotime($order->created_at)) }}</td>
                            </tr>
                        </table>
                        <div class="col-md-12 text-center">
                            <h3>Order Details Information</h3>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Name</td>
                                <td>SKU</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Size</td>
                                <td>Color</td>
                                <td>Total</td>
                            </tr>
                            @foreach($order->orderDetails as $details)
                            <tr>
                                <td>{{ $details->product_name }}</td>
                                <td>{{ App\lib\LiberyFunction::findProduct($details->product_id) }}</td>
                                <td>{{ setting('site.currency') }} {{ $details->price }}</td>
                                <td>{{ $details->quantity }}</td>
                                <td>{{ App\lib\LiberyFunction::findSize($details->size_id) }}</td>
                                <td>{{ App\lib\LiberyFunction::findColor($details->color_id) }}</td>
                                <td>{{ setting('site.currency') }} {{ $details->price*$details->quantity }}</td>
                            </tr>
                                @endforeach
                            <tr>
                                <td colspan="6">Total</td>
                                <td>{{ setting('site.currency') }} {{ $order->total }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
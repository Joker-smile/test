@extends('layouts.app')
@section('title', '新增收货地址')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">
                        新增收货地址
                    </h2>
                </div>
                <div class="panel-body">
                    <form action="https://secure.oceanpayment.com/gateway/service/test" method="post" >
                        <input type="hidden" name="account" value="{{$data['account']}}" />
                        <input type="hidden" name="terminal" value="{{$data['terminal']}}" />
                        <input type="hidden" name="order_number" value="{{$data['order_number']}}" />
                        <input type="hidden" name="order_currency" value="{{$data['order_currency']}}" />
                        <input type="hidden" name="order_amount" value="{{$data['order_amount']}}" />
                        <input type="hidden" name="signValue" value="{{$data['signValue']}}" />
                        <input type="hidden" name="backUrl" value="{{$data['backUrl']}}" />
                        <input type="hidden" name="noticeUrl" value="{{$data['noticeUrl']}}" />
                        <input type="hidden" name="billing_firstName" value="{{$data['billing_firstName']}}" />
                        <input type="hidden" name="billing_lastName" value="{{$data['billing_lastName']}}" />
                        <input type="hidden" name="billing_email" value="{{$data['billing_email']}}" />
                        <input type="hidden" name="billing_phone" value="{{$data['billing_phone']}}" />
                        <input type="hidden" name="methods" value="{{$data['methods']}}" />
                        <input type="hidden" name="billing_country" value="{{$data['billing_country']}}" />
                        <input type="hidden" name="billing_city" value="{{$data['billing_city']}}" />
                        <input type="hidden" name="billing_address" value="{{$data['billing_address']}}" />
                        <input type="hidden" name="billing_zip" value="{{$data['billing_zip']}}" />
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
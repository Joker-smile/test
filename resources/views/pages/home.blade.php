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
                        @foreach($data as $k => $v)
                        <input type="hidden" name="{{$k}}" value="{{$v}}" />
                        @endforeach
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                提交
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
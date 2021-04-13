@extends('admin.main')
@php

    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkeditor  = config('zvn.template.form_ckeditor');


@endphp

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Chi tiết đơn hàng'])
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">

                                <th class="column-title">Name </th>
                                <th class="column-title">Thumb </th>
                                <th class="column-title">price </th>
                                <th class="column-title">quantity </th>

                                <th class="column-title">Total </th>


                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total=0;
                            @endphp
                            @foreach($item->products as $k=>$val)
                                @php
                                $class=$k%2==0?"even":"odd";
                                $quantity=$val->pivot->qty;
                                $price=$val->pivot->price;
                                $subTotal=$quantity*$price;
                                $total+=$subTotal;

                                @endphp
                            <tr class="{{$class}} pointer">

                                <td class=" ">{{$val->name}}</td>
                                <td class=" "><img width="70" src="{{asset($val->thumb)}}" alt=""> </td>
                                <td class=" ">{{Template::format_price($price)}}</td>
                                <td>{{$quantity}}</td>
                                <td>{{Template::format_price($subTotal)}}</td>
                            </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <p style="margin-top: 10px">Phương thức thanh toán: {{$item->payment->type}}</p>
                        <p style="margin-left: 800px;">Tổng số tiền: {{Template::format_price($total)}}</p>
                        @include('admin.templates.x_title', ['title' => 'Thông tin khách hàng'])


                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">

                                <th class="column-title">Name </th>
                                <th class="column-title">Phone </th>
                                <th class="column-title">Email </th>
                                <th class="column-title">Address </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="even pointer">
                                    <td>{{$item->customer->name}}</td>
                                    <td>{{$item->customer->phone}}</td>
                                    <td>{{$item->customer->email}}</td>
                                    <td>{{$item->customer->address}}</td>
                                </tr>


                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

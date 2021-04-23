<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">{{ucfirst($controllerName)}} Code</th>
                    <th class="column-title">Phương thức thanh toán</th>
                    <th class="column-title">Tên khách hàng</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @php
                    @endphp
                    @foreach ($items as $key => $val)
                        @php

                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $code            = Hightlight::show($val['order_code'], $params['search'], 'type');
                            $customer_name=$val['customer']?$val['customer']->name:$val['name'];
                            $customer        = Hightlight::show($customer_name, $params['search'], 'customer');
                            $payment         = Hightlight::show($val['payment']->type, $params['search'], 'payment');
                            $status          = Template::showItemSelect($controllerName, $val['id'], $val['status'], 'order');
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="20%">
                                 {!! $code !!}
                                
                            </td>
                            <td>{{$payment}}</td>

                            <td>{{$customer}}</td>

                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>

                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           
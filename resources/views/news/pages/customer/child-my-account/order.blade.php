@php
    use Illuminate\Support\Facades\Config;
@endphp
<div class="tab-pane fade  show active" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Orders</h3>

        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Trạng thái</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $stt=0;
                @endphp
                @forelse($item->order as $value)
                    @php
                        $stt++;
                        $name=$value->name;
                        $date=Template::showDatetimeFrontend($value->created);
                        $config=Config::get('zvn.template.status');
                        $status=$config[$value->status]['name'];
                        $amount=Template::format_price($value->amount);
                    @endphp
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$name}}</td>
                    <td>{{$date}}</td>
                    <td>{{$status}}</td>
                    <td>{{$amount}}</td>
                    <td><a href="cart.html" class="btn btn-dark btn-round">View</a></td>
                </tr>
                @empty
                <p>Bạn chưa có đơn đặt hàng nào tại website này</p>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
    @if(Request::input('page')=='order')
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">Mã Sản Phẩm </th>
                <th class="column-title">Tên Sản Phẩm </th>
                <th class="column-title">Thuộc tính </th>
                <th class="column-title">Hình Ảnh </th>
                <th class="column-title">Giá </th>
                <th class="column-title">Số Lượng </th>
                <th class="column-title">Tổng </th>
            </tr>
            </thead>

            <tbody>
            @foreach($item->order[0]->products as $key => $val)
                @php
                    $class        = $key %2 == 0 ? "even" : "odd";

                    $product_code = $val->product_code;
                    $name         = $val->name;
                    $attribute    = $val->detail;
                    $thumb        = $val->thumb;
                    $thumb        = $val->thumb;
                    $quantity     = $val->quantity;
                    $price        = Template::format_price($val->price);
                    $total        = Template::format_price($val->price);
                @endphp

                <tr class="{{$class}} pointer">

                    <td width="8%">{{$product_code}}</td>
                    <td width="20%">{{$name}}</td>
                    <td width="20%">{{$attribute}}</td>
                    <td><img width="200px" src="{{asset($thumb)}}" alt=""> </td>
                    <td width="10%">{!! $price !!}</td>
                    <td width="8%">{{ $quantity }}</td>
                    <td width="10%">{!! $total !!}</td>
                </tr>

            @endforeach

            </tbody>
        </table>

    @endif
</div>

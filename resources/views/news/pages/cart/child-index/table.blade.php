@php
    use App\Helpers\Template;

@endphp
<table>
    <thead>
    <tr>
        <th class="pro-thumbnail">Image</th>
        <th class="pro-title">Product</th>
        <th class="pro-price">Price</th>
        <th class="pro-quantity">Quantity</th>
        <th class="pro-subtotal">Total</th>
        <th class="pro-remove">Remove</th>
    </tr>
    </thead>
    <tbody>
    @php
        $result=0;
    @endphp
    @foreach($cart as $item)
        @php
            $name=$item->name;
            $rowId=$item->rowId;
            $qty=$item->qty;
            $price=Template::format_price($item->price);
            $subTotal=($item->price)*$qty;
            $result+=$subTotal;

            $thumb=$item->options->thumb;
            $color=$item->options->color;
            $link=$item->options->link;


        @endphp
        <tr>
            <td class="pro-thumbnail"><a href="{{$link}}"><img src="{{asset($thumb)}}" alt="" /></a></td>
            <td class="pro-title"><a href="{{$link}}">{{$name}} ({{$color}})</a></td>
            <td class="pro-price"><span class="amount">{!! $price !!}</span></td>
            <td class="pro-quantity"><div class="pro-qty"><input  min="1" type="text" value="{{$qty}}" class="qty"></div></td>

            <td class="pro-subtotal subtotal">{!! Template::format_price($subTotal) !!}</td>
            <input type="hidden" value="{{route('cart/remove-cart')}}" class="url">
            <input type="hidden" value="{{route('cart/update-cart')}}" class="url-update">

            <td class="pro-remove"><a href="#">×</a></td>
            <input type="hidden" class="rowId" value="{{$rowId}}">
            <input type="hidden" class="price" value="{{$item->price}}">
        </tr>
    @endforeach
    </tbody>
</table>
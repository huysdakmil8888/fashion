<div class="col-12 mb-40">

    <h4 class="checkout-title">Phương thức thanh toán</h4>

    <div class="checkout-payment-method">
        @foreach($payment as $item)
            @php
                $id=$item->id;
            @endphp
            <div class="single-method">
                <input type="radio" id="payment_bank{{$id}}" name="payment_id" value="{{$id}}">
                <label for="payment_bank{{$id}}">{{$item->type}}</label>
                <p data-method="bank">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
            </div>
        @endforeach
    </div>
    <div class="single-method" style="margin-top: 40px">
        <input type="checkbox" id="accept_terms" name="accept">
        <label for="accept_terms">Tôi đã đọc và đồng ý với tất cả điều khoản trên</label>
        <span class="color-red">{{$errors->first('accept')}}</span>

    </div>
    <button class="place-order">Đặt hàng</button>
    </form>

</div>

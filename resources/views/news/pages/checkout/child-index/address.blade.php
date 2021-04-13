@php
    $name=old('name');
    $email=old('email');
    $phone=old('phone');
    $note=old('note');
    $password=old('password');
    $address=old('address');

@endphp
<div id="billing-form" class="mb-20">
    <h4 class="checkout-title">Thông tin liên lạc</h4>

    @include('news.templates.notify')
    @include('news.templates.alert')
    <div class="row">


        <div class="col-md-6 col-12 mb-5">
            <label>Name*</label>
            <input type="text" placeholder="Name" name="name" value="{{$name}}">
            <span class="color-red">{{$errors->first('name')}}</span>
        </div>

        <div class="col-md-6 col-12 mb-5">
            <label>Email</label>
            <input type="email" placeholder="Email" name="email" value="{{$email}}">
            <span class="color-red">{{$errors->first('email')}}</span>

        </div>

        <div class="col-md-6 col-12 mb-5">
            <label>Phone</label>
            <input type="text" placeholder="Phone" name="phone" value="{{$phone}}">
            <span class="color-red">{{$errors->first('phone')}}</span>

        </div>
        <div class="col-md-6 col-12 mb-5">
            <label>Address</label>
            <input type="text" placeholder="Address" name="address" value="{{$address}}">
            <span class="color-red">{{$errors->first('address')}}</span>

        </div>
        <div class="col-md-12 col-12 mb-5">
            <label>Ghi chú</label>
            <input type="text" placeholder="write some note..." name="note" value="{{$note}}">

            <span class="color-red">{{$errors->first('note')}}</span>
        </div>


        <div class="col-md-12 col-12 mb-5">
            <label>Phương thức vận chuyển </label>
            <input type="hidden" id="url" value="{{route('checkout/shipping')}}">
            <select class="nice-select" name="shipping_id">
                <option value="">Vui lòng lựa chọn</option>
                @foreach($shipping as $k=>$v)
                <option value="{{$k}}">{{$v}}</option>
                @endforeach
            </select>
            <span class="color-red">{{$errors->first('shipping_id')}}</span>

        </div>

        <div class="col-12 mb-5 mt-5">
            <div class="check-box mb-15">
                <input type="checkbox" id="shiping_address" data-shipping name="create_account">
                <label for="shiping_address">Create an Acount?</label>
            </div>
        </div>

        {{--vi du--}}
        <div id="shipping-form" class="mb-20">
            <h4 class="checkout-title">Shipping Address</h4>

            <div class="row">

                <div class="col-md-6 col-12 mb-5">
                    <label>Password</label>
                    <input type="password" placeholder="Password" name="password" value="{{$password}}">
                    <span class="color-red">{{$errors->first('password')}}</span>

                </div>
                <div class="col-md-6 col-12 mb-5">
                    <label>Password Confirmation</label>
                    <input type="password" placeholder="Xác nhận mật khẩu" name="password_confirmation">
                    <span class="color-red">{{$errors->first('password_confirmation')}}</span>

                </div>
                

            </div>

        </div>

    </div>

</div>

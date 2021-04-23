<div class="tab-pane fade  show active" id="address-edit" role="tabpanel">
    <div class="myaccount-content">
        <h3>Billing Address</h3>

        <address>
            <p><strong>{{$item->name}}</strong></p>
            <p>Địa chỉ: {{$item->address}}</p>
            <p>Mobile: {{$item->phone}}</p>
        </address>

        <a href="#" class="btn btn-dark btn-round d-inline-block"><i class="fa fa-edit"></i>Edit Address</a>
    </div>
</div>

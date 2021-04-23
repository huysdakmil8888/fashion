<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Dashboard</h3>

        <div class="welcome">
            <p>xin chào, <strong>{{$item->name}}</strong> (Nếu không phải là <strong>{{$item->name}} !</strong><a href="{{route('customer/logout')}}" class="logout"> Logout</a>)</p>
        </div>

        <p class="mb-0 mt-3">Từ trang tổng quan tài khoản của bạn. bạn có thể dễ dàng kiểm tra và xem các
            đơn đặt hàng gần đây, quản lý địa chỉ giao hàng, thanh toán và chỉnh sửa
            mật khẩu và chi tiết tài khoản của bạn.</p>
    </div>
</div>

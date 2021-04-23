<div class="tab-pane fade  show active" id="account-info" role="tabpanel">
    <div class="myaccount-content">
        <h3>Account Details</h3>

        <div class="account-details-form">
            <form action="" method="post">
                <div class="row">
                    @php
                        $name=old('name',$item->name);
                        $email=old('email',$item->email);
                    @endphp

                    <div class="col-12 mb-30">
                        <input id="display-name" required placeholder="Display Name" type="text" name="name" value="{{$name}}">
                    </div>

                    <div class="col-12 mb-30">
                        <input id="email" required placeholder="Email Address" type="email" name="email" value="{{$email}}">
                    </div>

                    <div class="col-12 mb-30">

                        <input style="display: inline;width: 8%;" type="checkbox" id="open_pass"> <span>Password change</span>

                    </div>

                    <div id="box" class="row" style="display: none">
                    <div class="col-12 mb-30">
                        <input id="current-pwd" placeholder="Current Password" type="password" name="current_password">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <input id="new-pwd" placeholder="New Password" type="password" name="password">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <input id="confirm-pwd" placeholder="Confirm Password" type="password" name="password_confirmation">
                    </div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="url" value="{{route('customer/edit')}}">
                        <button value="submit" class="btn btn-dark btn-round btn-lg" id="">Save Changes</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

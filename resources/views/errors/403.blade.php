@extends('admin.main')

@section('content')

    @include ('admin.templates.page_header', ['pageIndex' => true])
    @include ('admin.templates.zvn_notify')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <p>Bạn không có quyền truy cập vào chức năng này</p>
            </div>
        </div>
    </div>

@endsection

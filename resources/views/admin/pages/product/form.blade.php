@extends('admin.main')
@php
    $type = Request::input('type', 'general');
@endphp
@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')
    @include('admin.templates.zvn_notify')


    @if ( @$item['id'])
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul id="settingTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li @if ($type == 'general') class="active" @endif><a href="{{ route('product/form', ['id'=>$item['id'],'type' => 'general']) }}" role="tab">Thông tin cơ bản</a></li>
                    <li @if ($type == 'attribute') class="active" @endif><a href="{{ route('product/form', ['id'=>$item['id'],'type' => 'attribute']) }}" role="tab">Giá theo màu sắc</a></li>
                    <li @if ($type == 'seo') class="active" @endif><a href="{{ route('product/form', ['id'=>$item['id'],'type' => 'seo']) }}" role="tab">SEO</a></li>
                    <li @if ($type == 'content') class="active" @endif><a href="{{ route('product/form', ['id'=>$item['id'],'type' => 'content']) }}" role="tab">More info</a></li>
                </ul>
                <div id="settingTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in">
                        @switch($type)
                            @case('general')
                                @include('admin.pages.product.form_info')
                                @include('admin.pages.product.form_category')
                                @include('admin.pages.product.form_price')
                                @include('admin.pages.product.form_special')
                            @break
                            @case('attribute')
                                @include('admin.pages.product.form_attribute')
                                @include('admin.pages.product.form_dropzone')

                            @break
                            @case('seo')
                                @include('admin.pages.product.form_seo')
                            @break
                            @default
                                @include('admin.pages.product.form_content')
                            @break
                        @endswitch
                    </div>
                </div>
            </div>


        </div>
    @else
        @include('admin.pages.product.form_add')
    @endif
@endsection





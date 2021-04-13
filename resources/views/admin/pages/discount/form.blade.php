@extends('admin.main')
@php

    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkeditor  = config('zvn.template.form_ckeditor');
    $formDatePicker= config('zvn.template.form_date_picker');
    if(isset($item['expire_date'])) $item['expire_date']=date("d/m/Y",@$item['expire_date']);



    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $type      = ['percent'=>'percent','price'=>'price'];

    $inputHiddenID    = Form::hidden('id', @$item['id']);
    $inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);

    $elements = [
        [
            'label'   => Form::label('code', 'Code', $formLabelAttr),
            'element' => Form::text('code', @$item['code'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('type', 'Type', $formLabelAttr),
            'element' => Form::select('type', $type, @$item['type'], $formInputAttr)
        ],
         [
            'label'   => Form::label('amount', 'Amount', $formLabelAttr),
            'element' => Form::text('amount', @$item['amount'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('limit', 'Số lần sử dụng', $formLabelAttr),
            'element' => Form::text('limit', @$item['limit'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('expire_date', 'Ngày hết hạn', $formLabelAttr),
            'element' => Form::text('expire_date', @$item['expire_date'],  $formDatePicker )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'element' => $inputHiddenID . $inputHiddenThumb . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp
@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                        {!! FormTemplate::show($elements)  !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        $(document).ready(function() {


            $( ".datepicker" ).datepicker({
                dateFormat: "dd-mm-yy"
            });
        } );
    </script>
@stop

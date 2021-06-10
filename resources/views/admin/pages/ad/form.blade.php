@extends('admin.main')
@php

    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkeditor  = config('zvn.template.form_ckeditor');


    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $positionValue    = ['top'=>'top','middle'=>'middle','bottom'=>'bottom','footer'=>'footer'];
    $inputHiddenID    = Form::hidden('id', @$item['id']);
    $inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);

    $elements = [
        [
            'label'   => Form::label('order', 'Order', $formLabelAttr),
            'element' => Form::text('ordering', @$item['ordering'], $formInputAttr )
        ],
        [
            'label'   => Form::label('position', 'Position', $formLabelAttr),
            'element' => Form::select('position', $positionValue, @$item['position'], $formInputAttr)
        ],
        [
            'label'   => Form::label('description', 'Description', $formLabelAttr),
            'element' => Form::textarea('description', @$item['description'],  $formCkeditor )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'label'   => Form::label('link', 'Link', $formLabelAttr),
            'element' => Form::text('link', @$item['link'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('thumb', 'Thumb', $formLabelAttr),
            'element'   => Template::showFileManager($item['thumb'] ?? '')

        ],
        [
            'element' => $inputHiddenID . $inputHiddenThumb . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp

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

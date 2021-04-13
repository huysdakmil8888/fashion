
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input_no_padding');
    $formLabelAttr = config('zvn.template.form_label_no_padding');
    $formCkeditor  = config('zvn.template.form_ckeditor');
    //for tag



    $inputHiddenID = Form::hidden('id', $item['id'] ?? '');


    $elements = [

         [
            'label'   => Form::label('content', 'Content', $formLabelAttr),
            'element' => Form::textArea('content', @$item['content'],  $formCkeditor ),
            'type'=>'full'

        ],
         [
            'label'   => Form::label('datasheet', 'Datasheet', $formLabelAttr),
            'element' => Form::textArea('datasheet', @$item['datasheet'],  $formCkeditor ),
            'type'=>'full'

        ],
        [
            'element' => $inputHiddenID .  Form::submit('Save', ['class'=>'btn btn-danger', 'name' => 'changeInfo']),
            'type'    => "btn-submit"
        ]
    ];
@endphp


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Thông tin cơ bản'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/change-content"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'main-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>

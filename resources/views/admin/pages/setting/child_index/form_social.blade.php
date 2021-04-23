@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttributes = config('zvn.template.form_input_tags');
    $formLabelAttributes = config('zvn.template.form_label');
    
    $elements = [
        [
            'label'     => Form::label('youtube', 'Youtube', $formLabelAttributes),
            'element'   => Form::text('youtube', $item['youtube'] ?? '', $formInputAttributes)
        ],
        [
            'element'   => Form::submit('Lưu', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit'
        ]
    ]
@endphp

<div class="x_panel">
    <div class="x_content">
        {!! Form::open([
            'url' => route("$controllerName/social_setting"), 
            'method' => 'POST',
            'id' => 'main-form',
            'class' => 'form-horizontal form-label-left',
        ]) !!}
            {!! FormTemplate::show($elements) !!}
        {!! Form::close() !!}
    </div>
</div>


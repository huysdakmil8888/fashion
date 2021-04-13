@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttributes = config('zvn.template.form_input');
    $formCKEditorAttributes = config('zvn.template.form_ckeditor');
    $formLabelAttributes = config('zvn.template.form_label');

    $elements = [
       [
            'label'   => Form::label('logo', 'Logo', $formLabelAttributes),
            'element'   => Template::showFileManager($item['thumb'] ?? '')
        ],
        [
            'label'     => Form::label('hotline', 'Hotline', $formLabelAttributes),
            'element'   => Form::text('hotline', $item['hotline'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('facebook', 'Link facebook', $formLabelAttributes),
            'element'   => Form::text('facebook', $item['facebook'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('google', 'Link google', $formLabelAttributes),
            'element'   => Form::text('google', $item['google'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('twitter', 'Link twitter', $formLabelAttributes),
            'element'   => Form::text('twitter', $item['twitter'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('price_max', 'Price_max', $formLabelAttributes),
            'element'   => Form::text('price_max', $item['price_max'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('price_min', 'Price_min', $formLabelAttributes),
            'element'   => Form::text('price_min', $item['price_min'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('price_range', 'Price_range', $formLabelAttributes),
            'element'   => Form::text('price_range', $item['price_range'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('copyright', 'Copyright', $formLabelAttributes),
            'element'   => Form::text('copyright', $item['copyright'] ?? '', $formInputAttributes)
        ],
        [
            'label'     => Form::label('introduce', 'Giới thiệu', $formLabelAttributes),
            'element'   => Form::textarea('introduce', $item['introduce'] ?? '', $formCKEditorAttributes)
        ],
        [
            'label'     => Form::label('contact_us', 'Thông tin liên hệ trang chủ', $formLabelAttributes),
            'element'   => Form::textarea('contact_us', $item['contact_us'] ?? '', $formCKEditorAttributes)
        ],
        [
            'label'     => Form::label('get_in_touch', 'Thông tin trang liên hệ', $formLabelAttributes),
            'element'   => Form::textarea('get_in_touch', $item['get_in_touch'] ?? '', $formCKEditorAttributes)
        ],
        [
            'label'     => Form::label('map', 'Google map', $formLabelAttributes),
            'element'   => Form::textarea('map', $item['map'] ?? '', $formInputAttributes)
        ],
        [
            'element'   => Form::submit('Lưu', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit'
    ]]
@endphp

<div class="x_panel">
    <div class="x_content">
        {!! Form::open([
            'url' => route("$controllerName/general_setting"), 
            'method' => 'POST', 
            'class' => 'form-horizontal form-label-left',
            'files' => true,
            'id' => 'main-form'
        ]) !!}
            {!! FormTemplate::show($elements) !!}
        {!! Form::close() !!}
    </div>
</div>


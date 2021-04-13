@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .schedule,.hider{
            text-decoration: underline;
            color: cornflowerblue;
        }
    </style>
@stop
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input_no_padding');
    $formLabelAttr = config('zvn.template.form_label_no_padding');
    $formDatePicker= config('zvn.template.form_date_picker');
    if(isset($item['date_start'])) $item['date_start']=date("d/m/Y",@$item['date_start']);
    if(isset($item['date_end'])) $item['date_end']=date("d/m/Y",@$item['date_end']);




    $inputHiddenID = Form::hidden('id', $item['id'] ?? '');


    $elements = [
        [
            'label'   => Form::label('price', 'Price (VND)', $formLabelAttr),
            'element' => Form::text('price', $item['price'], $formInputAttr ),
            'type'=>'full'
        ],
        [
            'label'   => Form::label('sale', 'Giá sale (VND)', $formLabelAttr),
            'element' => Form::text('sale', $item['sale'],  $formInputAttr ),
            'type'=>'full'

        ],
        [
            'label'   => "",
            'element' => "<a class='hider'>Hide</a>",
            'type'=>'full'

        ],
        [
            'label'   => Form::label('date_start', 'Ngày bắt đầu', $formLabelAttr),
            'element' => Form::text('date_start', @$item['date_start'],  $formDatePicker ),
            'type'=>'full'

        ],
        [
            'label'   => Form::label('date_end', 'Ngày hết hạn', $formLabelAttr),
            'element' => Form::text('date_end', @$item['date_end'],  $formDatePicker ),
            'type'=>'full'

        ],
        [
            'label'   => "",
            'element' => "<a class='schedule'>Schedule</a>",
            'type'=>'full'

        ],

        [
            'element' => $inputHiddenID .  Form::submit('Save', ['class'=>'btn btn-danger', 'name' => 'changePrice']),
            'type'    => "btn-submit"
        ]
    ];
@endphp


<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Giá sản phẩm'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/change-price"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'main-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>
@section('script2')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        $(document).ready(function() {
            elements=$("input[name='date_start'],input[name='date_end']");
            elements.parent().parent().hide();
            elements.datepicker({
                dateFormat: "dd-mm-yy"
            });

            schedule=$(".schedule")
            hide=$(".hider")
            hide.hide();
            schedule.click(function(e){

                elements.parent().parent().show().val('');
                $(this).hide()
                hide.show();

            });
            hide.click(function(e){

                elements.parent().parent().hide().val('');
                $(this).hide()
                schedule.show();

            });
        } );
    </script>
@stop

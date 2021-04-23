
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;use App\Models\GroupModel;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label_edit');


$inputHiddenID    = Form::hidden('id', $item['id']);
$roleModel=new GroupModel();
$level=$roleModel->getItem(null,['task'=>'get-item-for-select-box']);
$elements = [
    [
        'label'   => Form::label('level', 'Level', $formLabelAttr),
        'element' => Form::select('level', $level, @$item['roles'][0]['name'], $formInputAttr)
    ],[
        'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success', 'name' => 'taskChangeLevel']),
        'type'    => "btn-submit-edit"
    ]
];


@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="x_panel">
    @include('admin.templates.x_title', ['title' => 'Quyền truy cập'])
    <div class="x_content">
        {{ Form::open([
            'method'         => 'POST', 
            'url'            => route("$controllerName/change-level"),
            'accept-charset' => 'UTF-8',
            'enctype'        => 'multipart/form-data',
            'class'          => 'form-horizontal form-label-left',
            'id'             => 'main-form' ])  }}
            {!! FormTemplate::show($elements)  !!}
        {{ Form::close() }}
    </div>
</div>
</div>
@extends('admin.main')
@php

    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;use App\Models\PermissionModel;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');


    $permissionModel=new PermissionModel();
    $permissionArray= $permissionModel->getItem(null,['task'=>'get-item-for-checkbox']);
    $html='';
    $ids=[];
    if(isset($item)){
        foreach ($item['permissions'] as $item2) {
            $ids[]=$item2['id'];
        }
    }
    foreach ($permissionArray as $id=>$name) {
         $class=in_array($id,$ids)?'checked':'';
        $html.=sprintf('<div class="icheckbox_flat-green checked">
                <input name="%s" type="checkbox" class="flat" %s ></div> %s <br />',
                "permission_ids[$id]",$class,$name);
    }

    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];

    $inputHiddenID    = Form::hidden('id', @$item['id']);
    $inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],
         [
            'label'   => Form::label('permission', 'Permission', $formLabelAttr),
            'element' => '<div class="checkbox">
                        '.$html.'
                        </div>'
        ],
         [
            'label'     => Form::label('status', 'Status', $formLabelAttr),
            'element'   => Form::select('status', $statusValue, $item['status'] ?? 'default', $formInputAttr)
        ],

        [
            'element' => $inputHiddenID  . Form::submit('Save', ['class'=>'btn btn-success']),
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
                @include('admin.templates.zvn_notify')
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

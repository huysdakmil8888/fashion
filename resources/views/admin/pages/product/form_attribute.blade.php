@php

    use App\Helpers\Form as FormTemplate;
    use App\Models\ColorModel;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Str;


    $formInputAttributes = config('zvn.template.form_input');
    $formLabelAttributes = [
            'class' => 'control-label col-md-1 col-sm-3 col-xs-12'
        ];
    $form_tag=config('zvn.template.form_tag');

    $colorModel=new ColorModel();
    $define=Config::get('zvn.template.color');
   $attribute=$colorModel->getItem(['id'=>$item->id],['task'=>'get-color']);
    $inputHiddenID = Form::hidden('id', $item['id'] ?? '');
    $arr=[];
    //dd($attribute);
/*    dd($item->colors->toArray());


*/    foreach ($attribute as $key=>$value) {
        $slug=Str::slug($value['name']);

        //checked
       foreach (@$item->colors->toArray() as $i){
            if($i['name']==$value['name']){
               $newArr[$key]=$i;

            }
        }
      if(@$newArr[$key]['pivot']['default']==1){
               $checked="checked";
        }else{
               $checked="";
        }

         $arr[]=[
            'label'   => '',
            'element'   => sprintf('<div class="input-group">
                <span class="input-group-btn">
                <button style="background:%s;" type="button" class="btn btn-danger go-class">%s</button>
                </span>
                <input type="text" class="form-control" name="price[%s]" value="%s">

                </div>

                <input %s type="radio" name="default" value="%s" /> lua chon lam gia tri mac dinh'
                ,$define[$slug],$value['name'],$value['id'],
                @$newArr[$key]['pivot']['value'],
                $checked,
                $value['id']


                ),
        ];
    }



    $elements = [];
    $elements=array_merge($elements,$arr);
    array_push($elements,[
            'element'   => $inputHiddenID . Form::submit('Save', ['class' => 'btn btn-danger', 'name' => 'changeAttribute']),
            'type'      => 'btn-submit'
        ]);
@endphp

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'giá theo màu sắc'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST',
                'url'            => route("$controllerName/change-attribute"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'main-form2' ])  }}
            {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>
@section('script')
    <script>
        document.getElementById("main-form2").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        }
    </script>
@stop
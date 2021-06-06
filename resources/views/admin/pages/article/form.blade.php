@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;use Illuminate\Support\Facades\Config;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkeditor  = config('zvn.template.form_ckeditor');

    //for tag
    $form_tag      = config('zvn.template.form_tag');
    $tag            = $item?implode(',',$item->tags()->pluck('name')->toArray()):'';

    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];

    $inputHiddenID    = Form::hidden('id', $item['id']??"");
    $inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);

    $language=config('language');
    $el=[];
    foreach ($language as $lang) {
        if(!empty($item)){
            $name=@$item->translate($lang['code'])->name;
            $slug=@$item->translate($lang['code'])->slug;
            $description=@$item->translate($lang['code'])->description;
            $content=@$item->translate($lang['code'])->content;
        }
        $el[$lang['code']]=[
            [
                'label'   => Form::label('name', 'Name', $formLabelAttr),
                'element' => Form::text($lang['code'].'[name]', @$name,  $formInputAttr+['id'=>'name'] )
            ],
             [
                'label'   => Form::label('slug', 'Slug', $formLabelAttr),
                'element' => Form::text($lang['code'].'[slug]',@$slug,  $formInputAttr+['id'=>'slug'] )
            ],
             [
                'label'   => Form::label('description', 'Description', $formLabelAttr),
                'element' => Form::textarea($lang['code'].'[description]', @$description,  $formCkeditor )
            ],
             [
                'label'   => Form::label('content', 'Content', $formLabelAttr),
                'element' => Form::textarea($lang['code'].'[content]', @$content,  $formCkeditor )
            ],
             [
                'element' => $inputHiddenID  . Form::submit('Save', ['class'=>'btn btn-success']),
                'type'    => "btn-submit"
             ]
        ];
    }

    $elements = [

         [
            'label'   => Form::label('category_article_id', 'Category_article', $formLabelAttr),
            'element' => Form::select('category_article_id', $itemsCategoryArticle, @$item['category_article_id'],  $formInputAttr)
        ],
         [
            'label'   => Form::label('tag', 'Tag', $formLabelAttr),
            'element'   => Form::text("tag",@$tag , $form_tag),
        ],

        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'],  $formInputAttr)
        ],

        [
            'label'   => Form::label('thumb', 'thumb', $formLabelAttr),
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
        @if(isset($item))
        @include('admin.pages.article.article_language')
        @endif
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Thông tin chung'])
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
    <script>
        document.getElementById("main-form").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        }
        $(function(){
            $("[role='tagsinput']").tagsinput('items')
        })
    </script>
@stop

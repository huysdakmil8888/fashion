@php
    use App\Helpers\Form as FormTemplate;

@endphp
<div class="col-md-12 col-sm-6  ">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Đa ngôn ngữ</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                @foreach($el as $key=>$val)
                    @php
                        if($key=='vi') $class="active";
                        else $class="";
                        $name=config('language')[$loop->index]['name'];

                    @endphp
                <li class="nav-item {{$class}}">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#{{$key}}">{{$name}}</a>
                </li>
                @endforeach
            </ul>
{{--            @dd($el);--}}
            <div class="tab-content" id="myTabContent">
                @foreach($el as $key=>$val)
                    @php
                        if($key=='vi') $class="active in";
                        else $class="";

                    @endphp
                <div class="tab-pane fade {{$class}}" id="{{$key}}" >
                    {{ Form::open([
                        'method'         => 'POST',
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                    {!! FormTemplate::show($val)  !!}
                    {{ Form::close() }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

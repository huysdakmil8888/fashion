@php
    use App\Helpers\Template;
@endphp
@isset($share_setting)
<div class="post-share col-lg-6 col-12 mv-15">
    <h4>Share:</h4>
    <ul class="share">
            {!! Template::share($share_setting,URL::current(),'article','after') !!}
    </ul>
</div>
@endisset


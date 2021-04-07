@extends('admin.main')

@section('content')
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Quản lý Video</h3>
        <form action="{{route('video')}}" method="post">
            @csrf
            @method('post')
            URL: <input type="text" value="" name="url" size="40" >
            <input type="submit" name="submit" class="btn btn-sm btn-danger">
        </form>
    </div>
</div>
    {!! $htmlBody !!}


@endsection

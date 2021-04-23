<div class="contact-info-wrap col-md-6 col-12 mb-40">
    <h3>Get in Touch</h3>
{{--   {!! $setting_general['map'] !!}--}}
    <div id="map"><img src="{{asset('assets/images/icons/loading.gif')}}" alt=""></div>
    <br>
    <br>
    <br>
    <br>
    {!! $setting_general['get_in_touch'] !!}

</div>

@section('script')
    <script>
        //loading map in contact page
        $( "#map" ).load( "{{route('contact/map')}}", function(data) {
                map=JSON.parse(data)

            $(this).html(map.map)

        });
    </script>
@stop
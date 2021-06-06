<!-- jQuery -->
<script src="{{ asset('admin/js/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/asset/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/js/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('admin/asset/nprogress/nprogress.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('admin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/asset/iCheck/icheck.min.js') }}"></script>
<script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/js/notify.js/notify.min.js')}}"></script>
<script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
<!-- Custom Theme Scripts -->

<!-- dropzone + bootstrap tags input -->
<script src="{{asset('admin/js/dropzone.js')}}"></script>
<script src="{{asset('admin/tag/bootstrap-tagsinput.min.js')}}"></script>
{{--slugify--}}
<script src="{{ asset('admin/js/slug/speakingurl.min.js') }}"></script>
<script src="{{ asset('admin/js/slug/slugify.min.js') }}"></script>
<script>
    $(function (){
        $('#slug').slugify('#name'); // Type as you slug
        $("[name='en[slug]']").slugify("[name='en[name]']")

    });
</script>

<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/my-js.js') }}"></script>
<script src="{{ asset('admin/js/functions.js') }}"></script>
@php
    use App\Helpers\Template;
    use App\Helpers\HightLight;

@endphp

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">STT</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Phone</th>
                    <th class="column-title">Nội dung</th>
                    <th class="column-title">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items) > 0)
                    @foreach($items as $key => $val)
                        @php
                            $index          = $key + 1;
                            $name           = HightLight::show($val['name'], $params['search'], 'name');
                            $email          = HightLight::show($val['email'], $params['search'], 'email');
                            $phone          = HightLight::show($val['phone'], $params['search'], 'phone');
                            $message        = HightLight::show($val['message'], $params['search'], 'message');
                            $phone        = HightLight::show($val['phone'], $params['search'], 'phone');
                            $status       = Template::showItemSelect($controllerName, $val['id'], $val['status'], 'contact');

                            $time           = $val['time'];
                            $ipAddress      = $val['ip_address'];

                        @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>
                                <p></p>{!! $name !!}</p>
                            </td>
                            <td >{!! $email !!}</td>
                            <td >{!! $phone !!}</td>
                            <td >{!! $message !!}</td>
                            <td class="status-{{$val['id']}}">{!! $status !!}</td>


                        </tr>
                    @endforeach
                    
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>

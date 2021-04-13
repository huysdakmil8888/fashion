@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">STT</th>
                    <th class="column-title">Mã Code</th>
                    <th class="column-title">Loại</th>
                    <th class="column-title">Số lượng</th>
                    <th class="column-title">Ngày hết hạn</th>
                    <th class="column-title">Số lần sử dụng còn lại</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $code            = Hightlight::show($val['code'], $params['search'], 'code');
                            $type            = Hightlight::show($val['type'], $params['search'], 'type');
                            $amount            = Hightlight::show($val['amount'], $params['search'], 'amount');
                            $limit            = Hightlight::show($val['limit'], $params['search'], 'limit');
                            $expire_date     = date("d/m/Y",$val['expire_date']);
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);

                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="20%">
                                 {!! $code !!}
                                
                            </td>
                            <td>{!! $type !!}</td>
                            <td>{!! $amount !!}</td>
                            <td>{{$expire_date}}</td>
                            <td>{!! $limit !!}</td>

                            <td>{!! $status !!}</td>


                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           
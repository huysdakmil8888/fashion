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
                    <th>Vị trí </th>
                    <th class="column-title">{{$controllerName}} Info</th>
                    <th class="column-title">Hình ảnh</th>
                    <th class="column-title">Sắp xếp</th>
                    <th class="column-title">Trạng thái</th>
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
                            $position        = $val['position'];
                            $ordering       = Template::showItemOrdering($controllerName, $val['ordering'], $val['id']);
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $description     = Hightlight::show($val['description'], $params['search'], 'description');
                            $link            = Hightlight::show($val['link'], $params['search'], 'link');
                            $thumb           = Template::showItemThumb($controllerName, $val['thumb'], $val['name']);;
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); ;
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td>{{$position}}</td>
                            <td width="25%">
                                {!! $description !!}
                            </td>

                            <td>  {!! $thumb !!}</td>
                            <td>{!! $ordering !!}</td>
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
           
@php
    use App\Models\UserModel;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">STT</th>
                    <th class="column-title">Tên bài viết</th>
                    <th class="column-title">Hình ảnh</th>
                    @can('thay đổi trạng thái')
                    <th class="column-title">Trạng thái</th>
                    @endcan
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
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $content         = Hightlight::show($val['content'], $params['search'], 'content');
                            $thumb           = Template::showItemThumb($controllerName, $val['thumb'], $val['name']);
                            $category        = Form::select('category_id', $itemsCategory, $val['category_id'], ['class' => 'form-control select-ajax', 'data-url' => route("$controllerName/change-category", ['id' => $id, 'category_id' => 'value_new'])]);
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); 
                            $type            = Template::showItemSelect($controllerName, $id, $val['type'], 'type');
                            // $createdHistory  = Template::showItemHistory($val['created_by'], $val['created']);
                            // $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['modified']);

                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="30%">
                                {!! $name !!}
                            </td>
                            <td width="14%">
                                <p>{!! $thumb !!}</p>
                            </td>
                            @can('thay đổi trạng thái')
{{--                            <td >{!! $category !!}</td>--}}
                            <td>{!! $status !!}</td>
                            @endcan
                            {{-- <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td> --}}

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

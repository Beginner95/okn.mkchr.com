@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ trans('okn.filter') }}</div>
                    <div class="card-body">
                        <form action="/" method="get">
                        <span style="display: none">{{ csrf_token() }}</span>
                        <table class="table table-bordered" cellspacing="0">
                            <tr>
                                <th>{{ trans('okn.district') }}</th>
                                <th>{{ trans('okn.category') }}</th>
                                <th>{{ trans('okn.owner') }}</th>
                                <th>{{ trans('okn.condition') }}</th>
                                <th>{{ trans('okn.status') }}</th>
                            </tr>
                            <tr>
                                <td id="districtName" data-district-name="{{ Request::get('district') }}">
                                    <autocomplete-district></autocomplete-district>
                                </td>
                                <td>
                                    <select name="category" id="" class="form-control" title="{{ trans('okn.category') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('category') === '0') selected @endif>{{ trans('okn.category_republican') }}</option>
                                        <option value="1" @if (Request::get('category') === '1') selected @endif>{{ trans('okn.category_federal') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="owner" id="" class="form-control" title="{{ trans('okn.owner') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('owner') === '0') selected @endif>{{ trans('okn.owner_republican') }}</option>
                                        <option value="1" @if (Request::get('owner') === '1') selected @endif>{{ trans('okn.owner_federal') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="state" id="" class="form-control" title="{{ trans('okn.condition') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('state') === '0') selected @endif>{{ trans('okn.unsatisfactory') }}</option>
                                        <option value="1" @if (Request::get('state') === '1') selected @endif>{{ trans('okn.satisfactory') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="status" id="" class="form-control" title="{{ trans('okn.status') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('status') === '0') selected @endif>{{ trans('okn.revealed') }}</option>
                                        <option value="1" @if (Request::get('status') === '1') selected @endif>{{ trans('okn.registered') }}</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                            <div class="row">
                                <div class="col-sm-1">
                                    <select
                                        name="limit"
                                        class="form-control"
                                        title="{{ trans('okn.count_for_page') }}">
                                        @foreach($limits as $limit)
                                            <option
                                                value="{{ $limit }}"
                                                @if (Request::get('limit') == $limit)
                                                    selected
                                                @endif>{{ $limit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-11 text-right">
                                    <button class="btn btn-primary pull-right">{{ trans('basic.filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('okn.list_objects') }}
                        <a href="{{ route('okn.create') }}" class="btn btn-primary add-weight" title="{{ trans('okn.add_object') }}">
                            <span>{{ trans('basic.plus_icon') }}</span>
                        </a>
                    </div>
                    @if (!empty($objects->toArray()['data']))
                        <div class="card-header">
                            <div class="btn-group-sm">
                                <button type="button" class="nav-link dropdown-toggle float-right btn btn-sm btn-primary" data-toggle="dropdown">{{ trans('basic.columns') }}</button>
                                <div class="dropdown-menu headings"></div>
                            </div>
                            <div class="btn-group-sm">
                                <button type="button" id="downFont" class="btn btn-sm btn-outline-primary" title="{{ trans('basic.decrease_font') }}">{{ trans('basic.decrease_icon') }}</button>
                                <button type="button" id="upFont" class="btn btn-sm btn-outline-primary" title="{{ trans('basic.zoom_font') }}">{{ trans('basic.zoom_icon') }}</button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">

                        @if (empty($objects->toArray()['data']))
                            {{ trans('okn.not_objects') }}
                        @else
                            <table class="table table-bordered" id="dataTable">
                                <thead class="thead-light">
                                    <tr id="columns">
                                        <th scope="col">{{ trans('basic.number_icon') }}</th>
                                        <th scope="col">{{ trans('okn.name_ur') }}</th>
                                        <th scope="col">{{ trans('okn.name_chr') }}</th>
                                        <th scope="col">{{ trans('complex.name_ru') }}</th>
                                        <th scope="col">{{ trans('complex.name_chr') }}</th>
                                        <th scope="col">{{ trans('okn.date') }}</th>
                                        <th scope="col">{{ trans('okn.address') }}</th>
                                        <th scope="col">{{ trans('okn.act') }}</th>
                                        <th scope="col">{{ trans('okn.category') }}</th>
                                        <th scope="col">{{ trans('okn.owner') }}</th>
                                        <th scope="col">{{ trans('basic.latitude') }}</th>
                                        <th scope="col">{{ trans('basic.longitude') }}</th>
                                        <th scope="col">{{ trans('okn.cost_save_object') }}</th>
                                        <th scope="col">{{ trans('okn.date_start_work') }}</th>
                                        <th scope="col">{{ trans('okn.date_end_work') }}</th>
                                        <th scope="col">{{ trans('okn.source_of_financing') }}</th>
                                        <th scope="col">{{ trans('okn.documentation') }}</th>
                                        <th scope="col">{{ trans('okn.condition') }}</th>
                                        <th scope="col">{{ trans('okn.status') }}</th>
                                        <th scope="col">{{ trans('basic.comment') }}</th>
                                        <th scope="col">{{ trans('basic.file') }}</th>
                                        <th scope="col">{{ trans('basic.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach ($objects as $object)
                                    <tr>
                                        <td width="30" scope="row">{{ $i++ }}</td>
                                        <td width="150">{{ $object->name }}</td>
                                        <td width="150">{{ $object->name_chr }}</td>
                                        <td width="150">
                                            @if (empty($object->complex['name']))
                                                @if (!empty($object->isComplex))
                                                    {{ $object->name }}
                                                    @if ($object->getCountObjectInComplex($object->id) > 0)
                                                        ({{ $object->getCountObjectInComplex($object->id) }} {{ trans('okn.okn') }})
                                                    @endif
                                                @else
                                                    {{ trans('okn.not_included_complex') }}
                                                @endif
                                            @else
                                                {{ $object->complex['name'] }}
                                            @endif
                                        </td>
                                        <td width="150">
                                            @if (empty($object->complex['name_chr']))
                                                @if (!empty($object->isComplex))
                                                    {{ $object->name }}
                                                    @if ($object->getCountObjectInComplex($object->id) > 0)
                                                        ({{ $object->getCountObjectInComplex($object->id) }} {{ trans('okn.okn') }})
                                                    @endif
                                                @else
                                                    {{ trans('okn.not_included_complex') }}
                                                @endif
                                            @else
                                                {{ $object->complex['name_chr'] }}
                                            @endif
                                        </td>
                                        <td>{{ $object->date_okn }}</td>
                                        <td>{{ $object->district['name'] }} {{ $object->address }}</td>
                                        <td>{{ $object->act }}</td>
                                        <td>
                                            @if ($object->category === '0')
                                                РЗ
                                            @else
                                                ФЗ
                                            @endif
                                        </td>
                                        <td>
                                            @if ($object->owner === '0')
                                                РС
                                            @else
                                                ФС
                                            @endif
                                        </td>
                                        <td>{{ $object->latitude }}</td>
                                        <td>{{ $object->longitude }}</td>
                                        <td>{{ $object->sum_npd }}</td>
                                        <td>{{ \Carbon\Carbon::parse($object->start_job)->format('d.m.Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($object->end_job)->format('d.m.Y') }}</td>
                                        <td>{{ $object->finance }}</td>
                                        <td>{{ $object->npd }}</td>
                                        <td>
                                            @if ($object->state === '0')
                                                {{ trans('okn.unsatisfactory') }}
                                            @else
                                                {{ trans('okn.satisfactory') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($object->status === '0')
                                                {{ trans('okn.revealed') }}
                                            @else
                                                {{ trans('okn.registered') }}
                                            @endif
                                        </td>
                                        <td>{{ $object->comment }}</td>
                                        <td>
                                            @if (!empty($object->file))
                                                <a href="{{ '/files/' . $object->file }}">{{ trans('basic.download') }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                href="object/{{ $object->id}}/edit"
                                                title="{{ trans('basic.edit') }}">
                                                <img src="/images/pencil.svg" width="15px">
                                            </a>
                                            <span
                                                style="cursor: pointer"
                                                title="{{ trans('basic.delete') }}"
                                                v-on:click="deleteObject({{ $object->id }})"
                                                onclick="return confirm('{{ trans('okn.delete') }}');">
                                                <img src="/images/garbage.svg" width="15px">
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            {{ $objects->links() }}
        </div>
    </div>
@endsection

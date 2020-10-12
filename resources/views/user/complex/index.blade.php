@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('complex.filter') }}
                    </div>
                    <div class="card-body">
                        <form action="/" method="get">
                        <span style="display: none">{{ csrf_token() }}</span>
                        <table class="table table-bordered" cellspacing="0">
                            <tr>
                                <th>{{ trans('complex.district') }}</th>
                                <th>{{ trans('complex.category') }}</th>
                                <th>{{ trans('complex.owner') }}</th>
                                <th>{{ trans('complex.condition') }}</th>
                                <th>{{ trans('complex.status') }}</th>
                            </tr>
                            <tr>
                                <td id="districtName" data-district-name="{{ Request::get('district') }}">
                                    <autocomplete-district></autocomplete-district>
                                </td>
                                <td>
                                    <select name="category" id="" class="form-control" title="{{ trans('complex.category') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('category') === '0') selected @endif>{{ trans('complex.category_republican') }}</option>
                                        <option value="1" @if (Request::get('category') === '1') selected @endif>{{ trans('complex.category_federal') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="owner" id="" class="form-control" title="{{ trans('complex.owner') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('owner') === '0') selected @endif>{{ trans('complex.owner_republican') }}</option>
                                        <option value="1" @if (Request::get('owner') === '1') selected @endif>{{ trans('complex.owner_federal') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="state" id="" class="form-control" title="{{ trans('complex.condition') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('state') === '0') selected @endif>{{ trans('complex.unsatisfactory') }}</option>
                                        <option value="1" @if (Request::get('state') === '1') selected @endif>{{ trans('complex.satisfactory') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="status" id="" class="form-control" title="{{ trans('complex.status') }}">
                                        <option value="">{{ trans('basic.choose') }}</option>
                                        <option value="0" @if (Request::get('status') === '0') selected @endif>{{ trans('complex.revealed') }}</option>
                                        <option value="1" @if (Request::get('status') === '1') selected @endif>{{ trans('complex.registered') }}</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                            <div class="row">
                                <div class="col-sm-1">
                                    <select
                                        name="limit"
                                        class="form-control"
                                        title="{{ trans('complex.count_for_page') }}">
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
                        {{ trans('complex.list') }}
                        <a href="{{ route('complex.create') }}" class="btn btn-primary add-weight" title="{{ trans('basic.add') }}">
                            <span>+</span>
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
                            {{ trans('complex.empty') }}
                        @else
                            <table class="table table-bordered" id="dataTable">
                                <thead class="thead-light">
                                    <tr id="columns">
                                        <th scope="col">{{ trans('basic.number_icon') }}</th>
                                        <th scope="col">{{ trans('complex.name_ru') }}</th>
                                        <th scope="col">{{ trans('complex.name_chr') }}</th>
                                        <th scope="col">{{ trans('complex.date') }}</th>
                                        <th scope="col">{{ trans('complex.address') }}</th>
                                        <th scope="col">{{ trans('complex.act') }}</th>
                                        <th scope="col">{{ trans('complex.category') }}</th>
                                        <th scope="col">{{ trans('complex.owner') }}</th>
                                        <th scope="col">{{ trans('basic.latitude') }}</th>
                                        <th scope="col">{{ trans('basic.longitude') }}</th>
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
                                                onclick="return confirm({{ trans('complex.delete') }});">
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

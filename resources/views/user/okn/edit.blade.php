@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">
                        {{ trans('okn.edit') }}
                    </div>
                    <div class="card-body">
                        <form action="/object-update/{{$okn->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('okn.name_ru') }}</label>
                                        <textarea
                                            name="okn-name"
                                            class="form-control"
                                            title="{{ trans('okn.name_ru') }}"
                                            required>{{ $okn->name }}
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="{{ trans('okn.name_chr') }}"></label>
                                        <textarea
                                            name="okn-name-chr"
                                            class="form-control"
                                            title="{{ trans('okn.name_chr') }}">{{ $okn->name_chr }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="complex_exist">{{ trans('okn.included_complex') }}</label>
                                <input
                                    @if (!empty($okn->complex_id))
                                        checked
                                    @endif
                                    type="checkbox"
                                    name="complex"
                                    id="complex_exist"
                                    @click="isVisible = !isVisible"
                                    title="{{ trans('okn.choose_if_included_complex') }}">
                            </div>

                            <div
                                id="complexName"
                                data-complex-name="@if(!empty($okn->complex)) {{ $okn->complex->name }}@endif"
                                class="form-group"
                                @if (!empty($okn->complex_id))
                                    v-if="!isVisible"
                                @else
                                    v-if="isVisible"
                                @endif>
                                <label for="">{{ trans('okn.choose_complex') }}</label>
                                <autocomplete-complex></autocomplete-complex>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">{{ trans('okn.date') }}</label>
                                        <input
                                            type="text"
                                            name="date-okn"
                                            class="form-control"
                                            title="{{ trans('okn.date') }}"
                                            value="{{ $okn->date_okn }}">
                                    </div>
                                    <div class="col">
                                        <label for="origin">{{ trans('okn.act') }}</label>
                                        <input
                                            type="text"
                                            name="act"
                                            class="form-control"
                                            title="{{ trans('okn.act') }}"
                                            value="{{ $okn->act }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div
                                        id="districtName"
                                        class="col"
                                        data-district-name="{{ !empty($okn->district->name) ? $okn->district->name : '' }}">
                                        <label for="">{{ trans('okn.address') }}</label>
                                        <autocomplete-district></autocomplete-district>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('okn.additional_address') }}</label>
                                        <input
                                            type="text"
                                            name="address"
                                            class="form-control"
                                            title="{{ trans('okn.address_after_district') }}"
                                            placeholder="{{ trans('okn.address_after_district') }}"
                                            value="{{ $okn->address }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('okn.category') }}</label>
                                        <select name="category" id="" class="form-control" title="{{ trans('okn.category') }}">
                                            <option value="0" @if($okn->category === '0') selected @endif>{{ trans('okn.category_republican') }}</option>
                                            <option value="1" @if($okn->category === '1') selected @endif>{{ trans('okn.category_federal') }}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('okn.owner') }}</label>
                                        <select name="owner" id="" class="form-control" title="{{ trans('okn.owner') }}">
                                            <option value="0" @if($okn->owner === '0') selected @endif>{{ trans('okn.owner_republican') }}</option>
                                            <option value="1" @if($okn->owner === '1') selected @endif>{{ trans('okn.owner_federal') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('basic.latitude') }}</label>
                                        <input
                                            name="latitude"
                                            class="form-control"
                                            title="{{ trans('basic.latitude') }}"
                                            value="{{ $okn->latitude }}">
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('basic.longitude') }}</label>
                                        <input
                                            type="text"
                                            name="longitude"
                                            class="form-control"
                                            title="{{ trans('basic.longitude') }}"
                                            value="{{ $okn->longitude }}">
                                    </div>
                                </div>
                            </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">{{ trans('okn.preservation_funds_needed') }}</label>
                                            <input
                                                type="text"
                                                name="sum-npd"
                                                class="form-control"
                                                title="{{ trans('okn.cost_save_object') }}"
                                                value="{{ $okn->sum_npd }}">
                                        </div>
                                        <div class="col">
                                            <label for="">{{ trans('okn.date_start_work') }}</label>
                                            <input
                                                type="date"
                                                name="start-job"
                                                class="form-control"
                                                title="{{ trans('okn.date_start_work') }}"
                                                value="{{ \Carbon\Carbon::parse($okn->start_job)->format('Y-m-d') }}">
                                        </div>
                                        <div class="col">
                                            <label for="">{{ trans('okn.date_end_work') }}</label>
                                            <input
                                                type="date"
                                                name="end-job"
                                                class="form-control"
                                                title="{{ trans('okn.date_end_work') }}"
                                                value="{{ \Carbon\Carbon::parse($okn->end_job)->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">{{ trans('okn.source_financing') }}</label>
                                            <input
                                                type="text"
                                                name="finance"
                                                class="form-control"
                                                title="{{ trans('okn.source_of_financing') }}"
                                                value="{{ $okn->finance }}">
                                        </div>
                                        <div class="col">
                                            <label for="">{{ trans('okn.documentation') }}</label>
                                            <input
                                                type="text"
                                                name="npd"
                                                class="form-control"
                                                title="{{ trans('okn.documentation') }}"
                                                value="{{ $okn->npd }}">
                                        </div>
                                        <div class="col">
                                            <label for="">{{ trans('okn.condition') }}</label>
                                            <select name="state" id="" class="form-control" title="{{ trans('okn.condition') }}">
                                                <option value="0" @if($okn->state === '0') selected @endif>{{ trans('okn.unsatisfactory') }}</option>
                                                <option value="1" @if($okn->state === '1') selected @endif>{{ trans('okn.satisfactory') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{ trans('okn.status') }}</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0" @if($okn->status === '0') selected @endif>{{ trans('okn.revealed') }}</option>
                                        <option value="1" @if($okn->status === '1') selected @endif>{{ trans('okn.registered') }}</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">{{ trans('basic.comment') }}</label>
                                <textarea name="comment" class="form-control">{{ $okn->comment }}</textarea>
                            </div>
                            <div class="form-group">
                            @if (!empty($okn->file))
                                <input type="hidden" value="{{ $okn->file }}" id="fileName" name="file-name">
                                <a href="{{ '/files/' . $okn->file }}" class="btn btn-dark" v-if="!isVisibleFile">{{ trans('basic.download') }}</a>
                                <a
                                    id="deleteFile"
                                    v-if="!isVisibleFile"
                                    href="#"
                                    class="btn btn-danger"
                                    @click="isVisibleFile = !isVisibleFile">
                                    {{ trans('basic.delete_file') }}
                                </a>
                            @else
                                <a
                                    href="#"
                                    v-if="!isVisibleFile"
                                    @click="isVisibleFile = !isVisibleFile"
                                    class="btn btn-success">{{ trans('basic.add_file') }}</a>
                            @endif
                            </div>
                            <div class="form-group" v-show="isVisibleFile">
                                <label for="">{{ trans('basic.add_new_file') }}</label>
                                <input
                                    type="file"
                                    name="file"
                                    title="{{ trans('basic.supported_formats') }}"
                                    class="custom-file">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('basic.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

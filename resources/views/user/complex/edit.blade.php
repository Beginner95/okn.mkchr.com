@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">
                        {{ trans('complex.edit') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('complex.update') }}/{{$okn->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('complex.name_ru') }}</label>
                                        <textarea
                                            name="okn-name"
                                            class="form-control"
                                            title="{{ trans('complex.name_ru') }}"
                                            required>{{ $okn->name }}
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('complex.name_chr') }}</label>
                                        <textarea
                                            name="okn-name-chr"
                                            class="form-control"
                                            title="{{ trans('complex.name_chr') }}">{{ $okn->name_chr }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="is-complex" value="1">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">{{ trans('complex.date') }}</label>
                                        <input
                                            type="text"
                                            name="date-okn"
                                            class="form-control"
                                            title="{{ trans('complex.date') }}"
                                            value="{{ $okn->date_okn }}">
                                    </div>
                                    <div class="col">
                                        <label for="origin">{{ trans('complex.act') }}</label>
                                        <input
                                            type="text"
                                            name="act"
                                            class="form-control"
                                            title="{{ trans('complex.act') }}"
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
                                        <label for="">{{ trans('complex.address') }}</label>
                                        <autocomplete-district></autocomplete-district>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('complex.additional_address') }}</label>
                                        <input
                                            type="text"
                                            name="address"
                                            class="form-control"
                                            title="{{ trans('complex.additional_address') }}"
                                            placeholder="{{ trans('complex.additional_address') }}"
                                            value="{{ $okn->address }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('complex.category') }}</label>
                                        <select name="category" id="" class="form-control" title="{{ trans('complex.category') }}">
                                            <option value="0" @if($okn->category === '0') selected @endif>{{ trans('complex.category_republic') }}</option>
                                            <option value="1" @if($okn->category === '1') selected @endif>{{ trans('complex.category_federal') }}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('complex.owner') }}</label>
                                        <select name="owner" id="" class="form-control" title="{{ trans('complex.owner') }}">
                                            <option value="0" @if($okn->owner === '0') selected @endif>{{ trans('complex.owner_republic') }}</option>
                                            <option value="1" @if($okn->owner === '1') selected @endif>{{ trans('complex.owner_federal') }}</option>
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
                                    class="btn btn-success">
                                    {{ trans('basic.add_file') }}
                                </a>
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

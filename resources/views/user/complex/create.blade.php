@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">{{ trans('complex.add') }}</div>
                    <div class="card-body">
                        <form action="{{ route('complex.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('complex.name_ru') }}</label>
                                        <textarea
                                            name="complex-name"
                                            class="form-control"
                                            title="{{ trans('complex.name_ru') }}"
                                            required>
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('complex.name_chr') }}</label>
                                        <textarea
                                            name="complex-name-chr"
                                            class="form-control"
                                            title="{{ trans('complex.name_chr') }}">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">{{ trans('complex.date') }}</label>
                                        <input type="text" name="date-complex" class="form-control" title="{{ trans('complex.date') }}">
                                    </div>
                                    <div class="col">
                                        <label for="origin">{{ trans('complex.act') }}</label>
                                        <input
                                            type="text"
                                            name="act"
                                            class="form-control"
                                            title="{{ trans('complex.act') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
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
                                            placeholder="{{ trans('complex.additional_address') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('complex.category') }}</label>
                                        <select name="category" id="" class="form-control" title="{{ trans('complex.category') }}">
                                            <option value="0">{{ trans('complex.category_republican') }}</option>
                                            <option value="1">{{ trans('complex.category_federal') }}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('complex.owner') }}</label>
                                        <select name="owner" id="" class="form-control" title="{{ trans('complex.owner') }}">
                                            <option value="0">{{ trans('complex.owner_republican') }}</option>
                                            <option value="1">{{ trans('complex.owner_federal') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ trans('basic.latitude') }}</label>
                                        <input name="latitude" class="form-control" title="{{ trans('basic.latitude') }}">
                                    </div>
                                    <div class="col">
                                        <label for="">{{ trans('basic.longitude') }}</label>
                                        <input type="text" name="longitude" class="form-control" title="{{ trans('basic.longitude') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{ trans('basic.comment') }}</label>
                                <textarea name="comment" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{ trans('basic.add_file') }}</label>
                                <input
                                    type="file"
                                    name="file"
                                    title="{{ trans('basic.supported_formats') }}"
                                    class="custom-file">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ trans('basic.add') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

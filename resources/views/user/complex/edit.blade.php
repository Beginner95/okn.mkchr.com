@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">
                        Добавление нового комплекса (ансамбля)
                    </div>
                    <div class="card-body">
                        <form action="{{ route('complex.update') }}/{{$okn->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">
                                            Наименование комплекса (ансамбля)
                                        </label>
                                        <textarea
                                            name="okn-name"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия (ОКН)"
                                            required>{{ $okn->name }}
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">
                                            Наименование комплекса (ансамбля) на чеченском языке
                                        </label>
                                        <textarea
                                            name="okn-name-chr"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия на чеченском языке">{{ $okn->name_chr }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="is-complex" value="1">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">
                                            Датировка ОКН комплекса (ансамбля)
                                        </label>
                                        <input
                                            type="text"
                                            name="date-okn"
                                            class="form-control"
                                            title="Датировка ОКН"
                                            value="{{ $okn->date_okn }}">
                                    </div>
                                    <div class="col">
                                        <label for="origin">Акт о постановке на гос. учет / о принятии на гос. охрану</label>
                                        <input
                                            type="text"
                                            name="act"
                                            class="form-control"
                                            title="Нормативный Акт о постановке на гос. учет // о принятии на гос. охрану"
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
                                        <label for="">Адрес</label>
                                        <autocomplete-district></autocomplete-district>
                                    </div>
                                    <div class="col">
                                        <label for="">Дополните адрес</label>
                                        <input
                                            type="text"
                                            name="address"
                                            class="form-control"
                                            title="Дополните адрес после района"
                                            placeholder="Дополните адрес после района"
                                            value="{{ $okn->address }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Категория историко-культурного значения</label>
                                        <select name="category" id="" class="form-control" title="Категория историко-культурного значения">
                                            <option value="0" @if($okn->category === '0') selected @endif>Республиканского значения</option>
                                            <option value="1" @if($okn->category === '1') selected @endif>Федерального значения</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Собственность ОКН (ФС/РС)</label>
                                        <select name="owner" id="" class="form-control" title="Собственность ОКН (ФС/РС)">
                                            <option value="0" @if($okn->owner === '0') selected @endif>Республиканского значения</option>
                                            <option value="1" @if($okn->owner === '1') selected @endif>Федерального значения</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Широта</label>
                                        <input
                                            name="latitude"
                                            class="form-control"
                                            title="Широта"
                                            value="{{ $okn->latitude }}">
                                    </div>
                                    <div class="col">
                                        <label for="">Долгота</label>
                                        <input
                                            type="text"
                                            name="longitude"
                                            class="form-control"
                                            title="Долгота"
                                            value="{{ $okn->longitude }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Примечание</label>
                                <textarea name="comment" class="form-control">{{ $okn->comment }}</textarea>
                            </div>
                            <div class="form-group">
                            @if (!empty($okn->file))
                                <input type="hidden" value="{{ $okn->file }}" id="fileName" name="file-name">
                                <a href="{{ '/files/' . $okn->file }}" class="btn btn-dark" v-if="!isVisibleFile">Скачать файл</a>
                                <a
                                    id="deleteFile"
                                    v-if="!isVisibleFile"
                                    href="#"
                                    class="btn btn-danger"
                                    @click="isVisibleFile = !isVisibleFile">
                                    Удалить файл
                                </a>
                            @else
                                <a
                                    href="#"
                                    v-if="!isVisibleFile"
                                    @click="isVisibleFile = !isVisibleFile"
                                    class="btn btn-success">
                                    Добавить файл
                                </a>
                            @endif
                            </div>
                            <div class="form-group" v-show="isVisibleFile">
                                <label for="">Приложить новый файл</label>
                                <input
                                    type="file"
                                    name="file"
                                    title="Поддерживаемые форматы файлов jpg, pdf, zip"
                                    class="custom-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

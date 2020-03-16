@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">
                        @if (!Request::is('complex/create'))
                            Добавление нового объекта
                        @else
                            Добавление нового комплекса (ансамбля)
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="/object-update/{{$okn->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">
                                            @if (!Request::is('complex/*'))
                                                Наименование ОКН
                                            @else
                                                Наименование (ансамбля)
                                            @endif
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
                                            @if (!Request::is('complex/*'))
                                                Наименование ОКН на чеченском языке
                                            @else
                                                Наименование комплекса (ансамбля) на чеченском языке
                                            @endif
                                        </label>
                                        <textarea
                                            name="okn-name-chr"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия на чеченском языке">{{ $okn->name_chr }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            @if (!Request::is('complex/*'))
                                <div class="form-group">
                                    <label for="complex_exist">Входит в состав ансамбля</label>
                                    <input
                                        @if (!empty($okn->complex_id))
                                            checked
                                        @endif
                                        type="checkbox"
                                        name="complex"
                                        id="complex_exist"
                                        @click="isVisible = !isVisible"
                                        title="Выберите если объект входит в комплекс (ансамбль)">
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
                                    <label for="">Выберите комплекс</label>
                                    <autocomplete-complex></autocomplete-complex>
                                </div>
                            @else
                                <input type="hidden" name="is-complex" value="1">
                            @endif

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">
                                            @if (!Request::is('complex/*'))
                                                Датировка ОКН
                                            @else
                                                Датировка ОКН комплекса (ансамбля)
                                            @endif
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
                            @if (!Request::is('complex/*'))
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Необходимо средств по сохранению</label>
                                            <input
                                                type="text"
                                                name="sum-npd"
                                                class="form-control"
                                                title="Средства, необходимые на проведение работ по сохранению ОКН по НПД (рублей)"
                                                value="{{ $okn->sum_npd }}">
                                        </div>
                                        <div class="col">
                                            <label for="">Дата начала работ по сохранению ОКН</label>
                                            <input
                                                type="date"
                                                name="start-job"
                                                class="form-control"
                                                title="Дата начала работ по сохранению ОКН"
                                                value="{{ \Carbon\Carbon::parse($okn->start_job)->format('Y-m-d') }}">
                                        </div>
                                        <div class="col">
                                            <label for="">Дата окончания работ по сохранению ОКН</label>
                                            <input
                                                type="date"
                                                name="end-job"
                                                class="form-control"
                                                title="Дата окончания работ по сохранению ОКН (Акт)"
                                                value="{{ \Carbon\Carbon::parse($okn->end_job)->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Источник финансирования</label>
                                            <input
                                                type="text"
                                                name="finance"
                                                class="form-control"
                                                title="Источник финансирования работ по сохранению ОКН"
                                                value="{{ $okn->finance }}">
                                        </div>
                                        <div class="col">
                                            <label for="">Наличие научно-проектной документации</label>
                                            <input
                                                type="text"
                                                name="npd"
                                                class="form-control"
                                                title="Наличие научно-проектной документации"
                                                value="{{ $okn->npd }}">
                                        </div>
                                        <div class="col">
                                            <label for="">
                                                @if (!Request::is('complex/*'))
                                                    Состояние ОКН
                                                @else
                                                    Состояние комплекса (ансамбля)
                                                @endif
                                            </label>
                                            <select name="state" id="" class="form-control" title="Состояние ОКН">
                                                <option value="0" @if($okn->state === '0') selected @endif>Неудовлетворительное</option>
                                                <option value="1" @if($okn->state === '1') selected @endif>Удовлетворительное</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Статус (Зарегистрирован/выявлен)</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0" @if($okn->status === '0') selected @endif>Выявлен</option>
                                        <option value="1" @if($okn->status === '1') selected @endif>Зарегистрирован</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Примечание</label>
                                <textarea name="comment" class="form-control">{{ $okn->comment }}</textarea>
                            </div>
                            <div class="form-group">
                            @if (!empty($okn->file))
                                <a href="{{ '/files/' . $okn->file }}" class="btn btn-dark" v-if="!isVisibleFile">Скачать файл</a>
                                <a
                                    v-if="!isVisibleFile"
                                    href="#"
                                    class="btn btn-danger"
                                    @click="isVisibleFile = !isVisibleFile">
                                    Удалить файл
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
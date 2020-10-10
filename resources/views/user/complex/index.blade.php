@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Фильтр
                    </div>
                    <div class="card-body">
                        <form action="/" method="get">
                        <span style="display: none">{{ csrf_token() }}</span>
                        <table class="table table-bordered" cellspacing="0">
                            <tr>
                                <th>Район</th>
                                <th>Категория историко-культурного значения</th>
                                <th>Собственность ОКН (ФС/РС)</th>
                                <th>Состояние ОКН</th>
                                <th>Статус (Зарегистрирован/выявлен)</th>
                            </tr>
                            <tr>
                                <td id="districtName" data-district-name="{{ Request::get('district') }}">
                                    <autocomplete-district></autocomplete-district>
                                </td>
                                <td>
                                    <select name="category" id="" class="form-control" title="Категория историко-культурного значения">
                                        <option value="">--Выбрать--</option>
                                        <option value="0" @if (Request::get('category') === '0') selected @endif>Республиканского значения</option>
                                        <option value="1" @if (Request::get('category') === '1') selected @endif>Федерального значения</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="owner" id="" class="form-control" title="Собственность ОКН (ФС/РС)">
                                        <option value="">--Выбрать--</option>
                                        <option value="0" @if (Request::get('owner') === '0') selected @endif>Республиканская собственность</option>
                                        <option value="1" @if (Request::get('owner') === '1') selected @endif>Федеральная собственность</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="state" id="" class="form-control" title="Состояние ОКН">
                                        <option value="">--Выбрать--</option>
                                        <option value="0" @if (Request::get('state') === '0') selected @endif>Неудовлетворительное</option>
                                        <option value="1" @if (Request::get('state') === '1') selected @endif>Удовлетворительное</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="status" id="" class="form-control" title="Статус (Зарегистрирован/выявлен)">
                                        <option value="">--Выбрать--</option>
                                        <option value="0" @if (Request::get('status') === '0') selected @endif>Выявлен</option>
                                        <option value="1" @if (Request::get('status') === '1') selected @endif>Зарегистрирован</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                            <div class="row">
                                <div class="col-sm-1">
                                    <select
                                        name="limit"
                                        class="form-control"
                                        title="Выберите количество на страницу">
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
                                    <button class="btn btn-primary pull-right">Отфильтровать</button>
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
                        Список комплексов
                        <a href="{{ route('complex.create') }}" class="btn btn-primary add-weight" title="Добавить объект">
                            <span>+</span>
                        </a>
                    </div>
                    @if (!empty($objects->toArray()['data']))
                        <div class="card-header">
                            <div class="btn-group-sm">
                                <button type="button" class="nav-link dropdown-toggle float-right btn btn-sm btn-primary" data-toggle="dropdown">Столбцы</button>
                                <div class="dropdown-menu headings"></div>
                            </div>
                            <div class="btn-group-sm">
                                <button type="button" id="downFont" class="btn btn-sm btn-outline-primary" title="Уменьшить шрифт">А-</button>
                                <button type="button" id="upFont" class="btn btn-sm btn-outline-primary" title="Увеличить шрифт">А+</button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        @if (empty($objects->toArray()['data']))
                            В базе нет ОКН!
                        @else
                            <table class="table table-bordered" id="dataTable">
                                <thead class="thead-light">
                                    <tr id="columns">
                                        <th scope="col">№</th>
                                        <th scope="col">Наименование комплекса (ансамбля)</th>
                                        <th scope="col">Наименование комплекса (ансамбля) на чеченском языке</th>
                                        <th scope="col">Датировка комплекса (ансамбля)</th>
                                        <th scope="col">Адрес (местоположение) комплекса (ансамбля)</th>
                                        <th scope="col">Нормативный Акт о постановке на гос. учет // о принятии на гос. охрану</th>
                                        <th scope="col">Категория историко-культурного значения</th>
                                        <th scope="col">Собственность ОКН (ФС/РС)</th>
                                        <th scope="col">Широта</th>
                                        <th scope="col">Долгота</th>

                                        <th scope="col">Примечание</th>
                                        <th scope="col">Файл</th>
                                        <th scope="col">Действие</th>
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
                                                <a href="{{ '/files/' . $object->file }}">Скачать</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                href="object/{{ $object->id}}/edit"
                                                title="Редактировать">
                                                <img src="/images/pencil.svg" width="15px">
                                            </a>
                                            <span
                                                style="cursor: pointer"
                                                title="Удалить"
                                                v-on:click="deleteObject({{ $object->id }})"
                                                onclick="return confirm('Удалить объект ОКН?');">
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

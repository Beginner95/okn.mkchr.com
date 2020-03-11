@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">Добавление нового объекта</div>
                    <div class="card-body">
                        <form action="/" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Наименование ОКН</label>
                                        <textarea
                                            name="okn-name"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия (ОКН)"
                                            required>
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">Наименование ОКН на чеченском языке</label>
                                        <textarea
                                            name="okn-name-chr"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия на чеченском языке">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="complex_exist">Входит в состав ансамбля</label>
                                <input
                                    type="checkbox"
                                    name="complex"
                                    id="complex_exist"
                                    @click="isVisible = !isVisible"
                                    title="Выберите если объект входит в комплекс (ансамбль)">
                            </div>

                            <div class="form-group" v-if="isVisible">
                                <label for="">Выберите комплекс</label>
                                <autocomplete-complex></autocomplete-complex>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">Датировка ОКН</label>
                                        <input type="text" name="date-okn" class="form-control" title="Датировка ОКН">
                                    </div>
                                    <div class="col">
                                        <label for="origin">Акт о постановке на гос. учет / о принятии на гос. охрану</label>
                                        <input
                                            type="text"
                                            name="act"
                                            class="form-control"
                                            title="Нормативный Акт о постановке на гос. учет // о принятии на гос. охрану">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
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
                                            placeholder="Дополните адрес после района">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Категория историко-культурного значения</label>
                                        <select name="category" id="" class="form-control" title="Категория историко-культурного значения">
                                            <option value="0">Республиканского значения</option>
                                            <option value="1">Федерального значения</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Собственность ОКН (ФС/РС)</label>
                                        <select name="owner" id="" class="form-control" title="Собственность ОКН (ФС/РС)">
                                            <option value="0">Республиканского значения</option>
                                            <option value="1">Федерального значения</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Широта</label>
                                        <input name="latitude" class="form-control" title="Широта">
                                    </div>
                                    <div class="col">
                                        <label for="">Долгота</label>
                                        <input type="text" name="longitude" class="form-control" title="Долгота">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Необходимо средств по сохранению</label>
                                        <input
                                            type="text"
                                            name="sum-npd"
                                            class="form-control"
                                            title="Средства, необходимые на проведение работ по сохранению ОКН по НПД (рублей)">
                                    </div>
                                    <div class="col">
                                        <label for="">Дата начала работ по сохранению ОКН</label>
                                        <input
                                            type="date"
                                            name="start-job"
                                            class="form-control"
                                            title="Дата начала работ по сохранению ОКН">
                                    </div>
                                    <div class="col">
                                        <label for="">Дата окончания работ по сохранению ОКН</label>
                                        <input
                                            type="date"
                                            name="end-job"
                                            class="form-control"
                                            title="Дата окончания работ по сохранению ОКН (Акт)">
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
                                            title="Источник финансирования работ по сохранению ОКН">
                                    </div>
                                    <div class="col">
                                        <label for="">Наличие научно-проектной документации</label>
                                        <input
                                            type="text"
                                            name="npd"
                                            class="form-control"
                                            title="Наличие научно-проектной документации">
                                    </div>
                                    <div class="col">
                                        <label for="">Состояние ОКН</label>
                                        <select name="state" id="" class="form-control" title="Состояние ОКН">
                                            <option value="0">Неудовлетворительное</option>
                                            <option value="1">Удовлетворительное</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Статус (Зарегистрирован/выявлен)</label>
                                <select name="status" id="" class="form-control">
                                    <option value="0">Выявлен</option>
                                    <option value="1">Зарегистрирован</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Примечание</label>
                                <textarea name="comment" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Приложить файл</label>
                                <input
                                    type="file"
                                    name="file"
                                    title="Поддерживаемые форматы файлов jpg, pdf, zip"
                                    class="custom-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
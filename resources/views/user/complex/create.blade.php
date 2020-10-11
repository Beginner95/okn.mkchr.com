@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">Добавление нового комплекса (ансамбля)</div>
                    <div class="card-body">
                        <form action="{{ route('complex.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Наименование комплекса (ансамбля)</label>
                                        <textarea
                                            name="complex-name"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия (ОКН)"
                                            required>
                                        </textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">Наименование комплекса (ансамбля) на чеченском языке</label>
                                        <textarea
                                            name="complex-name-chr"
                                            class="form-control"
                                            title="Наименование объекта культурного наследия на чеченском языке">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">Датировка ОКН комплекса (ансамбля)</label>
                                        <input type="text" name="date-complex" class="form-control" title="Датировка ОКН">
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
                                            <option value="0">Республиканская собственность</option>
                                            <option value="1">Федеральная собственность</option>
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

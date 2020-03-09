@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card block-weight">
                    <div class="card-header">Добавление нового объекта</div>
                    <div class="card-body">
                        <form action='store' method = 'post'>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="origin">Наименование ОКН</label>
                                        <textarea name="okn-name" class="form-control"></textarea>
                                    </div>
                                    <div class="col">
                                        <label for="destination">Наименование ОКН на чеченском языке</label>
                                        <textarea name="okn-name-chr" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="complex_exist">Входит в состав ансамбля</label>
                                <input type="checkbox" name="complex" id="complex_exist">
                            </div>

                            <div class="form-group complex-block disable-complex">
                                <label for="typeahead">Выберите комплекс</label>
                                <input type="text" id="typeahead" name="origin" class="form-control typeahead" required autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
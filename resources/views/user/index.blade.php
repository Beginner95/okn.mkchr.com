@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Список объектов 
                        <a href="{{ route('create') }}" class="btn btn-primary add-weight" title="Добавить объект"><span>+</span></a></div>
                    <div class="card-body">

                        @if (empty($objects->toArray()['data']))
                            В базе нет ОКН!
                        @else
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">№</th>
                                        <th scope="col">Наименование объекта культурного наследия (ОКН)</th>
                                        <th scope="col">Наименование объекта культурного наследия на чеченском языке</th>
                                        <th scope="col">Наименование историко-культурного комплекса (ансамбля)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach ($objects as $object)
                                    <tr>
                                        <td width="30" scope="row">{{ $i++ }}</td>
                                        <td width="150">{{ $object->name }}</td>
                                        <td width="150">{{ $object->name_chr }}</td>
                                        <td width="150">{{ $object->complex->name }}</td>
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
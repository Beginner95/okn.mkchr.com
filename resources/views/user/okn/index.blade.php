@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Список объектов 
                        <a href="{{ route('create') }}" class="btn btn-primary add-weight" title="Добавить объект">
                            <span>+</span>
                        </a>
                    </div>
                    <div class="card-body">

                        @if (empty($objects->toArray()['data']))
                            В базе нет ОКН!
                        @else
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">№</th>
                                        <th scope="col">Наименование объекта культурного наследия (ОКН)</th>
                                        <th scope="col">Наименование объекта культурного наследия на чеченском языке</th>
                                        <th scope="col">Наименование историко-культурного комплекса (ансамбля)</th>
                                        <th scope="col">Наименование историко-культурного комплекса (ансамбля) на чеченском языке</th>
                                        <th scope="col">Датировка ОКН</th>
                                        <th scope="col">Адрес (местоположение) ОКН</th>
                                        <th scope="col">Нормативный Акт о постановке на гос. учет // о принятии на гос. охрану</th>
                                        <th scope="col">Категория историко-культурного значения</th>
                                        <th scope="col">Собственность ОКН (ФС/РС)</th>
                                        <th scope="col">Широта</th>
                                        <th scope="col">Долгота</th>
                                        <th scope="col">Средства, необходимые на проведение работ по сохранению ОКН по НПД</th>
                                        <th scope="col">Дата начала работ по сохранению ОКН</th>
                                        <th scope="col">Дата окончания работ по сохранению ОКН (Акт)</th>
                                        <th scope="col">Источник финансирования работ по сохранению ОКН</th>
                                        <th scope="col">Наличие научно-проектной документации</th>
                                        <th scope="col">Состояние ОКН</th>
                                        <th scope="col">Статус (Зарегистрирован/выявлен)</th>
                                        <th scope="col">Примечание</th>
                                        <th scope="col">Файл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach ($objects as $object)
                                    <tr>
                                        <td width="30" scope="row">{{ $i++ }}</td>
                                        <td width="150">{{ $object->name }}</td>
                                        <td width="150">{{ $object->name_chr }}</td>
                                        <td width="150">{{ $object->complex['name'] }}</td>
                                        <td width="150">{{ $object->complex['name_chr'] }}</td>
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
                                                РЗ
                                            @else
                                                ФЗ
                                            @endif
                                        </td>
                                        <td>{{ $object->latitude }}</td>
                                        <td>{{ $object->longitude }}</td>
                                        <td>{{ $object->sum_npd }}</td>
                                        <td>{{ \Carbon\Carbon::parse($object->start_job)->format('d.m.Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($object->end_job)->format('d.m.Y') }}</td>
                                        <td>{{ $object->finance }}</td>
                                        <td>{{ $object->npd }}</td>
                                        <td>
                                            @if ($object->state === '0')
                                                Неудовлетворительное
                                            @else
                                                Удовлетворительное
                                            @endif
                                        </td>
                                        <td>
                                            @if ($object->status === '0')
                                                Выявлен
                                            @else
                                                Зарегистрирован
                                            @endif
                                        </td>
                                        <td>{{ $object->comment }}</td>
                                        <td>
                                            @if (!empty($object->file))
                                                <a href="{{ '/files/' . $object->file }}">Скачать</a>
                                            @endif
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
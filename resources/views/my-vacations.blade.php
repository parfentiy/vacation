
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <table style="border: 1px solid white; border-collapse: collapse">
                        <tr>
                            <th style="border: 1px solid; text-align: center;">ФИО сотрудника</th>
                            <th style="border: 1px solid; text-align: center;">Дата начала</th>
                            <th style="border: 1px solid; text-align: center; ">Дата окончания</th>
                            <th style="border: 1px solid; text-align: center; ">Подтвержден</th>
                            

                        </tr>
                        @foreach($myVacations as $myVacation)
                            <tr>
                                <form name="plan_vacation" method="post" action="{{route('update_vacation')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$myVacation['user_id']}}">
                                    <td style="border: 1px solid; text-align: center;">{{\App\Models\Vacation::find($myVacation['id'])->user->name}}</td>
                                    <td style="border: 1px solid; text-align: center;">
                                        <input type="date" name="start_date" value="{{$myVacation['start_date']}}">
                                    </td>
                                    <td style="border: 1px solid; text-align: center;">
                                        <input type="date" name="end_date" value="{{$myVacation['end_date']}}">
                                    </td>
                                    <td style="border: 1px solid; text-align: center;">
                                        @if (Auth::user()->is_admin)
                                            <select name="is_confirmed" id="is_confirmed">
                                                    @if ($myVacation['is_confirmed'])
                                                        <option value="true">Подтвердить</option>
                                                        <option value="false" selected>Отменить отпуск</option>
                                                    @else
                                                        <option value="true" selected>Подтвердить</option>
                                                        <option value="false">Отменить отпуск</option>
                                                    @endif
                                            </select>
                                        @else
                                            {{$myVacation['is_confirmed'] ? "Да" : "Нет"}}
                                        @endif
                                    </td>
                                        <td style="border: 1px solid; text-align: center;">
                                            <button class="btn btn-primary btn-sm" type="submit" name="vacation_id" value="{{$myVacation['id']}}">   Сохранить   </button>
                                        </td>
                                </form>
                                <form name="delete_vacation" method="post" action="{{route('delete_vacation')}}">
                                    <td style="border: 1px solid; text-align: center;">

                                            @csrf
                                            <button class="btn btn-primary btn-sm" type="submit" name="vacation_id" value="{{$myVacation['id']}}">Удалить</button>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach
                        <tr>
                            <form name="plan_vacation" method="post" action="{{route('plan_vacation')}}">
                                @csrf

                                <td class="p-2" style="border: 1px solid;">
                                </td>
                                <td class="p-2"  style="border: 1px solid;">
                                    <input type="date" name="start_date" required></button>
                                </td>
                                <td class="p-2" style="border: 1px solid;">
                                    <input type="date" name="end_date" required></button>
                                </td>
                                <td class="p-2" style="border: 1px solid;">
                                </td>
                                <td class="p-2" style="border: 1px solid;">
                                    <button type="submit" class="btn btn-primary btn-sm" name="user_id" value="{{Auth::user()->id}}">Запланировать отпуск</button>
                                </td>
                            </form>

                    </table>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>

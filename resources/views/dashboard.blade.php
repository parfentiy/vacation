@dump(Auth::user()->name)
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
                    <form name="plan_vacation" id="plan_vacations" method="post" enctype="multipart/form-data" action="{{route('plan_vacation')}}">
                    @csrf
                        <div class="form-group mt-3 text-center">
                            <input type="date" name="start_date" required></button>
                            <input type="date" name="end_date" required></button>

                            <button type="submit" class="btn btn-primary shadow-lg" name="user_id" value="{{Auth::user()->id}}">Запланировать новый отпуск</button>
                        </div>
                    </form>

                    <form name="vacations" id="vacations" method="post" enctype="multipart/form-data" action="{{route('show_vacations')}}">
                    @csrf
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary shadow-lg" name="showvacations" value="show">Посмотреть даты своих отпусков</button>
                        </div>
                    </form>

                    <form name="vacations" id="vacations" method="post" enctype="multipart/form-data" action="{{route('show_vacations')}}">
                    @csrf
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary shadow-lg" name="showvacations" value="show">Посмотреть даты отпусков всех сотрудников</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

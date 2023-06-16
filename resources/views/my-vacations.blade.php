
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                <table class="container d-flex flex-row justify-content-center" style="border: 1px solid white; border-collapse: collapse">
    <tr>
        <th style="border: 1px solid; text-align: center;">Заказ №</th>
        <th style="border: 1px solid; text-align: center;">Дата заказа</th>
        <th style="border: 1px solid; text-align: center; ">Оплачено клиентом</th>
        <th style="border: 1px solid; text-align: center; ">Оплачено Гене</th>
        <th style="border: 1px solid; text-align: center; ">Отгружено</th>
        <th style="border: 1px solid; text-align: center; ">Клиент</th>
        <th style="border: 1px solid; text-align: center; ">Сумма клиенту</th>
        <th style="border: 1px solid; text-align: center; ">Себест. заказа</th>
        <th style="border: 1px solid; text-align: center; ">Доход</th>
        <th style="border: 1px solid; text-align: center; ">Очки</th>

    </tr>
    @php
        $totalSold = 0;
        $totalCost = 0;
        $totalIncome = 0;
        $totalVP = 0;
    @endphp
    @foreach($orders as $order)
        <tr>
            <form name="edit_order" method="post" action="{{ url('/edit_order') }}">
                @csrf
                @php
                    $totalSold += $order['customerSum'];
                    $totalCost += $order['costSum'];
                    $totalIncome += round($order['income'], 2);
                    $totalVP += $order['vp_total'];
                @endphp
                <td style="border: 1px solid; text-align: center;">{{$order['id']}}</td>
                <td style="border: 1px solid; text-align: center;">{{!is_null($order['order_date']) ? date("d.m.Y", strtotime($order['order_date'])) : ""}}</td>
                <td style="border: 1px solid; text-align: center;">{{!is_null($order['paid_date']) ? date("d.m.Y", strtotime($order['paid_date'])) : ""}}</td>
                <td style="border: 1px solid; text-align: center;">{{!is_null($order['gena_date']) ? date("d.m.Y", strtotime($order['gena_date'])) : ""}}</td>
                <td style="border: 1px solid; text-align: center;">{{!is_null($order['ship_date']) ? date("d.m.Y", strtotime($order['ship_date'])) : ""}}</td>
                <td style="border: 1px solid; text-align: center;">{{$order['customer']}}</td>
                <td style="border: 1px solid; text-align: center;">{{$order['customerSum']}} р.</td>
                <td style="border: 1px solid; text-align: center;">{{$order['costSum']}} р.</td>
                <td style="border: 1px solid; text-align: center;">{{round($order['income'], 2)}} р.</td>
                <td style="border: 1px solid; text-align: center;">{{$order['vp_total']}}</td>

                <td style="border: 1px solid; text-align: center;">
                    <input type="hidden" name="period" value="{{$period}}">
                    <button class="btn btn-primary btn-sm" type="submit" name="edit" value="{{$order['id']}}">   Детали   </button>
                </td>
            </form>
            <form name="delete_order" method="post" action="{{ url('/delete_order') }}">
                <td style="border: 1px solid; text-align: center;">

                        @csrf
                        <input type="hidden" name="period" value="{{$period}}">
                        <button class="btn btn-primary btn-sm" type="submit" name="delete" value="{{$order['id']}}">Удалить</button>
                    </form>
                </td>
        </tr>
    @endforeach
    <tr>
        <td style="border: 1px solid; text-align: center;"></td>
        <td style="border: 1px solid; text-align: center;"><b>ИТОГО</b></td>
        <td style="border: 1px solid; text-align: center;"></td>
        <td style="border: 1px solid; text-align: center;"></td>
        <td style="border: 1px solid; text-align: center;"></td>
        <td style="border: 1px solid; text-align: center;"></td>
        <td style="border: 1px solid; text-align: center;"><b>{{$totalSold}} р.</b></td>
        <td style="border: 1px solid; text-align: center;"><b>{{$totalCost}} р.</b></td>
        <td style="border: 1px solid; text-align: center;"><b>{{$totalIncome}} р.</b></td>
        <td style="border: 1px solid; text-align: center;"><b>{{$totalVP}}</b></td>
    </tr>
    <tr>
        <form name="new_order" method="post" action="{{ url('add_order') }}">
            @csrf

            <td class="p-2" style="border: 1px solid;">

            </td>
            <td class="p-2"  style="border: 1px solid;">
                @php
                    $time=strtotime(now());
                    $day=date("d",$time);
                    $month=date("m",$time);
                    $year=date("Y",$time);
                @endphp
                <label for="order_date"></label>
                <input type="date" id="order_date" name="order_date"
                       value="{{$year}}-{{$month}}-{{$day}}" required>
            </td>
            <td class="p-2" style="border: 1px solid;">
            </td>
            <td class="p-2" style="border: 1px solid;">
            </td>
            <td class="p-2" style="border: 1px solid;">
                <select name="customer" id="customer">
                    @foreach($customers as $customer)
                        <option value="{{$customer['id']}}">{{$customer['name']}}</option>
                    @endforeach
                </select>
            </td>
            <td class="p-2" style="border: 1px solid;">
                <select name="pricelist" id="pricelist">
                    @foreach($pricelists as $pricelist)
                        <option value="{{$pricelist['id']}}">{{$pricelist['name']}}</option>
                    @endforeach
                </select>
            </td>
            <td class="p-2" style="border: 1px solid;">

            </td>
            <td class="p-2" style="border: 1px solid;">

            </td>
            <td class="p-2" style="border: 1px solid;">

            </td>

            <td class="p-2" style="border: 1px solid;">
                <button type="submit" class="btn btn-primary btn-sm" name="period" value="{{$period}}">+ заказ</button>
            </td>
        </form>

</table>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>

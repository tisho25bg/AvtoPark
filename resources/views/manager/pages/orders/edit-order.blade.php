
Skip to content
This repository

    Pull requests
    Issues
    Marketplace
    Explore

    @yuzdzhan

2
0

    0

tisho25bg/AvtoPark
Code
Issues 0
Pull requests 0
Projects 0
Wiki
Insights
AvtoPark/resources/views/manager/pages/orders/edit-order.blade.php
d3783ed a minute ago
@tisho25bg tisho25bg Манджа с грозде2
351 lines (318 sloc) 24.4 KB

@extends('manager.manager')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="width: 750px;">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Редактиране на поръчка</h4>
                            <p class="category">Форма за редактиране на съществуваща поръчка</p>
                        </div>
                        <div class="card-content">
                            <form method="POST">
                                {{ csrf_field() }}
                                @if($order->orderStatus->type == \App\OrderStatus::ORDER_STATUS_SENT || $order->orderStatus->type == \App\OrderStatus::ORDER_STATUS_CLOSED)
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="service">Услуга</label>
                                                <input type="text" class="form-control" name="service" id="service" value="{{$order->services->name}}" disabled>
                                             </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating" >
                                            <label  class="control-label" for="vehicle">Превозно средство</label>
                                            <input type="text" class="form-control" name="vehicle" id="vehicle" value="{{$order->vehicles->brand}} - {{$order->vehicles->regNumber}}" disabled>
                                        </div>
                                        {{--</div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<div class="form-group label-floating" >--}}
                                            {{--<label  class="control-label" for="driver">Шофьор</label>--}}
                                            {{--<input type="text" class="form-control" name="driver" id="driver" value="{{$order->driver->fullName}}" disabled>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="addressSending">Адрес на изпращане</label>
                                                <input type="text" step="0.01" class="form-control" name="addressSending" id="addressSending" value="{{$order->addressSending}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="addressReceiver">Адрес на получаване</label>
                                                <input type="text" class="form-control" name="addressReceiver" id="addressReceiver" value="{{$order->addressReceiver}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="kilometres">Разстояние в километри</label>
                                                <input type="number" class="form-control" name="kilometres" id="kilometres" value="{{$order->kilometres}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="  form-group label-floating {{$errors->has('orderEndDate') ? 'has-error' : ''}}">
                                                    <label>Дата на получаване на поръчката</label>
                                                    <input class="date form-control" type="text" name="orderEndDate" value="{{$vehicleReservation->orderEndDate}}" id="orderEndDate">
                                                    <span class="material-input"></span>
                                                    @if($errors->has('orderEndDate'))
                                                        <span class="danger">
                                                                {{$errors->first('orderEndDate')}}
                                                            </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="  form-group label-floating {{$errors->has('orderEndDate') ? 'has-error' : ''}}">
                                                        <label>Дата на получаване на поръчката</label>
                                                        <input class="date form-control" type="text" name="orderEndDate" value="{{$vehicleReservation->orderEndDate}}" id="orderEndDate">
                                                        <span class="material-input"></span>
                                                        @if($errors->has('orderEndDate'))
                                                            <span class="danger">
                                                            {{$errors->first('orderEndDate')}}
                                                        </span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label  class="control-label" for="price">Цена</label>
                                                <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{$order->price}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="manager_id">Приел поръчката</label>
                                                <input type="text" class="form-control" name="manager" id="manager_id" value="{{Auth::user()->fullName}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group label-floating" >
                                                <label  class="control-label" for="customer_id">Клиент</label>
                                                <input type="text" class="form-control" name="customer" id="customer_id" value="{{$order->customer->fullName}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating {{$errors->has('services') ? 'has-error' : ''}}">
                                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Вид на услугата" data-size="7" name="services_id" id="services">
                                                    <option value="">--Без избор--</option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $order->services_id }}"
                                                                @if($order->services_id == $service->id)
                                                                        selected = selected
                                                                @endif
                                                                data-minweight="{{$service->minWeight}}" data-maxweight="{{$service->maxWeight}}">
                                                            {{ $service->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('services'))
                                                    <span class="danger" style="margin-top: 7px;">
                                                         {{$errors->first('services')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating {{$errors->has('vehicle') ? 'has-error' : ''}}">
                                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Налични превозни средства" data-size="7" name="vehicle_id" id="vehicles">
                                                    <option value="">--Без избор--</option>
                                                    @foreach($freeVehicles as $result)
                                                        <option  value="{{ $result->id }}"
                                                                 @if($order->vehicle_id == $result->id)
                                                                         selected = selected
                                                                 @endif
                                                                 data-maxweight="{{$result->chargeWeight}}" data-driveLicenseNeeded="{{$result->driveLicenseNeed}}">
                                                            {{ $result->brand }} - Рег.Номер {{ $result->regNumber }} : {{$result->chargeWeight}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @if($errors->has('vehicle'))
                                                    <span class="danger" style="margin-top: 7px;">
                                                            {{$errors->first('vehicle')}}
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating {{$errors->has('driver') ? 'has-error' : ''}}" >
                                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Избор на Шофьор" data-size="7" name="driver_id" id="drivers">
                                                    <option value="">--Без избор--</option>
                                                    @foreach($drivers as $driver)
                                                        <option value="{{$driver->id}}"
                                                                @if($order->driver_id == $driver->id)
                                                                        selected=selected
                                                                @endif
                                                                data-driverdrivelicense="{{$driver->driveLicenseCategory}}">
                                                                {{$driver->fullName}} - Kатегория : {{$driver->driveLicenseCategory}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('driver'))
                                                    <span class="danger">
                                                        {{$errors->first('driver')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group label-floating {{$errors->has('addressSending') ? 'has-error' : ''}}" >
                                                <label  class="control-label" for="addressSending">Адрес на изпращане</label>
                                                <input type="text" step="0.01" class="form-control" name="addressSending" id="addressSending" value="{{$order->addressSending}}">

                                                @if($errors->has('addressSending'))
                                                    <span class="danger">
                                                {{$errors->first('addressSending')}}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating {{$errors->has('addressReceiver') ? 'has-error' : ''}}" >
                                                <label  class="control-label" for="addressReceiver">Адрес на получаване</label>
                                                <input type="text" class="form-control" name="addressReceiver" id="addressReceiver" value="{{$order->addressReceiver}}">

                                                @if($errors->has('addressReceiver'))
                                                    <span class="danger">
                                                {{$errors->first('addressReceiver')}}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating {{$errors->has('kilometres') ? 'has-error' : ''}}" >
                                                <label  class="control-label" for="kilometres">Разстояние в километри</label>
                                                <input type="number" class="form-control" name="kilometres" id="kilometres" value="{{$order->kilometres}}">

                                                @if($errors->has('kilometres'))
                                                    <span class="danger">
                                                        {{$errors->first('kilometres')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating {{$errors->has('price') ? 'has-error' : ''}}" >
                                                <label  class="control-label" for="price">Цена</label>
                                                <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{$order->price}}">

                                                @if($errors->has('price'))
                                                    <span class="danger">
                                                        {{$errors->first('price')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="  form-group label-floating {{$errors->has('orderDate') ? 'has-error' : ''}}">
                                                    <label>Дата на изпращане на поръчката</label>
                                                    <input class="date form-control" type="text" name="orderDate" value="{{$order->orderDate}}" id="datepicker">
                                                    <span class="material-input"></span>
                                                    @if($errors->has('orderDate'))
                                                        <span class="danger">
                                                            {{$errors->first('orderDate')}}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="  form-group label-floating {{$errors->has('orderEndDate') ? 'has-error' : ''}}">
                                                    <label>Дата за пристигане на поръчката </label>
                                                    <input class="date form-control" type="text" name="orderEndDate" value="{{$vehicleReservation->orderEndDate}}" id="orderEndDate">
                                                    <span class="material-input"></span>
                                                    @if($errors->has('orderEndDate'))
                                                        <span class="danger">
                                                        {{$errors->first('orderEndDate')}}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group label-floating {{$errors->has('manager_id') ? 'has-error' : ''}}" >
                                                    <label  class="control-label" for="manager_id">Приел поръчката</label>
                                                    <input type="text" class="form-control" name="manager" id="manager_id" value="{{Auth::user()->fullName}}" disabled>

                                                    @if($errors->has('manager_id'))
                                                        <span class="danger">
                                                    {{$errors->first('manager_id')}}
                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group label-floating {{$errors->has('customer_id') ? 'has-error' : ''}}" >
                                                    <label  class="control-label" for="customer_id">Клиент</label>
                                                    <input type="text" class="form-control" name="customer" id="customer_id" value="{{$order->customer->fullName}}" disabled>

                                                    @if($errors->has('customer_id'))
                                                        <span class="danger">
                                                    {{$errors->first('customer_id')}}
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="orvd" value="{{$order->id}}" />
                                    <button type="submit" class="btn btn-primary pull-right">Запази</button>
                                @endif
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //services
        $('#services').on('change', function(){
            var selected = $(this).find('option:selected');
            var minWeight = selected.data('minweight');
            var maxWeight = selected.data('maxweight');
            var optionIndexes = [];
            $('#vehicles option').hide();
            $('.dropdown-toggle[data-id="vehicles"]').next('.dropdown-menu').find('li').hide();
            $('#vehicles option').each(function(k, i){
                var vehicleMaxWeight = $(this).data('maxweight');
                if(vehicleMaxWeight >= minWeight && vehicleMaxWeight <= maxWeight){
                    $(this).show();
                    optionIndexes.push(k);
                }
            });
            optionIndexes.forEach(function(entry) {
                $('.dropdown-toggle[data-id="vehicles"]').next('.dropdown-menu').find('li:nth-child('+entry+')').show();
            });
        });
        $('#vehicles').on('change', function () {
            var selected = $(this).find('option:selected');
            var driveLicenseNeeded = selected.data('drivelicenseneeded');
            var optionIndexes = [];
            $('#drivers option').hide();
            $('.dropdown-toggle[data-id="drivers"]').next('.dropdown-menu').find('li').hide();
            $('#drivers option').each(function(k, i){
                var driverLicenseCategory = $(this).data('driverdrivelicense');
                var vehicleLicenseNeeded = $(this).data('driveLicenseNeeded');
                if(driverLicenseCategory == driveLicenseNeeded){
                    $(this).show();
                    optionIndexes.push(k);
                }
            });
            optionIndexes.forEach(function(entry) {
                $('.dropdown-toggle[data-id="drivers"]').next('.dropdown-menu').find('li:nth-child('+entry+')').show();
            });
        });
        //vehicles
        $('#services').change();
    </script>
@endsection

    © 2018 GitHub, Inc.
    Terms
    Privacy
    Security
    Status
    Help

    Contact GitHub
    API
    Training
    Shop
    Blog
    About


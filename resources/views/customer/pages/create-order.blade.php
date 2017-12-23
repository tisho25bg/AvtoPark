@extends('customer.customer')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Създаване на поръчка</h4>
                            <p class="category">Форма за създаване на нова поръчка</p>
                        </div>

                        <div class="card-content">
                            <form method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating {{$errors->has('services') ? 'has-error' : ''}}">
                                            <select class="selectpicker" data-style="btn btn-primary btn-round" title="Вид на услугата" data-size="{{count($services) + 1}}" name="services" id="services">
                                                <option value="">--Без избор--</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}"
                                                            data-minweight="{{$service->minWeight}}"
                                                            data-maxweight="{{$service->maxWeight}}"
                                                            data-priceperkilometer="{{$service->priceLoaded}}">>
                                                        {{ $service->name }} : от {{$service->minWeight}} до {{$service->maxWeight}}
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
                                </div>

                                <div id="map-holder"></div>
                                <div id="text-holder"></div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group label-floating {{$errors->has('addressSending') ? 'has-error' : ''}}" >
                                            <label for="addressSending">Адрес на изпращане</label>
                                            <input type="text"  class="form-control" name="addressSending" id="addressSending" required>

                                            @if($errors->has('addressSending'))
                                                <span class="danger">
											{{$errors->first('addressSending')}}
										</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating {{$errors->has('addressReceiver') ? 'has-error' : ''}}" >
                                            <label   for="addressReceiver">Адрес на получаване</label>
                                            <input type="text" class="form-control" name="addressReceiver" id="addressReceiver" required>

                                            @if($errors->has('addressReceiver'))
                                                <span class="danger">
											{{$errors->first('addressReceiver')}}
										</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating {{$errors->has('kilometres') ? 'has-error' : ''}}" >
                                            <label for="kilometres">Разстояние в километри</label>
                                            <input type="text" class="form-control" name="kilometres" id="kilometres" value="{{old('kilometres')}}">

                                            @if($errors->has('kilometres'))
                                                <span class="danger">
											        {{$errors->first('kilometres')}}
										        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating {{$errors->has('timeToArrive') ? 'has-error' : ''}}">

                                            <label for="time" > Време в минути</label>
                                            <input class="form-control" name="time" id="time" value="{{old('time')}}">
                                            @if($errors->has('timeToArrive'))
                                                <span class="danger">
										        	{{$errors->first('timeToArrive')}}
										        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group label-floating {{$errors->has('price') ? 'has-error' : ''}}" >
                                            <label for="price">Цена</label>
                                            <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{old('price')}}">

                                            @if($errors->has('price'))
                                                <span class="danger">
											{{$errors->first('price')}}
										</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating {{$errors->has('customer_id') ? 'has-error' : ''}}" >
                                            <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{Auth::user()->id}}">

                                            @if($errors->has('customer_id'))
                                                <span class="danger">
											{{$errors->first('customer_id')}}
										</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <form action="{{route('create-order')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="orderId" >
                                    <input type="submit" class="btn btn-primary btn-round" value="Подай заявка">
                                </form>
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
    @parent();



    <script type='text/javascript'>
        var onMapLoad = function () {
            var textHolderDomEl = document.getElementById('text-holder'),
                addressInputA   = document.getElementById('addressSending'),
                addressInputB   = document.getElementById('addressReceiver'),
                distanceInput   = document.getElementById('kilometres'),
                time            = document.getElementById('time'),
                price           = document.getElementById('price'),
                route = new routeControl({
                    mapDomEl: document.getElementById('map-holder'),
                    center: {
                        lat: 42.8489128, // Gabrovo, Bulgaria
                        lng: 25.255236
                    },
                    onRouteSuccess: function (routeData) {
                        var priceKm         = $('select#services option:selected').data('priceperkilometer');
                        addressInputA.value = routeData.addressA || "";
                        addressInputB.value = routeData.addressB || "";
                        distanceInput.value = parseInt(routeData.distanceInMeters.value / 1000, 10); // in km
                        time.value          = parseInt(routeData.timeInSeconds.value / 60, 10); // time in mins
                        price.value         = parseInt(routeData.distanceInMeters.value / 1000, 10) * priceKm;
                        textHolderDomEl.innerHTML = "";
                    },
                    onRouteFail: function () {
                        var html = [
                            "<p class='error'>Cannot calculate route.</p>",
                            "<p class='error'>Please select another points.</p>"
                        ].join('');

                        addressInputA.value = "";
                        addressInputB.value = "";
                        distanceInput.value = "";
                        textHolderDomEl.innerHTML = html;
                    }
                });

            var onAddressChange = function (pointIndex, event) {
                route.setAddress(event.target.value, pointIndex);
            }

            addressInputA.addEventListener('blur', onAddressChange.bind(null, route.pointIndexes.A));
            addressInputB.addEventListener('blur', onAddressChange.bind(null, route.pointIndexes.B));
        }
    </script>
    <style>
        #map-holder {
            height: 200px;
            width: 400px;
        }
    </style>
    <script type="text/javascript" src="{{ URL::asset('assets/js/routeControl.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=onMapLoad&region=BG&key=AIzaSyDJ8-74q6kLtxWZ5egVzUwVzwSkKQiGvzQ"></script>
@endsection
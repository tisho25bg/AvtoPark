@extends('manager.manager')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Добавяне на превозно средство</h4>
                            <p class="category">Тук е форма за създаване на нов превозни средства</p>
                        </div>
                        <div class="card-content">
                            <div class="card-content">
                                <form method="POST" action="create-vehicle">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group label-floating" {{$errors->has('brand') ? 'has-error' : ''}}>
                                                <label  class="control-label" for="brand">Марка</label>
                                                <input type="text" class="form-control" name="brand" id="name" value="{{old('brand')}}">

                                                @if($errors->has('brand'))
                                                    <span class="danger">
														{{$errors->first('brand')}}
													</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating" {{$errors->has('regNumber') ? 'has-error' : ''}}>
                                                <label class="control-label">Регистрационен номер</label>
                                                <input type="text" class="form-control" name="regNumber" value="{{old('regNumber')}}">

                                                @if($errors->has('regNumber'))
                                                    <span class="danger">
														{{$errors->first('regNumber')}}
													</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating"{{$errors->has('vehicle_engine') ? 'has-error' : ''}} >
                                                <label for="vehicle_engine">Тип на двигателя</label>
                                                <select name="vehicle_engine">
                                                    <option value="benz">Бензин</option>
                                                    <option value="dizel">Дизел</option>
                                                    <option value="agu">АГУ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group label-floating" {{$errors->has('vehicle_type') ? 'has-error' : ''}}>
                                                <label for="vehicle_type">Тип на МПС</label>
                                                <select  name="vehicle_type" id="vehicle_type" >
                                                    <option value="">--Без избор--</option>
                                                    @foreach($vehicleTypes as $vehicleType)
                                                        <option value="{{ $vehicleType->id }}" data-name="{{ $vehicleType->name }}">{{ $vehicleType->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group label-floating" {{$errors->has('vehicle_status') ? 'has-error' : ''}}>
                                                <label for="vehicle_status">Статус на МПС</label>
                                                <select  name="vehicle_status" id="vehicle_status" >
                                                    <option value="">--Без избор--</option>
                                                    @foreach($vehicleStatuses as $vehicleStatus)
                                                        <option value="{{ $vehicleStatus->id }}" data-name="{{ $vehicleStatus->name }}">{{ $vehicleStatus->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating" {{$errors->has('fuelConsumption') ? 'has-error' : ''}}>
                                                <label class="control-label">Разход на гориво</label>
                                                <input type="text" class="form-control" name="fuelConsumption" value="{{old('fuelConsumption')}}">

                                                @if($errors->has('fuelConsumption'))
                                                    <span class="danger">
														{{$errors->first('fuelConsumption')}}
													</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group label-floating" {{$errors->has('mileage') ? 'has-error' : ''}}>
                                                <label class="control-label">Изминати километри</label>
                                                <input type="text" class="form-control" name="mileage" value="{{old('mileage')}}">

                                                @if($errors->has('mileage'))
                                                    <span class="danger">
														{{$errors->first('mileage')}}
													</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group label-floating" {{$errors->has('chargeWeight') ? 'has-error' : ''}}>
                                                <label class="control-label">Полезен товар</label>
                                                <input type="text" class="form-control" name="chargeWeight" value="{{old('chargeWeight')}}">

                                                @if($errors->has('chargeWeight'))
                                                    <span class="danger">
														{{$errors->first('chargeWeight')}}
													</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating" {{$errors->has('insurance') ? 'has-error' : ''}}>
                                                    <label class="control-label">Гражданска Отговорност/изтича/</label>
                                                    <input type="date" class="form-control" name="insurance" value="{{old('insurance')}}">

                                                    @if($errors->has('insurance'))
                                                        <span class="danger">
														{{$errors->first('insurance')}}
													</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group label-floating" {{$errors->has('technicalReview') ? 'has-error' : ''}}>
                                                    <label class="control-label">Технически преглед/изтича/</label>
                                                    <input type="date" class="form-control" name="technicalReview" value="{{old('technicalReview')}}">

                                                    @if($errors->has('technicalReview'))
                                                        <span class="danger">
														{{$errors->first('technicalReview')}}
													</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                            </div>

                                     <br>

                                    <button type="submit" class="btn btn-primary pull-right">Добави</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#vehicle_type').on('change', function(){
            var type = $(this).find('option:selected').data('type');
            $('#'+type+'_only').css('display', 'block');
        });
    </script>

    <script>
        $('#vehicle_status').on('change', function(){
            var type = $(this).find('option:selected').data('type');
            $('#'+type+'_only').css('display', 'block');
        });
    </script>
@endsection
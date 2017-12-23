@extends('manager.manager')
@section('content')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel = "Stylesheet" type="text/css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<style>

	</style>
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
										<div class="form-group label-floating {{$errors->has('brand') ? 'has-error' : ''}}">
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
										<div class="form-group label-floating {{$errors->has('regNumber') ? 'has-error' : ''}}">
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
										<div class="form-group label-floating {{$errors->has('vehicle_engine') ? 'has-error' : ''}} ">
											<select class="selectpicker" data-style="btn btn-primary btn-round" title="Тип на двигателя" data-size="4" name="vehicle_engine" id="vehicle_engine">
												<option value="">--Без избор--</option>
												<option value="benz">Бензин</option>
												<option value="dizel">Дизел</option>
												<option value="agu">АГУ</option>
											</select>

											@if($errors->has('vehicle_engine'))
												<span class="danger mt5">
												{{$errors->first('vehicle_engine')}}
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group label-floating {{$errors->has('vehicle_type') ? 'has-error' : ''}}">
											<select class="selectpicker" data-style="btn btn-primary btn-round" title="Тип на МПС" data-size="{{count($vehicleTypes) + 1}}" name="vehicle_type" id="vehicle_type">
												<option value="">--Без избор--</option>
												@foreach($vehicleTypes as $vehicleType)
												<option value="{{ $vehicleType->id }}">{{ $vehicleType->type }}</option>
												@endforeach
											</select>
											@if($errors->has('vehicle_type'))
												<span class="danger mt5">
												{{$errors->first('vehicle_type')}}
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group label-floating {{$errors->has('vehicle_status_id') ? 'has-error' : ''}}">
											<select class="selectpicker" data-style="btn btn-primary btn-round" title="Статус на МПС" data-size="{{count($vehicleStatuses) + 1}}" name="vehicle_status_id" id="vehicle_status_id">
												<option value="">--Без избор--</option>
												@foreach($vehicleStatuses as $vehicleStatus)
												<option value="{{ $vehicleStatus->id }}">{{ $vehicleStatus->type }}</option>
												@endforeach
											</select>
											@if($errors->has('vehicle_status_id'))
												<span class="danger mt5">
												{{$errors->first('vehicle_status_id')}}
											</span>
											@endif
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-5">
										<div class="form-group label-floating {{$errors->has('driveLicenseNeed') ? 'has-error' : ''}}">
											<label class="control-label">Необходима шофьорска книжка</label>
											<input type="text" class="form-control" name="driveLicenseNeed" id="driveLicenseNeed" value="{{old('driveLicenseNeed')}}">

											@if($errors->has('driveLicenseNeed'))
												<span class="danger">
												{{$errors->first('driveLicenseNeed')}}
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group label-floating {{$errors->has('fuelConsumption') ? 'has-error' : ''}}">
											<label class="control-label">Разход на гориво</label>
											<input type="text" class="form-control" name="fuelConsumption" value="{{old('fuelConsumption')}}">

											@if($errors->has('fuelConsumption'))
											<span class="danger">
												{{$errors->first('fuelConsumption')}}
											</span>
											@endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating {{$errors->has('mileage') ? 'has-error' : ''}}">
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
										<div class="form-group label-floating {{$errors->has('chargeWeight') ? 'has-error' : ''}}">
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
									<div class="col-md-5">
										<div class="  form-group label-floating {{$errors->has('insurance') ? 'has-error' : ''}}">
											<label>Гражданска Отговорност/изтича/</label>

											<input class="date form-control" type="text" name="insurance" value="{{old('insurance')}}" id="insurance">
											<span class="material-input"></span>
											@if($errors->has('insurance'))
											<span class="danger">
												{{$errors->first('insurance')}}
											</span>
											@endif

										</div>
									</div>

									<div class="col-md-5">
										<div class=" form-group label-floating {{$errors->has('technicalReview') ? 'has-error' : ''}}">
											<label>Технически преглед/изтича/</label>
											<input class="date form-control" type="text" name="technicalReview" value="{{old('technicalReview')}}" id="review">

											@if($errors->has('technicalReview'))
											<span class="danger">
												{{$errors->first('technicalReview')}}
											</span>
											@endif
										</div>
									</div>
								</div>

						</div>


						{{----}}
						<button type="submit" class="btn btn-primary pull-right">Добави</button>
						</form>
						<div class="clearfix"></div>

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
		//from
        from =$('#insurance').datepicker({
		minDate: +1,

		onSelect: function (dateText) {

			var remove = new Date(dateText);
			remove.setDate(remove.getDate()+1);
            $('#review').datepicker({
	            minDate: remove,
        	    defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
            });
            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }
		}
        });

	</script>

	//to
	{{--<script >--}}
            {{--$('.date').datepicker({--}}
                {{--format: 'mm-dd-yyyy'--}}
            {{--});--}}
	{{--</script>--}}

	{{--<script>--}}
        {{--$( function() {--}}
            {{--var dateFormat = "mm/dd/yy",--}}
                {{--from = $( "#from" )--}}
                    {{--.datepicker({--}}
                        {{--defaultDate: "+1w",--}}
                        {{--changeMonth: true,--}}
                        {{--numberOfMonths: 3--}}
                    {{--})--}}
                    {{--.on( "change", function() {--}}
                        {{--to.datepicker( "option", "minDate", getDate( this ) );--}}
                    {{--}),--}}
                {{--to = $( "#to" ).datepicker({--}}
                    {{--defaultDate: "+1w",--}}
                    {{--changeMonth: true,--}}
                    {{--numberOfMonths: 3--}}
                {{--})--}}
                    {{--.on( "change", function() {--}}
                        {{--from.datepicker( "option", "maxDate", getDate( this ) );--}}
                    {{--});--}}

            {{--function getDate( element ) {--}}
                {{--var date;--}}
                {{--try {--}}
                    {{--date = $.datepicker.parseDate( dateFormat, element.value );--}}
                {{--} catch( error ) {--}}
                    {{--date = null;--}}
                {{--}--}}

                {{--return date;--}}
            {{--}--}}
        {{--} );--}}
	{{--</script>--}}

	<script>
        $(document).ready(function () {

            $(document).on('click','.create-order', function () {
                if (confirm('Сигурни ли сте?')) {
                    var orderId = $(this).data('order');
                    window.location = "/customer/calculate-order/" + orderId;
                }
            });
            $(document).on('click','.endOrder', function () {
                if (confirm('Сигурни ли сте?')) {
                    var orderId = $(this).data('order');
                    window.location = "/customer/create-order/" + orderId;
                }
            });
        });
	</script>

	{{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$("#dt1").datepicker({--}}
                {{--dateFormat: "dd-M-yy",--}}
                {{--minDate: 0,--}}
                {{--onSelect: function () {--}}

                    {{--$( function() {--}}
			{{--var dateFormat = "mm/dd/yy",--}}
			{{--from = $( "#insurance" )--}}
			{{--.datepicker({--}}
			{{--defaultDate: "+1w",--}}
			{{--changeMonth: true,--}}
			{{--numberOfMonths: 3--}}
			{{--})--}}
			{{--.on( "change", function() {--}}
			{{--to.datepicker( "option", "minDate", getDate( this ) );--}}
			{{--}),--}}
			{{--to = $( "#review" ).datepicker({--}}
			{{--defaultDate: "+1w",--}}
			{{--changeMonth: true,--}}
			{{--numberOfMonths: 3--}}
			{{--})--}}
			{{--.on( "change", function() {--}}
			{{--from.datepicker( "option", "maxDate", getDate( this ) );--}}
			{{--});--}}

			{{--function getDate( element ) {--}}
			{{--var date;--}}
			{{--try {--}}
			{{--date = $.datepicker.parseDate( dateFormat, element.value );--}}
			{{--} catch( error ) {--}}
			{{--date = null;--}}
			{{--}--}}

			{{--return date;--}}
	{{--}--}}
	{{--} );--}}
{{--</script>--}}

@endsection
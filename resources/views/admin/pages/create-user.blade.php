@extends('admin.admin')
@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header" data-background-color="purple">
							<h4 class="title">Create User</h4>
							<p class="category">Тук е форма за създаване на нов потребител</p>
						</div>
						<div class="card-content">

							<div class="card-content">
								{{--@if ($errors->any())--}}
								{{--<div class="alert alert-danger">--}}
								{{--<ul>--}}
								{{--@foreach ($errors->all() as $error)--}}
								{{--<li>{{ $error }}</li>--}}
								{{--@endforeach--}}
								{{--</ul>--}}
								{{--</div>--}}
								{{--@endif--}}
								<form method="POST">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-5">
											<div class="form-group label-floating" {{$errors->has('firstName') ? 'has-error' : ''}}>
												<label  class="control-label" for="firstName">Име</label>
												<input type="text" class="form-control" name="firstName" id="name" value="{{old('firstName')}}">

												@if($errors->has('firstName'))
													<span class="danger">
														{{$errors->first('firstName')}}
													</span>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating" {{$errors->has('lastName') ? 'has-error' : ''}}>
												<label class="control-label" for="lastName">Фамилия</label>
												<input type="text" class="form-control" name="lastName" value="{{old('lastName')}}">

												@if($errors->has('lastName'))
													<span class="danger">
														{{$errors->first('lastName')}}
													</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group label-floating" {{$errors->has('email') ? 'has-error' : ''}}>
												<label class="control-label" for="email">E-mail</label>
												<input type="email" class="form-control" name="email" value="{{old('email')}}">

												@if($errors->has('email'))
													<span class="danger">
														{{$errors->first('email')}}
													</span>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating" {{$errors->has('password') ? 'has-error' : ''}}>
												<label class="control-label">Password</label>
												<input type="password" class="form-control" name="password">

												@if($errors->has('password'))
													<span class="danger">
														{{$errors->first('password')}}
													</span>
												@endif
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-5">
											<div class="form-group label-floating" {{$errors->has('egn') ? 'has-error' : ''}}>
												<label class="control-label">ЕГН</label>
												<input type="text" class="form-control" name="egn" value="{{old('egn')}}">

												@if($errors->has('egn'))
													<span class="danger">
														{{$errors->first('egn')}}
													</span>
												@endif
											</div>
										</div>
									</div>

									<label for="role_id">Роля на потребител</label>
									<select  name="role_id" id="role_id" >
										<option value="">--Без избор--</option>
										@foreach($roles as $role)
											<option value="{{ $role->id }}" data-code="{{ $role->code }}">{{ $role->name }}</option>
										@endforeach
									</select>

									<div id="DRIVER_only" style="display: none;" class="hiddenfield">
										<label for="test1">Показва се само за шофьора</label>
										<label for="test1">Свидетелство за правоуправление</label>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group label-floating">
													<label class="control-label">Категория</label>
													<input type="text" class="form-control" name="category">
												</div>
											</div>

											<div class="row">
												<div class="col-md-5">
													<div class="form-group label-floating">
														<label class="control-label">Дата на изтичане</label>
														<input type="date" class="form-control" name="expired">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div id="MANAGER_only"  style="display: none;"  class="hiddenfield">
										<label for="test1">Показва се само за мениджър</label>

									</div>


									<div id="CUSTOMER_only"  style="display: none;"  class="hiddenfield">
										<label for="test1">Показва се само за клиенти</label>

									</div>

									<button type="submit" class="btn btn-primary pull-right">Create Profile</button>
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
        $('#role_id').on('change', function(){
            $('.hiddenfield').css('display', 'none')
            var code = $(this).find('option:selected').data('code');
            $('#'+code+'_only').css('display', 'block');
        });
	</script>
@endsection
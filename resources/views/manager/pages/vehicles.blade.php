@extends('manager.manager')
@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="purple">
						<i class="material-icons">assignment</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Всички потребители</h4>
						<div class="toolbar">
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th>Марка</th>
										<th>Номер</th>
										<th>Двигател</th>
										<th>Тип</th>
										<th>Статус</th>
										<th>Разход</th>
										<th>Километри</th>
										<th>Товар</th>
										<th>ГО/изтича/</th>
										<th>ТП/изтича/</th>
										<th class="disabled-sorting text-right">Действия</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Марка</th>
										<th>Регистрационен номер</th>
										<th>Тип на двигателя</th>
										<th>Тип на МПС</th>
										<th>Статус на МПС</th>
										<th>Разход на гориво</th>
										<th>Изминати километри</th>
										<th>Полезен товар</th>
										<th>Гражданска Отговорност/изтича/</th>
										<th>Технически преглед/изтича/</th>
										<th class="disabled-sorting text-right">Действия</th>
									</tr>
								</tfoot>
								<tbody>
									@foreach($vehicles as $vehicle)
									<tr>
										<td>{{$vehicle->brand}}</td>
										<td>{{$vehicle->regNumber}}</td>
										<td>{{$vehicle->fuelType}}</td>
										<td>{{$vehicle->vehicle_types->type}}</td>
										<td>{{$vehicle->status->type}}</td>
										<td>{{$vehicle->fuelConsumption}}</td>
										<td>{{$vehicle->mileage}}</td>
										<td>{{$vehicle->chargeWeight}}</td>
										<td>{{$vehicle->insurance}}</td>
										<td>{{$vehicle->technicalReview}}</td>
										<td class="text-right">
											<a title="Редактиране" data-id="{{$vehicle->id}}"  href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>
											<a title="Изтриване" data-id="{{$vehicle->id}}" href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- end content-->
				</div>
				<!--  end card  -->
			</div>
			<!-- end col-md-12 -->
		</div>
		<!-- end row -->
	</div>
</div>
</div>
@endsection
@section('scripts')
@parent();
<script>
	$(document).ready(function () {
		$('#datatables').DataTable({
			"pagingType": "full_numbers",
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			responsive: true,
			language: {
				"decimal": "",
				"emptyTable": "Няма информация за показване",
				"info": "От _START_ до _END_ от общо _TOTAL_ записа",
				"infoEmpty": "",
				"infoFiltered": "(филтрирано от общо _MAX_ записа)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Покажи _MENU_ записа",
				"loadingRecords": "Зареждане...",
				"processing": "Обработка...",
				"search": "Търсене:",
				"zeroRecords": "Няма съвпадения",
				"paginate": {
					"first": "Първа",
					"last": "Последна",
					"next": "следваща",
					"previous": "предишна"
				},
				"aria": {
					"sortAscending": ": сортиране низходящо",
					"sortDescending": ": сортиране възходящо"
				}
			}

		});

		$('.remove').on('click', function () {
			if (confirm('Сигурни ли сте?')) {
				var id = $(this).data('id');
				window.location = "/manager/delete-vehicle/" + id;
			}
		});

		$('.edit').on('click', function () {
			var id = $(this).data('id');
			window.location = "/manager/edit-vehicle/" + id;
		});

	});
</script>
@endsection
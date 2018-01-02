<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>Мениджър</title>

		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />


		<!-- Bootstrap core CSS     -->
		<link href="/css/bootstrap.min.css" rel="stylesheet" />

		<!--  Material Dashboard CSS    -->
		<link href="/css/material-dashboard.css" rel="stylesheet"/>


		<link href="/assets/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />

		<!--     Fonts and icons     -->
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

		<link href="/css/app.css" rel="stylesheet"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />
		{{--<link href="http://jqueryui-timepicker-addon/dist/jquery-ui-timepicker-addon.css" rel="stylesheet">--}}
	</head>

	<body>

		<div class="wrapper" data-color="purple">

			@include('manager.controls.side-bar')
			<div class="main-panel">
				@include('manager.controls.navigation')
				@yield('content')


			</div>


		</div>
	</body>


	<!--   Core JS Files   -->
	<script src="/assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/assets/js/bootstrap-notify.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.datatables.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.select-bootstrap.js" type="text/javascript"></script>
	<script src="/assets/js/material.min.js" type="text/javascript"></script>


	<script src="/assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>




	{{--<script type="text/javascript" src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-de.js"></script>--}}
	@yield('scripts')


	{{--<script type="text/javascript">--}}

{{--//        $('.date').datepicker({--}}
{{--//--}}
{{--//            format: 'mm-dd-yyyy'--}}
{{--//--}}
{{--//        });--}}
        {{--$('.datepicker').pickadate();--}}

	{{--</script>--}}
	<script>
		function showNotification(message, type) {
		$.notify({
		icon: "notifications",
				message: message

		}, {
		type: type,
				timer: 2000,
				placement: {
				from: 'top',
						align: 'right'
				}
		});
		}
		$().ready(function () {
		@if (session('alert-success'))
				showNotification('{{ session("alert-success") }}', 'success');
		@endif

				@if (session('alert-error'))
				showNotification('{{ session("alert-error") }}', 'error');
		@endif
		}
		);

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
	</script>

</html>

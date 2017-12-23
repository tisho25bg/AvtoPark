@extends('manager.manager')
@section('content')
<div class="content">
	<h4>Control Panel - Manager</h4>


	<div class="card card-stats">
		<div class="card-header" data-background-color="orange">
			<i class="material-icons">content_copy</i>
		</div>


		<div class="card-content">
			<p class="category">Used Space</p>
			<h3 class="title">49/50<small>GB</small></h3>
		</div>
		<div class="card-footer">
			<div class="stats">
				<i class="material-icons text-danger">warning</i> <a href="#pablo">Get More Space...</a>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-chart" data-background-color="orange">
				<div class="ct-chart" id="dailySalesChart"></div>
			</div>
			<div class="card-content">
				<h4 class="title">Daily Sales</h4>
				<p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> 55%  </span> increase in today sales.</p>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">access_time</i> updated 4 minutes ago
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@extends('layouts.dashboard')
@section('content')
<!-- Main Content -->
<div id="content">
	
	<!-- Topbar -->
	<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		
		<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
			<i class="fa fa-bars"></i>
		</button>
		
		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
			<!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
					<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
				</a>
				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Logout
					</a>
				</div>
			</li>
			
		</ul>
		
	</nav>
	<!-- End of Topbar -->
	
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add a New Game</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
        {!! Form::open(['action' => 'Dashboard\GameController@save', 'method' => 'POST', 'id' => 'addForm' ]) !!}
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tbody>
							<tr>
								<th>Team A</th>
								<td>
                    {!! Form::select('team_a_id', $teams_a, null, ['id' => 'teams_a', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
							</tr>
							<tr>
								<th>Team B</th>
								<td>
                    {!! Form::select('team_b_id', $teams_b, null, ['id' => 'teams_b', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
							</tr>
							<tr>
								<th>Channels</th>
								<td>{!! Form::select('channel_id_list[]', $channels, null, ['id' => 'channels', 'multiple' => 'multiple', 'class' => 'form-control', 'style' => 'width:100%']) !!}</td>
							</tr>
							<tr>
								<th>Competition</th>
								<td>
                    {!! Form::select('competition_id', $competitions, null, ['id' => 'competitions', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
							</tr>
							<tr>
								<th>Round</th>
								<td>
                {!! Form::text('round', '', ['id' => 'round', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
							</tr>
							<tr>
								<th>Location</th>
								<td>
                    {!! Form::select('location_id', $locations, null, ['id' => 'locations', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
							</tr>
							<tr>
								<th>Start Date</th>
								<td style="min-width:70%;">
								<div>
                {{ Form::input('dateTime-local', 'startDate', null, array('class' => 'form-control')) }}
                </div>
						</td>
					</tr>
					<tr>
						<th>End Date (If left NULL, this = Start Date +2 hours)</th>
						<td style="min-width:70%;">
							<div class="input-group">
              {{ Form::input('dateTime-local', 'endDate', null, array('class' => 'form-control')) }}
              </div>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<button type="submit" href="#" class="btn btn-success btn-icon-split" style="margin-bottom:20px;">
								<span class="icon text-white-50">
									<i class="fas fa-plus-square"></i>
								</span>
								<span class="text">Add</span>
							</button >
						</td>
					</tr>
				</tbody>
			</table>
			{!! Form::close() !!}

		</div>
	</div>
	
</div>

@endsection

@section('js')
<script>
    $('#teams_a').select2();
    $('#teams_b').select2();
    $('#channels').select2();
    $('#competitions').select2();
    $('#locations').select2();
    
</script>
@endsection
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
		<!-- Topbar Search -->
		<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
			<div class="input-group"> 
				<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search fa-sm"></i>
					</button>
				</div>
			</div>
		</form>
		
		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
			
			<!-- Nav Item - Search Dropdown (Visible Only XS) -->
			<li class="nav-item dropdown no-arrow d-sm-none">
				<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-search fa-fw"></i>
				</a>
			</li>
			
			
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
	    	{!! Form::open(['method' => 'POST', 'id' => 'addForm' ]) !!}
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tbody>
							<tr>
								<th>Team A (Auto-complete from available teams)</th>
								<td>
                  <input class="typeahead form-control" type="text">
                </td>
							</tr>
							<tr>
								<th>Team B (Auto-complete from available teams)</th>
								<td><input type="text" style="width:100%;"></td>
							</tr>
							<tr>
								<th>Channels (Auto-complete from available channels)</th>
								<td><input type="text" style="width:100%;"></td>
							</tr>
							<tr>
								<th>Competition (Auto-complete from available competitions)</th>
								<td><input type="text" style="width:100%;"></td>
							</tr>
							<tr>
								<th>Round</th>
								<td><input type="text" style="width:100%;"></td>
							</tr>
							<tr>
								<th>Location (Auto-complete from available locations)</th>
								<td><input type="text" style="width:100%;"></td>
							</tr>
							<tr>
								<th>Start Date</th>
								<td style="min-width:70%;">
								</div><input type='text' class="form-control" id='datetimepickerstart'/></div>
						</td>
					</tr>
					<tr>
						<th>End Date (If left NULL, this = Start Date +2 hours)</th>
						<td style="min-width:70%;">
							<div class="input-group"><input type='text' class="form-control" id='datetimepickerend'/></div>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<a href="#" class="btn btn-success btn-icon-split" style="margin-bottom:20px;">
								<span class="icon text-white-50">
									<i class="fas fa-plus-square"></i>
								</span>
								<span class="text">Add</span>
							</a>
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

<script type="text/javascript">
    var path = "{{ route('game_autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endsection
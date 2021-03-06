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
					<img class="img-profile rounded-circle" src="{{ asset('/dashboard/img/boss.png') }}">
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
		
		<a href="{{ url('manage/games/new') }}" class="btn btn-success btn-icon-split" style="margin-bottom:20px;">
			<span class="icon text-white-50">
				<i class="fas fa-plus-square"></i>
			</span>
			<span class="text">Add a Game</span>
		</a>	        
		
		
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
            <div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">All Games</h6>
			</div>
            <div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Status</th>
								<th>Channel(s)</th>
								<th>Team A</th>
								<th>Team B</th>
								<th>Competition</th>
								<th>Round</th>
								<th>Location</th>
								<th>Start date</th>
								<th>End date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Status</th>
								<th>Channel(s)</th>
								<th>Team A</th>
								<th>Team B</th>
								<th>Competition</th>
								<th>Round</th>
								<th>Location</th>
								<th>Start date</th>
								<th>End date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($games as $game)
							<tr id="game_{{$game->id}}">
								<td>{{$game->id}}</td>
								<td style="text-align:center;">
                  @if (in_array ($game->id, $games_with_a_game_now))
                  <i class="fas fa-circle" style="color:#e74a3b;"></i><br>On-Going
                  @elseif (in_array ($game->id, $games_with_a_game_completed))
                  <i class="fas fa-check-circle" style="color:#1cc88a;"></i><br>Completed
                  @else
                  <i class="fas fa-calendar" style="color:#f6c23e;"></i><br>Planned
                  @endif
                </td>
								<td>
                  @foreach($game->channels as $channel)
                    <a href="{{url('/channel/')}}/{{$channel->id}}"><i class="fas fa-tv"></i> {{$channel->name}}</a><br>
                  @endforeach
                </td>
								<td style="text-align:center;"><img width="60px" src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}"> <br>{{$game->teamA->name}}</td>
								<td style="text-align:center;"><img width="60px" src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}"><br> {{$game->teamB->name}}</td>
								<td style="text-align:center;"><img width="60px" src="{{url('/uploads/competitions')}}/{{$game->competition['logo']}}"><br>{{$game->competition['name']}}</td>
								<td>{{$game->round}}</td>
								<td style="text-align:center;"><img width="60px" src="{{url('/uploads/locations')}}/{{$game->location['image']}}"><br>{{$game->location['name']}}</td>
								<td>{{$game->start_date}}</td>
								<td>{{$game->end_date}}</td>
								<td> 
									<div class="text-center">
										<a href="{{url('manage/games/edit/'.$game->id)}}" class="btn btn-primary btn-icon-split">
											<span class="icon text-white-50">
												<i class="fas fa-edit"></i>
											</span>
										</a> 
									</div>
								</td>
								<td> 
									<div class="text-center">
										<a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#deleteModal" onclick="toggleDelete({{$game->id}})">
											<span class="icon text-white-50">
												<i class="fas fa-trash"></i>
											</span>
										</a> 
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	
	<!-- /.container-fluid -->
	
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelDelete()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Game?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirmDelete()">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelDelete()">Cancel</button>
      </div>
    </div>
  </div>
</div>

@section('js')
<script src="{{ asset('/dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/demo/datatables-demo.js') }}"></script>
<script>
  let toDelete = -1;
  function toggleDelete(id) {
    toDelete = id 
  }

  function confirmDelete () {
    $.ajax({
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
      },
      method: "POST",
      url: '/manage/game-delete',
      data: {
        id: toDelete
      },
      success: function (data) {
        document.querySelector(`#game_${toDelete}`).remove()
      },
      error: function (err) {
        alert('There was an error, please try later!')
      }
    })
  }
  function cancelDelete () {
    toDelete = -1
  }
</script>
@endsection
<!-- End of Main Content -->
@endsection
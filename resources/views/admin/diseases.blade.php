@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">Disease</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Disease</li>
								</ul>
							</div>
							<div class="col-sm-5 col">
								<a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">Add</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										

										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>Disease ID</th>
													<th>Disease Name</th>
													<th>Symptom A</th>
													<th>Symptom B</th>
													<th>Symptom C</th>
													<th>Symptom D</th>
													<th>Symptom E</th>
													
													<th class="text-right">Action</th>
												</tr>
										
											</thead>
										
											<tbody>				
												@foreach($location as $l)
												<tr>
													<td>{{$l->id}}</td>
													<td>{{$l->d_name}}</td>
													<td>{{$l->sym_a}}</td>
													<td>{{$l->sym_b}}</td>
													<td>{{$l->sym_c}}</td>
													<td>{{$l->sym_d}}</td>
													<td>{{$l->sym_e}}</td>
													
													
													
													
													<td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal" href="#edit_specialities_details{{$l->id}}">
																<i class="fe fe-pencil"></i> Edit
															</a>
							<a onclick="return confirm('Are you sure...?') "  href="{{route('del_disease',$l->id)}}" class="btn btn-sm bg-danger-light">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
													</td>
												</tr>
											
											


									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
			
			
			<!-- Edit Details Modal -->
			<div class="modal fade" id="edit_specialities_details{{$l->id}}" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Disease</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<form action="{{route('up_disease')}}"  method="post" enctype="multipart/form-data"> @csrf

								<input  name="id" type="number" hidden value="{{$l->id}}" class="form-control">

								<div class="row ">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Name</label>
											<input required="" name="d_name" type="text" value="{{$l->d_name}}" class="form-control">
										</div>
									</div>


									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom A</label>
											<input required=""  type="text" name="sym_a" value="{{$l->sym_a}}" class="form-control" >
										</div>
									</div>



									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom B</label>
											<input required=""  type="text" name="sym_b"  value="{{$l->sym_b}}"class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom C</label>
											<input required=""  type="text" name="sym_c" value="{{$l->sym_c}}" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom D</label>
											<input required=""  type="text" name="sym_d" value="{{$l->sym_d}}" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom E</label>
											<input required=""  type="text" name="sym_e" value="{{$l->sym_e}}" class="form-control" >
										</div>
									</div>
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Edit Details Modal -->

				@endforeach

											</tbody>
										</table>

										<!-- Add Modal -->
			<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Disease</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('add_disease')}}"  method="post" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Name</label>
											<input required="" name="d_name" type="text" class="form-control">
										</div>
									</div>

									

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom A</label>
											<input required=""  type="text" name="sym_a" class="form-control" >
										</div>
									</div>



									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom B</label>
											<input required=""  type="text" name="sym_b" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom C</label>
											<input required=""  type="text" name="sym_c" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom D</label>
											<input required=""  type="text" name="sym_d" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Symptom E</label>
											<input required=""  type="text" name="sym_e" class="form-control" >
										</div>
									</div>
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /ADD Modal -->
			

			
			
        </div>
		<!-- /Main Wrapper -->
@endsection
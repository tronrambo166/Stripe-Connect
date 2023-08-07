@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">Treatment</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Treatment</li>
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
													<th>Name</th>
													<th>Disease Id</th>
													<th>Disease Name</th>
													<th>Procedure Name</th>
													<th>Medication A</th>
													<th>Medication B</th>
													<th>Medication C</th>
													<th>Medication D</th>
													<th>Medication E</th>
													
													<th class="text-right">Action</th>
												</tr>
										
											</thead>
										
											<tbody>				
												@foreach($location as $l)
												<tr>
													<td>{{$l->t_name}}</td>
													<td>{{$l->disease_id}}</td>
													<td>{{$l->disease_name}}</td>
													<td>{{$l->procedure_name}}</td>
													<td>{{$l->medic_a}}</td>
													<td>{{$l->medic_b}}</td>
													<td>{{$l->medic_c}}</td>
													<td>{{$l->medic_d}}</td>
													<td>{{$l->medic_e}}</td>
													
													
													
													<td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal" href="#edit_specialities_details{{$l->id}}">
																<i class="fe fe-pencil"></i> Edit
															</a>
							<a onclick="return confirm('Are you sure...?') "  href="{{route('del_location',$l->id)}}" class="btn btn-sm bg-danger-light">
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
							<h5 class="modal-title">Edit Treatment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<form action="{{route('up_treatment')}}"  method="post" enctype="multipart/form-data"> 

								@csrf
								<input  name="id" type="number" hidden value="{{$l->id}}" class="form-control">

								<div class="row form-row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
										<label>Treatment Name</label>
										<input required="" name="t_name" type="text" value="{{$l->t_name}}" class="form-control">
										</div>
									</div>



									<div class="col-12 col-sm-6">
										<div class="form-group">
										<label>Disease Name</label>
										<select required="" type="text" name="disease_name" class="form-control">
											@foreach($diseases as $d)
										 <option @if($d->id == $l->disease_id) selected @endif value="{{$d->d_name}}">{{$d->d_name}}</option> @endforeach
										  </select>
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Procedure Name</label>

											<select required="" type="text" name="procedure_name" class="form-control">
											@foreach($procedure as $p)
										 <option @if($p->proc_name == $l->procedure_name) selected @endif value="{{$l->procedure_name}}">
										 	{{$l->procedure_name}}</option> @endforeach
										  </select>

										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication A</label>
											<input required=""  type="text" name="medic_a"value="{{$l->medic_a}}" class="form-control" >
										</div>
									</div>



									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication B</label>
											<input required=""  type="text" name="medic_b" value="{{$l->medic_b}}" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication C</label>
											<input required=""  type="text" name="medic_c" value="{{$l->medic_c}}" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication D</label>
											<input required=""  type="text" name="medic_d" value="{{$l->medic_d}}" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication E</label>
											<input required=""  type="text" name="medic_e" value="{{$l->medic_e}}" class="form-control" >
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
							<h5 class="modal-title">Add Treatment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('add_treatment')}}"  method="post" enctype="multipart/form-data">
								@csrf
								<div class="row form-row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Treatment Name</label>
											<input required="" name="t_name" type="text" class="form-control">
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Id</label>
											<input required=""  type="number" name="disease_id" class="form-control" >
										</div>
									</div>


									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Name</label>
											<input required=""  type="text" name="disease_name" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Procedure Name</label>
											<select required="" type="text" name="procedure_name" class="form-control">
											@foreach($procedure as $p)
										 <option value="{{$l->procedure_name}}">
										 	{{$l->procedure_name}}</option> @endforeach
										  </select>
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication A</label>
											<input required=""  type="text" name="medic_a" class="form-control" >
										</div>
									</div>



									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication B</label>
											<input required=""  type="text" name="medic_b" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication C</label>
											<input required=""  type="text" name="medic_c" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication D</label>
											<input required=""  type="text" name="medic_d" class="form-control" >
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medication E</label>
											<input required=""  type="text" name="medic_e" class="form-control" >
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
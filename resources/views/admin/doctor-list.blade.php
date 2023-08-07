@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">Doctors</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Doctors</li>
								</ul>
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
													<th>ID</th>	
													<th>Image</th>
													<th>First Name</th>	
													<th>Last Name</th>
													<th>Email</th>	
																								
													<th>Speciality 1</th>
													<th>Speciality 2</th>
													<th>Speciality 3</th>
													<th>License</th>
													<th>Address</th>
													<th>Phone</th>
													<th>Office</th>
	
												</tr>
										
											</thead>
										
											<tbody>				
												@foreach($doctor as $l)
												<tr>

													<td class="text-right">
														{{$l->id}}
													</td>



													<td>
													<h2 class="table-avatar">
															<a  class="avatar avatar-lg mr-2"><img width="60px" height="60px" class="avatar-img rounded-circle" src="../images/hcp/{{$l->image}}" alt="User Image"></a>
															
														</h2> </td>

															<td>{{$l->fname}}</td>
															<td>{{$l->lname}}</td>
															<td>{{$l->email }}</td>
															<td>{{$l->spc}}</td>
															<td>{{$l->spc1}}</td>
															<td>{{$l->spc2}}</td>
															<td>{{$l->license}}</td>
															<td>{{$l->address}}</td>
															<td>{{$l->phone}}</td>
															<td>{{$l->office}}</td>

													
													<!-- <td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal" href="#edit_specialities_details{{$l->id}}">
																<i class="fe fe-pencil"></i> Edit
															</a>
							<a onclick="return confirm('Are you sure...?') "  href="" class="btn btn-sm bg-danger-light">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
													</td> -->
												</tr>
													@endforeach
											</tbody>
										</table>
									
											
											


									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
			
			
		




@endsection
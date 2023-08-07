<!-- Sidebar -->
@if(Session::has('admin'))
<div class="sidebar mt-2" id="sidebar" style="background-color:#e6eaf19e;">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul class="text-dark">
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="{{ Request::is('admin/index_admin') ? 'active' : '' }}"> 
								<a class="text-dark" href="index_admin"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>


							
							<li  class="{{ Request::is('admin/procedures') ? 'active' : '' }}"> 
								<a class="text-dark" href="procedures"><i class="fe fe-users"></i> <span>Procedures</span></a>
							</li>

							<li  class="{{ Request::is('admin/diseases') ? 'active' : '' }}"> 
								<a class="text-dark" href="diseases"><i class=" fe fe-layout"></i> <span>Diseases</span></a>
							</li>

							<li  class="{{ Request::is('admin/treatments') ? 'active' : '' }}"> 
								<a class="text-dark" href="treatments"><i class=" fe fe-layout"></i> <span>Treatments</span></a>
							</li>


                         <!-- <li  class="{{ Request::is('admin/reports') ? 'active' : '' }}"> 
								<a class="text-dark" href="locations"><i class=" fe fe-layout"></i> <span>Lab Reports</span></a>
							</li> -->


							<li  class="{{ Request::is('admin/doctor-list') ? 'active' : '' }}"> 
								<a class="text-dark" href="doctor-list"><i class="fe fe-user-plus"></i> <span>Doctors</span></a>
							</li>

							<!-- <li  class="{{ Request::is('admin/patient-list') ? 'active' : '' }}"> 
								<a class="text-dark" href="patient-list"><i class="fe fe-user"></i> <span>Patients</span></a> 
							</li> -->

							
							

							
							
						<!--	<li  class="{{ Request::is('admin/reviews') ? 'active' : '' }}"> 
								<a href="reviews"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
							</li> -->

							
						</ul>
					</div>
                </div>
            </div>
            @endif
			<!-- /Sidebar -->
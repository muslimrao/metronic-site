<div class="d-flex flex-column flex-root">
			
			<div class="mb-0" id="home">
				
				<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(assets/media/svg/illustrations/landing.svg)">
					
					<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						
						<div class="container">
							
							<div class="d-flex align-items-center justify-content-between">
								
								<div class="d-flex align-items-center flex-equal">
									
									<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
										
										<span class="svg-icon svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
												<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
											</svg>
										</span>
										
									</button>
									
									
									<a href="../../demo2/dist/landing.html">
										<img alt="Logo" src="{{ asset( get_airline_DATA('logo') ) }}" class="logo-default h-25px h-lg-30px" />
										<img alt="Logo" src="{{ asset( get_airline_DATA('logo') ) }}" class="logo-sticky h-20px h-lg-25px" />
									</a>
									
								</div>
								
								
								<div class="d-lg-block" id="kt_header_nav_wrapper">
									<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
										
										<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
											
											<div class="menu-item">
												
												<a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Home</a>
												
											</div>
											
											
											<div class="menu-item">
												
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#how-it-works" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">How it Works</a>
												
											</div>
											
											
											<div class="menu-item">
												
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#achievements" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Achievements</a>
												
											</div>
											
											
											<div class="menu-item">
												
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#team" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Team</a>
												
											</div>
											
											
											<div class="menu-item">
												
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#portfolio" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Portfolio</a>
												
											</div>
											
											
											<div class="menu-item">
												
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#pricing" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Pricing</a>
												
											</div>
											
										</div>
										
									</div>
								</div>
								
								
								<div class="flex-equal text-end ms-1">
									@if (Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->check() )
										<a href="{{ url('/' . $admin_path) }}" class="btn btn-info mx-4">Dashboard</a>
										<a href="{{ route('get.Logout') }}" class="btn btn-danger">Logout</a>
									@else
										<a href="{{ route('domainuser.login') }}" class="btn btn-success">Login</a>
									@endif
								</div>
								
							</div>
							
						</div>
						
					</div>
					
					
					<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
						
						<div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
							
							<h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">Build An Outstanding Solutions
							<br />with
							<span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
								<span id="kt_landing_hero_text">The Best Theme Ever</span>
							</span></h1>
							
							
							<a href="{{ URL::to('/') }}" class="btn btn-primary">Try Metronic</a>
							
						</div>
						
						
						<div class="d-flex flex-center flex-wrap position-relative px-5">
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
								<img src="{{ asset('assets/media/svg/brand-logos/fujifilm.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
								<img src="{{ asset('assets/media/svg/brand-logos/vodafone.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
								<img src="{{ asset('assets/media/svg/brand-logos/kpmg.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
								<img src="{{ asset('assets/media/svg/brand-logos/nasa.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
								<img src="{{ asset('assets/media/svg/brand-logos/aspnetzero.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="AON - Empower Results">
								<img src="{{ asset('assets/media/svg/brand-logos/aon.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
								<img src="{{ asset('assets/media/svg/brand-logos/hp-3.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
							
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
								<img src="{{ asset('assets/media/svg/brand-logos/truman.svg') }}" class="mh-30px mh-lg-40px" alt="" />
							</div>
							
						</div>
						
					</div>
					
				</div>
				
				
				<div class="landing-curve landing-dark-color mb-10 mb-lg-20">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				
			</div>
			
			
			<div class="mb-n10 mb-lg-n20 z-index-2">
				
				<div class="container">
					
					<div class="text-center mb-17">
						
						<h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">How it Works</h3>
						
						
						<div class="fs-5 text-muted fw-bold">Save thousands to millions of bucks by using single tool
						<br />for different amazing and great useful admin</div>
						
					</div>
					
					
					<div class="row w-100 gy-10 mb-md-20">
						
						<div class="col-md-4 px-5">
							
							<div class="text-center mb-10 mb-md-0">
								
								<img src="{{ asset('assets/media/illustrations/sigma-1/2.png') }}" class="mh-125px mb-9" alt="" />
								
								
								<div class="d-flex flex-center mb-5">
									
									<span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">1</span>
									
									
									<div class="fs-5 fs-lg-3 fw-bolder text-dark">Jane Miller</div>
									
								</div>
								
								
								<div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
								<br />by using single tool for different
								<br />amazing and great</div>
								
							</div>
							
						</div>
						
						
						<div class="col-md-4 px-5">
							
							<div class="text-center mb-10 mb-md-0">
								
								<img src="{{ asset('assets/media/illustrations/sigma-1/8.png') }}" class="mh-125px mb-9" alt="" />
								
								
								<div class="d-flex flex-center mb-5">
									
									<span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">2</span>
									
									
									<div class="fs-5 fs-lg-3 fw-bolder text-dark">Setup Your App</div>
									
								</div>
								
								
								<div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
								<br />by using single tool for different
								<br />amazing and great</div>
								
							</div>
							
						</div>
						
						
						<div class="col-md-4 px-5">
							
							<div class="text-center mb-10 mb-md-0">
								
								<img src="{{ asset('assets/media/illustrations/sigma-1/12.png') }}" class="mh-125px mb-9" alt="" />
								
								
								<div class="d-flex flex-center mb-5">
									
									<span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">3</span>
									
									
									<div class="fs-5 fs-lg-3 fw-bolder text-dark">Enjoy Nautica App</div>
									
								</div>
								
								
								<div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
								<br />by using single tool for different
								<br />amazing and great</div>
								
							</div>
							
						</div>
						
					</div>
					
					
					<div class="tns tns-default">
						
						<div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1">
							
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="{{ asset('assets/media/product-demos/demo1.png') }}" class="card-rounded shadow mw-100" alt="" />
							</div>
							
							
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="{{ asset('assets/media/product-demos/demo2.png') }}" class="card-rounded shadow mw-100" alt="" />
							</div>
							
							
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="{{ asset('assets/media/product-demos/demo4.png') }}" class="card-rounded shadow mw-100" alt="" />
							</div>
							
							
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="{{ asset('assets/media/product-demos/demo5.png') }}" class="card-rounded shadow mw-100" alt="" />
							</div>
							
						</div>
						
						
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
							
							<span class="svg-icon svg-icon-3x">
								<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							
						</button>
						
						
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
							
							<span class="svg-icon svg-icon-3x">
								<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="black" />
								</svg>
							</span>
							
						</button>
						
					</div>
					
				</div>
				
			</div>
			
			
			<div class="mt-sm-n10">
				
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				
				
				<div class="pb-15 pt-18 landing-dark-bg">
					
					<div class="container">
						
						<div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
							
							<h3 class="fs-2hx text-white fw-bolder mb-5">We Make Things Better</h3>
							
							
							<div class="fs-5 text-gray-700 fw-bold">Save thousands to millions of bucks by using single tool
							<br />for different amazing and great useful admin</div>
							
						</div>
						
						
						<div class="d-flex flex-center">
							
							<div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
								
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
									
									
									<span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
											<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
											<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
											<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
										</svg>
									</span>
									
									
									
									<div class="mb-0">
										
										<div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="700" data-kt-countup-suffix="+">0</div>
										</div>
										
										
										<span class="text-gray-600 fw-bold fs-5 lh-0">Known Companies</span>
										
									</div>
									
								</div>
								
								
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
									
									
									<span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z" fill="black" />
											<path opacity="0.3" d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z" fill="black" />
											<path opacity="0.3" d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z" fill="black" />
										</svg>
									</span>
									
									
									
									<div class="mb-0">
										
										<div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="80" data-kt-countup-suffix="K+">0</div>
										</div>
										
										
										<span class="text-gray-600 fw-bold fs-5 lh-0">Statistic Reports</span>
										
									</div>
									
								</div>
								
								
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
									
									
									<span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
											<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
											<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
										</svg>
									</span>
									
									
									
									<div class="mb-0">
										
										<div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="35" data-kt-countup-suffix="M+">0</div>
										</div>
										
										
										<span class="text-gray-600 fw-bold fs-5 lh-0">Secure Payments</span>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
						
						<div class="fs-2 fw-bold text-muted text-center mb-3">
						<span class="fs-1 lh-1 text-gray-700">“</span>When you care about your topic, you’ll write about it in a
						<br />
						<span class="text-gray-700 me-1">more powerful</span>, emotionally expressive way
						<span class="fs-1 lh-1 text-gray-700">“</span></div>
						
						
						<div class="fs-2 fw-bold text-muted text-center">
							<a href="../../demo2/dist/account/security.html" class="link-primary fs-4 fw-bolder">Marcus Levy,</a>
							<span class="fs-4 fw-bolder text-gray-600">KeenThemes CEO</span>
						</div>
						
					</div>
					
				</div>
				
				
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				
			</div>
			
			
			<div class="py-10 py-lg-20">
				
				<div class="container">
					
					<div class="text-center mb-12">
						
						<h3 class="fs-2hx text-dark mb-5" id="team" data-kt-scroll-offset="{default: 100, lg: 150}">Our Great Team</h3>
						
						
						<div class="fs-5 text-muted fw-bold">It’s no doubt that when a development takes longer to complete, additional costs to
						<br />integrate and test each extra feature creeps up and haunts most of us.</div>
						
					</div>
					
					
					<div class="tns tns-default">
						
						<div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next" data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
							
							@foreach ($out_great_team->get() as $team)

								<div class="text-center">
									
									<div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" 
									style="background-image:url('{{ $team->user_image }}')"></div>
									
									
									<div class="mb-0">
										
										<a href="{{  route('pilot.view.view', array('pilot_id' => $team->id)) }}" class="text-dark fw-bolder text-hover-primary fs-3">{{ $team->full_name }}</a>
										
										
										<div class="text-muted fs-6 fw-bold mt-1">{{ $team->role_name }}</div>
										
									</div>
									
								</div>
								


							@endforeach

							

							
						</div>
						
						
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
							
							<span class="svg-icon svg-icon-3x">
								<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							
						</button>
						
						
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
							
							<span class="svg-icon svg-icon-3x">
								<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="black" />
								</svg>
							</span>
							
						</button>
						
					</div>
					
				</div>
				
			</div>
			
			
			<div class="mb-lg-n15 position-relative z-index-2">
				
				<div class="container">
					
					<div class="card" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
						
						<div class="card-body p-lg-20">
							
							<div class="text-center mb-5 mb-lg-10">
								
								<h3 class="fs-2hx text-dark mb-5" id="portfolio" data-kt-scroll-offset="{default: 100, lg: 150}">Our Projects</h3>
								
							</div>
							
							
							<div class="d-flex flex-center mb-5 mb-lg-15">
								
								<ul class="nav border-transparent flex-center fs-5 fw-bold">
									<li class="nav-item">
										<a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6 active" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_latest">Latest</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_web_design">Web Design</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_mobile_apps">Mobile Apps</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#" data-bs-toggle="tab" data-bs-target="#kt_landing_projects_development">Development</a>
									</li>
								</ul>
								
							</div>
							
							
							<div class="tab-content">
								
								<div class="tab-pane fade show active" id="kt_landing_projects_latest">
									
									<div class="row g-10">
										
										<div class="col-lg-6">
											
											<a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-23.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('assets/media/stock/600x600/img-23.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
										
										<div class="col-lg-6">
											
											<div class="row g-10 mb-10">
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-22.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-22.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-21.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('{{ asset('assets/media/stock/600x600/img-21.jpg') }}')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
											</div>
											
											
											<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('assets/media/stock/600x400/img-20.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-20.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
									</div>
									
								</div>
								
								
								<div class="tab-pane fade" id="kt_landing_projects_web_design">
									
									<div class="row g-10">
										
										<div class="col-lg-6">
											
											<a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-11.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('assets/media/stock/600x600/img-11.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
										
										<div class="col-lg-6">
											
											<div class="row g-10 mb-10">
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-12.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-12.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-21.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-21.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
											</div>
											
											
											<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x400/img-20.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-20.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
									</div>
									
								</div>
								
								
								<div class="tab-pane fade" id="kt_landing_projects_mobile_apps">
									
									<div class="row g-10">
										
										<div class="col-lg-6">
											
											<div class="row g-10 mb-10">
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-16.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-16.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-12.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-12.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
											</div>
											
											
											<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x400/img-15.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-15.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
										
										<div class="col-lg-6">
											
											<a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-23.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('assets/media/stock/600x600/img-23.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
									</div>
									
								</div>
								
								
								<div class="tab-pane fade" id="kt_landing_projects_development">
									
									<div class="row g-10">
										
										<div class="col-lg-6">
											
											<a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-15.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('assets/media/stock/600x600/img-15.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
										
										<div class="col-lg-6">
											
											<div class="row g-10 mb-10">
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-22.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-22.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
												
												<div class="col-lg-6">
													
													<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x600/img-21.jpg') }}">
														
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-21.jpg')"></div>
														
														
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-3x text-white"></i>
														</div>
														
													</a>
													
												</div>
												
											</div>
											
											
											<a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ asset('media/stock/600x400/img-14.jpg') }}">
												
												<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('assets/media/stock/600x600/img-14.jpg')"></div>
												
												
												<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
													<i class="bi bi-eye-fill fs-3x text-white"></i>
												</div>
												
											</a>
											
										</div>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			
			<div class="mt-sm-n20">
				
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				
				
				<div class="py-20 landing-dark-bg">
					
					<div class="container">
						
						<div class="d-flex flex-column container pt-lg-20">
							
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bolder text-white mb-5" id="pricing" data-kt-scroll-offset="{default: 100, lg: 150}">Clear Pricing Makes it Easy</h1>
								<div class="text-gray-600 fw-bold fs-5">Save thousands to millions of bucks by using single tool for different
								<br />amazing and outstanding cool and great useful admin</div>
							</div>
							
							
							<div class="text-center" id="kt_pricing">
								
								<div class="nav-group landing-dark-bg d-inline-flex mb-15" data-kt-buttons="true" style="border: 1px dashed #2B4666;">
									<a href="#" class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3 me-2 active" data-kt-plan="month">Monthly</a>
									<a href="#" class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3" data-kt-plan="annual">Annual</a>
								</div>
								
								
								<div class="row g-10">
									
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
												
												<div class="mb-7 text-center">
													
													<h1 class="text-dark mb-5 fw-boldest">Startup</h1>
													
													
													<div class="text-gray-400 fw-bold mb-5">Best Settings for Startups</div>
													
													
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bolder text-primary" data-kt-plan-price-month="99" data-kt-plan-price-annual="999">99</span>
														<span class="fs-7 fw-bold opacity-50" data-kt-plan-price-month="Mon" data-kt-plan-price-annual="Ann">/ Mon</span>
													</div>
													
												</div>
												
												
												<div class="w-100 mb-10">
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Up to 10 Active Users</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Up to 30 Project Integrations</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800">Keen Analytics Platform</span>
														
														<span class="svg-icon svg-icon-1">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
																<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800">Targets Timelines &amp; Files</span>
														
														<span class="svg-icon svg-icon-1">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
																<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack">
														<span class="fw-bold fs-6 text-gray-800">Unlimited Projects</span>
														
														<span class="svg-icon svg-icon-1">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
																<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
															</svg>
														</span>
														
													</div>
													
												</div>
												
												
												<a href="#" class="btn btn-primary">Select</a>
												
											</div>
											
										</div>
									</div>
									
									
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
												
												<div class="mb-7 text-center">
													
													<h1 class="text-white mb-5 fw-boldest">Business</h1>
													
													
													<div class="text-white opacity-75 fw-bold mb-5">Best Settings for Business</div>
													
													
													<div class="text-center">
														<span class="mb-2 text-white">$</span>
														<span class="fs-3x fw-bolder text-white" data-kt-plan-price-month="199" data-kt-plan-price-annual="1999">199</span>
														<span class="fs-7 fw-bold text-white opacity-75" data-kt-plan-price-month="Mon" data-kt-plan-price-annual="Ann">/ Mon</span>
													</div>
													
												</div>
												
												
												<div class="w-100 mb-10">
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Up to 10 Active Users</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Up to 30 Project Integrations</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Keen Analytics Platform</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Targets Timelines &amp; Files</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack">
														<span class="fw-bold fs-6 text-white opacity-75">Unlimited Projects</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
																<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
															</svg>
														</span>
														
													</div>
													
												</div>
												
												
												<a href="#" class="btn btn-color-primary btn-active-light-primary btn-light">Select</a>
												
											</div>
											
										</div>
									</div>
									
									
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
												
												<div class="mb-7 text-center">
													
													<h1 class="text-dark mb-5 fw-boldest">Enterprise</h1>
													
													
													<div class="text-gray-400 fw-bold mb-5">Best Settings for Enterprise</div>
													
													
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bolder text-primary" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">999</span>
														<span class="fs-7 fw-bold opacity-50" data-kt-plan-price-month="Mon" data-kt-plan-price-annual="Ann">/ Mon</span>
													</div>
													
												</div>
												
												
												<div class="w-100 mb-10">
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Up to 10 Active Users</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Up to 30 Project Integrations</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Keen Analytics Platform</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack mb-5">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Targets Timelines &amp; Files</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
													
													<div class="d-flex flex-stack">
														<span class="fw-bold fs-6 text-gray-800 text-start pe-3">Unlimited Projects</span>
														
														<span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
															</svg>
														</span>
														
													</div>
													
												</div>
												
												
												<a href="#" class="btn btn-primary">Select</a>
												
											</div>
											
										</div>
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
				
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				
			</div>
			
			
			<div class="mt-20 mb-n20 position-relative z-index-2">
				
				<div class="container">
					
					<div class="text-center mb-17">
						
						<h3 class="fs-2hx text-dark mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">What Our Clients Say</h3>
						
						
						<div class="fs-5 text-muted fw-bold">Save thousands to millions of bucks by using single tool
						<br />for different amazing and great useful admin</div>
						
					</div>
					
					
					<div class="row g-lg-10 mb-10 mb-lg-20">
						
						<div class="col-lg-4">
							
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								
								<div class="mb-7">
									
									<div class="rating mb-6">
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
									</div>
									
									
									<div class="fs-2 fw-bolder text-dark mb-3">This is by far the cleanest template
									<br />and the most well structured</div>
									
									
									<div class="text-gray-500 fw-bold fs-4">The most well thought out design theme I have ever used. The codes are up to tandard. The css styles are very clean. In fact the cleanest and the most up to standard I have ever seen.</div>
									
								</div>
								
								
								<div class="d-flex align-items-center">
									
									<div class="symbol symbol-circle symbol-50px me-5">
										<img src="{{ asset('assets/media/avatars/150-2.jpg') }}" class="" alt="" />
									</div>
									
									
									<div class="flex-grow-1">
										<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Paul Miles</a>
										<span class="text-muted d-block fw-bold">Development Lead</span>
									</div>
									
								</div>
								
							</div>
							
						</div>
						
						
						<div class="col-lg-4">
							
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								
								<div class="mb-7">
									
									<div class="rating mb-6">
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
									</div>
									
									
									<div class="fs-2 fw-bolder text-dark mb-3">This is by far the cleanest template
									<br />and the most well structured</div>
									
									
									<div class="text-gray-500 fw-bold fs-4">The most well thought out design theme I have ever used. The codes are up to tandard. The css styles are very clean. In fact the cleanest and the most up to standard I have ever seen.</div>
									
								</div>
								
								
								<div class="d-flex align-items-center">
									
									<div class="symbol symbol-circle symbol-50px me-5">
										<img src="{{ asset('assets/media/avatars/150-3.jpg') }}" class="" alt="" />
									</div>
									
									
									<div class="flex-grow-1">
										<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Janya Clebert</a>
										<span class="text-muted d-block fw-bold">Development Lead</span>
									</div>
									
								</div>
								
							</div>
							
						</div>
						
						
						<div class="col-lg-4">
							
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								
								<div class="mb-7">
									
									<div class="rating mb-6">
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="bi bi-star-fill fs-5"></i>
										</div>
									</div>
									
									
									<div class="fs-2 fw-bolder text-dark mb-3">This is by far the cleanest template
									<br />and the most well structured</div>
									
									
									<div class="text-gray-500 fw-bold fs-4">The most well thought out design theme I have ever used. The codes are up to tandard. The css styles are very clean. In fact the cleanest and the most up to standard I have ever seen.</div>
									
								</div>
								
								
								<div class="d-flex align-items-center">
									
									<div class="symbol symbol-circle symbol-50px me-5">
										<img src="{{ asset('assets/media/avatars/150-18.jpg') }}" class="" alt="" />
									</div>
									
									
									<div class="flex-grow-1">
										<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Steave Brown</a>
										<span class="text-muted d-block fw-bold">Development Lead</span>
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
					
					<div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13" style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
						
						<div class="my-2 me-5">
							
							<div class="fs-1 fs-lg-2qx fw-bolder text-white mb-2">Start With Metronic Today,
							<span class="fw-normal">Speed Up Development!</span></div>
							
							
							<div class="fs-6 fs-lg-5 text-white fw-bold opacity-75">Join over 100,000 Professionals Community to Stay Ahead</div>
							
						</div>
						
						
						<a href="https://1.envato.market/EA4JP" class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Purchase on Themeforest</a>
						
					</div>
					
				</div>
				
			</div>
			
			
			<div class="mb-0">
				
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000.svg') }}">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				
				
				<div class="landing-dark-bg pt-20">
					
					<div class="container">
						
						<div class="row py-10 py-lg-20">
							
							<div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
								
								<div class="rounded landing-dark-border p-9 mb-10">
									
									<h2 class="text-white">Would you need a Custom License?</h2>
									
									
									<span class="fw-normal fs-4 text-gray-700">Email us to
									<a href="https://keenthemes.com/support" class="text-white opacity-50 text-hover-primary">support@keenthemes.com</a></span>
									
								</div>
								
								
								<div class="rounded landing-dark-border p-9">
									
									<h2 class="text-white">How About a Custom Project?</h2>
									
									
									<span class="fw-normal fs-4 text-gray-700">Use Our Custom Development Service.
									<a href="../../demo2/dist/pages/profile/overview.html" class="text-white opacity-50 text-hover-primary">Click to Get a Quote</a></span>
									
								</div>
								
							</div>
							
							
							<div class="col-lg-6 ps-lg-16">
								
								<div class="d-flex justify-content-center">
									
									<div class="d-flex fw-bold flex-column me-20">
										
										<h4 class="fw-bolder text-gray-400 mb-6">More for Metronic</h4>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">FAQ</a>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Documentaions</a>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Video Tuts</a>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Changelog</a>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Github</a>
										
										
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5">Tutorials</a>
										
									</div>
									
									
									<div class="d-flex fw-bold flex-column ms-lg-20">
										
										<h4 class="fw-bolder text-gray-400 mb-6">Stay Connected</h4>
										
										
										<a href="#" class="mb-6">
											<img src="{{ asset('assets/media/svg/brand-logos/facebook-4.svg') }}" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Facebook</span>
										</a>
										
										
										<a href="#" class="mb-6">
											<img src="{{ asset('assets/media/svg/brand-logos/github.svg') }}" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Github</span>
										</a>
										
										
										<a href="#" class="mb-6">
											<img src="{{ asset('assets/media/svg/brand-logos/twitter.svg') }}" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Twitter</span>
										</a>
										
										
										<a href="#" class="mb-6">
											<img src="{{ asset('assets/media/svg/brand-logos/dribbble-icon-1.svg') }}" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Dribbble</span>
										</a>
										
										
										<a href="#" class="mb-6">
											<img src="{{ asset('assets/media/svg/brand-logos/instagram-2-1.svg') }}" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Instagram</span>
										</a>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
					
					<div class="landing-dark-separator"></div>
					
					
					<div class="container">
						
						<div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
							
							<div class="d-flex align-items-center order-2 order-md-1">
								
								<a href="../../demo2/dist/landing.html">
									<img alt="Logo" src="{{ asset( get_airline_DATA('logo') ) }}" class="h-15px h-md-20px" />
								</a>
								
								
								<span class="mx-5 fs-6 fw-bold text-gray-600 pt-1" href="https://keenthemes.com">© 2021 {{ get_airline_DATA('airline_name') }}</span>
								
							</div>
							
							
							<ul class="menu menu-gray-600 menu-hover-primary fw-bold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
								<li class="menu-item">
									<a href="{{ route('dashboard.view') }}" target="_blank" class="menu-link px-2">Dashboard</a>
								</li>
								<li class="menu-item mx-5">
									<a href="{{ route('about-us.view') }}" target="_blank" class="menu-link px-2">About Us</a>
								</li>
								<!-- <li class="menu-item">
									<a href="" target="_blank" class="menu-link px-2">Purchase</a>
								</li> -->
							</ul>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			
			<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
				
				<span class="svg-icon">
					<svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
						<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
					</svg>
				</span>
				
			</div>
			
		</div>
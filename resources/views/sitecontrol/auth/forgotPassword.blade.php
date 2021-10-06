<form method="post" class="form w-100" novalidate="novalidate" id="kt_password_reset_form">
							
							<div class="text-center mb-10">
								
								<h1 class="text-dark mb-3">Forgot Password ?</h1>
								
								
								<div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
								
							</div>
							
							
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-gray-900 fs-6">Email</label>


                                {!! Form::text ('email', GeneralHelper::set_value("email"), ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
                                {!! GeneralHelper::form_error($errors, 'email') !!}


								
							</div>
							
							
							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
									<span class="indicator-label">Submit</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<a href="{{ route('domainuser.login') }}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
							</div>
							
						</form>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	
	
	<script src="assets/js/custom/authentication/password-reset/password-reset.js"></script>
	
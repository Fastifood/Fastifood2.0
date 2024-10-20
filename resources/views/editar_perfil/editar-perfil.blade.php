@auth
@extends('layouts.layout')
@section('titulo-pagina', 'FastiFood - Perfil do Usuário')
@section('conteudo-principal')
	<div id="main-wrapper">
		@include('layouts.header')
		<div class="content-body">
            <!-- row -->
			<div class="container">
				<div class="row">
					<div class="col-xl-4">
						<div class="card h-auto">
							<div class="card-body">
								<div class="profile text-center">
									<h6>profile</h6>
									<div class= "setting-img mb-4">
										 <div class="avatar-upload ">
											<div class="avatar-preview">
												<div id="imagePreview" style="background-image: url(images/no-img-avatar.png);">
												</div>
											</div>
										</div>
									</div>
									<div>
										<h6>Jordan Nico</h6>
										<p>Web Designer</p>
									</div>
									<div class="row">
										<div class="col-xl-4 col-4  border-right">
											<div class="text-center ">
												<h4 class="mb-0">932</h4>
												<p class="mb-0">Finish</p>
											</div>
										</div>
										<div class="col-xl-4 col-4  border-right">
											<div class="text-center">
												<h4 class="mb-0">1932</h4>
												<p class="mb-0">Deliver</p>
											</div>
										</div>
										<div class="col-xl-4 col-4 border-right">
											<div class="text-center">
												<h4 class="mb-0">2332</h4>
												<p class="mb-0">Deliver</p>
											</div>
										</div>
									</div>
									 <div class="change-btn d-flex align-items-center justify-content-center mt-3">
										<input type='file' class="form-control ms-0"  id="imageUpload" accept=".png, .jpg, .jpeg" />
										<label for="imageUpload" class="dlab-upload">Choose File</label>
										<a href="javascript:void" class="btn remove-img ms-2">Remove</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8">
						<div class="card">
							<div class="card-body">
								<div class="bacic-info mb-3">
									<h4 class="mb-3">Basic info</h4>
									<div class="row">
										<div class="col-xl-6">
											<label  class="form-label">First name</label>
											<input type="text" class="form-control mb-3"  placeholder="Jordan Nico">
										</div>
										<div class="col-xl-6">
											<label  class="form-label">Last name</label>
											<input type="text" class="form-control mb-3"  placeholder="Jordan Nico">
										</div>
										<div class="col-xl-12">
											<label  class="form-label">Title</label>
											<input type="text" class="form-control mb-3"  placeholder="Enter your Title">
										</div>
										<div class="col-xl-12">
											<label  class="form-label">Email Address</label>
											<input type="email" class="form-control mb-3"  placeholder="ordanico@mail.com">
										</div>
									</div>
								</div>
								<div class="exernal-links mb-3">
									<h4 class="mb-3">External links</h4>
									<div class="row">
										<div class="col-xl-12">
											<label  class="form-label">Facebook URL</label>
											<input type="text" class="form-control mb-3"  placeholder="Past your link here">
										</div>
										<div class="col-xl-12">
											<label  class="form-label">Twitter URL</label>
											<input type="text" class="form-control mb-3"  placeholder="Past your link here">
										</div>
										<div class="col-xl-12">
											<label  class="form-label">Instagram URL</label>
											<input type="text" class="form-control mb-3"  placeholder="Past your link here">
										</div>
										<div class="col-xl-12">
											<label  class="form-label">Youtube Channel URL</label>
											<input type="text" class="form-control mb-3"  placeholder="Past your link here">
										</div>
									</div>
								</div>
								<div class="Security">
									<div class="d-flex align-items-center justify-content-between mb-3">
										<h4>Security</h4>
										<span class="badge badge-sm badge-primary c-pointer" id="ed-profile">Edit</span>
									</div>
									<div class="row">
										<div class="col-xl-12">
											<label  class="form-label">Passward</label>
											 <input type="password" class="form-control mb-3" placeholder="Enter Your Passward" id="password">

											<button class="btn btn-outline-primary float-end ms-3">Cancel</button>
											<button class="btn btn-primary float-end">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
		@include('layouts.footer')
	</div>
@endsection
@section('outros-scripts')
    {{-- <script src="./vendor/global/global.min.js"></script> --}}
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="./vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	<script src="./vendor/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="./js/custom.js"></script>
	<script src="./js/dlabnav-init.js"></script>
	<script src="./vendor/swiper/js/swiper-bundle.min.js"></script>
@endsection
@endauth

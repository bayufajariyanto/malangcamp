<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-11 col-lg-12">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block">
            <img class="p-0 col-12" src="<?= base_url('assets/img/outdoor1.jpg') ?>" alt="Login">
          </div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <form class="user" method="post" action="<?= base_url('auth') ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username ...">
                  <?= form_error('username', '<small class="text-danger pl-3">','</small>') ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                  <?= form_error('password', '<small class="text-danger pl-3">','</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Login
                </button>
                <!-- <hr> -->
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook 
                    </a> -->
              </form>
              <!-- <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
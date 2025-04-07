<section class="logins">
    <div class="container">
      <div class="inner">
        <div class="tab-wrapper">
          <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                Login
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
                Register
              </button>
            </li>
          </ul>

          <div class="tab-content" id="myTabsContent">
            <!-- Login Tab -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
              <form action="">
                <div class="form-group">
                  <label for="userEmail">Email</label>
                  <input type="email" name="userEmail">
                </div>
                <div class="form-group">
                  <label for="userPass">Password</label>
                  <input type="password" name="userPass">
                </div>
                <div class="form-btn">
                  <button type="submit">Login</button>
                </div>

                <div class="divider">
                  <span>OR</span>
                </div>

                <div class="social-login">
                  <button class="social-btn google">
                    <i class="fab fa-google"></i>
                  </button>
                  <button class="social-btn x">
                    <i class="fab fa-x-twitter"></i>
                  </button>
                  <button class="social-btn discord">
                    <i class="fab fa-discord"></i>
                  </button>
                </div>
              </form>
            </div>

            <!-- Register Tab -->
            <div class="tab-pane fade" id="tab2" role="tabpanel">
              <form action="">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userFname">First Name</label>
                      <input type="text" name="userFname">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userLname">Last Name</label>
                      <input type="text" name="userLname">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userName">Username</label>
                      <input type="text" name="userName">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userEmail">Email</label>
                      <input type="email" name="userEmail">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userPass">Password</label>
                      <input type="password" name="userPass">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userConfirmPass">Confirm Password</label>
                      <input type="password" name="userConfirmPass">
                    </div>
                  </div>
                </div>

                <div class="form-btn">
                  <button type="submit">Register</button>
                </div>

                <div class="divider">
                  <span>OR</span>
                </div>

                <div class="social-login">
                  <button class="social-btn google">
                    <i class="fab fa-google"></i>
                  </button>
                  <button class="social-btn x">
                    <i class="fab fa-x-twitter"></i>
                  </button>
                  <button class="social-btn discord">
                    <i class="fab fa-discord"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

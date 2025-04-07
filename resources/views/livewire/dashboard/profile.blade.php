<div class="profile">
    <div class="form-wrapper mx-auto">
      <h5 class="mb-4">Profile Form</h5>

      <form>
        <div class="mb-3">
          <label for="first-name" class="form-label">First name</label>
          <input type="text" class="form-control" id="first-name" placeholder="Enter first name" />
        </div>

        <div class="mb-3">
          <label for="last-name" class="form-label">Last name</label>
          <input type="text" class="form-control" id="last-name" placeholder="Enter last name" />
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter username" />
        </div>

        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dob" />
        </div>

        <div class="mb-4">
          <label class="form-label">Custom Image adding Input</label>
          <div class="file-upload-wrapper">
            <input type="file" id="profile-image" />
            <div class="custom-file-label">
              <i class="fas fa-upload"></i>
              <span id="file-name">Choose file</span>
            </div>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary btn-save">Save</button>
        </div>
      </form>
    </div>
  </div>

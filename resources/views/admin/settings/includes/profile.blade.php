<div class="tile">
    <form action="{{ route('admin.settings.user.update') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <h3 class="tile-title">Profile Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">First Name</label>
                <input
                    class="form-control @error('first_name') is-invalid @enderror"
                    type="text"
                    placeholder="Enter first name"
                    id="first_name"
                    name="first_name"
                    value="{{ Auth::user()->first_name }}"
                    required
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Last Name</label>
                <input
                    class="form-control @error('last_name') is-invalid @enderror"
                    type="text"
                    placeholder="Enter last name"
                    id="last_name"
                    name="last_name"
                    value="{{ Auth::user()->last_name }}"
                    required
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">Default Email Address</label>
                <input
                    class="form-control @error('email') is-invalid @enderror"
                    type="email"
                    placeholder="Default email address"
                    id="email"
                    name="email"
                    value="{{ Auth::user()->email }}"
                    disabled
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_code">Phone Number</label>
                <input
                    class="form-control @error('phonenumber') is-invalid @enderror"
                    type="number"
                    placeholder="Enter Phone Number"
                    id="phonenumber"
                    name="phonenumber"
                    value="{{ Auth::user()->phonenumber }}"
                    required
                />
            </div>

            <div class="form-group">
                <label class="control-label" for="currency_code">Profile Image</label>
                <input
                    class="form-control @error('profile_image') is-invalid @enderror"
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    required
                />
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update User Profile</button>
                </div>
            </div>
        </div>
    </form>
</div>

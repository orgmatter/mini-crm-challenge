<!-- App Dashboard Company Modal -->
<div class="modal fade app-dashboard-modal" id="company_form_modal_center" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content dashboard-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-center-title">Create Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-body-container">
                <div class="modal-body-cover">
                    <div class="body-form-cover">
                        <form id="company_body_form" method="POST" action="{{ route('dashboard.create.company') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="company_name">Name</label>
                                <input type="text" name="name" class="form-control company-inputs" id="company_name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_email">Email</label>
                                <input type="email" name="email" class="form-control company-inputs" id="company_email" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_password">Password</label>
                                <input type="password" name="password" class="form-control company-inputs" id="company_password" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_logo">Logo</label>
                                <input type="file" name="logo" class="form-control company-inputs" id="company_logo" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_url">Url</label>
                                <input type="text" name="url" class="form-control company-inputs" id="company_url" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_roles">Roles</label>
                                <select name="role" class="form-control company-inputs" id="company_roles" required>
                                    <option value="" selected>Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group company-btn-cover">
                                    <button type="submit" class="btn btn-primary company-btn" id="company_btn">Create Company</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer app-dashboard-modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
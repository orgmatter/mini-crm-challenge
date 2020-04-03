<!-- App Dashboard User Modal -->
<div class="modal fade app-dashboard-modal" id="user_form_modal_center" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dashboard-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-center-title">Create Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-body-container">
                <div class="modal-body-cover">
                    <div class="body-form-cover">
                        <form id="user_body_form" method="POST" action="{{ route('company.create.employee') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="user_name">Name</label>
                                <input type="text" name="name" class="form-control user-inputs" id="user_name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="user_email">Email</label>
                                <input type="email" name="email" class="form-control user-inputs" id="user_email" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="user_password">Password</label>
                                <input type="password" name="password" class="form-control user-inputs" id="user_password" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="user_roles">Roles</label>
                                <select name="role" class="form-control user-inputs" id="user_roles">
                                    <option value="" selected>Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group user-btn-cover">
                                    <button type="submit" class="btn btn-primary user-btn" id="user_btn">Create</button>
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
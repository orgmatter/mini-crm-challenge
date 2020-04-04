<!-- App Dashboard User Table Modal -->
<div class="modal fade app-dashboard-modal" id="user_table_modal_center" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content dashboard-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-center-title">View User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-body-container">
                <div class="modal-body-cover">
                    <div class="table-responsive body-form-cover">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row"></th>
                                        <td scope="col">{{ $user->name }}</td>
                                        <td scope="col">{{ $user->email }}</td>
                                        <td scope="col" colspan="2">
                                            <div class="btn-group btn-group-justified">
                                                <a href="{{ url('user/'.$user->id) }}" class="btn btn-primary delete-btn" id="user_delete_btn"
                                                onclick="e.preventDefault(); 
                                                        document.getElementById('delete_user_form').submit();">
                                                    Delete
                                                </a>
                                            </div>
                                            <form method="POST" id="delete_user_form" action="{{ url('user/'.$user->id) }}">
                                                @csrf 
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer app-dashboard-modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
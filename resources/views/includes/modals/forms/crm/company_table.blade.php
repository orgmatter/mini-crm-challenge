
<!-- App Dashboard User Table Modal -->
<div class="modal fade app-dashboard-modal" id="company_table_modal_center" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content dashboard-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-center-title">View Companies</h5>
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
                                    <th scope="col">Logo</th>
                                    <th scope="col">Url</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <th scope="row"></th>
                                        <td scope="col">{{ $company->name }}</td>
                                        <td scope="col">{{ $company->email }}</td>
                                        <td scope="col">
                                            <div class="company-logo-cover-flex">
                                                <div class="company-logo-cover-item">
                                                    <img class="img img-fluid company-logo-img" src="{{ asset('storage/images/'.$company->logo) }}" />
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="col">{{ $company->url }}</td>
                                        <td scope="col" colspan="2">
                                            <div class="btn-group btn-group-justified">
                                                <a href="{{ url('company/'.$company->id) }}" class="btn btn-primary delete-btn" id="company_delete_btn" 
                                                    onclick="e.preventDefault(); 
                                                        document.getElementById('delete_company_form').submit();">
                                                    Delete
                                                </a>
                                            </div>
                                            <form method="POST" id="delete_company_form" action="{{ url('company/'.$company->id) }}">
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
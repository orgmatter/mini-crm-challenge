@extends('layouts.company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $role_name }} Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @employeeFormModal(['roles' => $roles])

                    @if(session('create_alert_message'))
                        @companyCreateAlertModal(['create_alert_message' => session('create_alert_message')])
                    @endif
                    <div class="dashboard-tab-container">
                        <div class="dashboard-tab-cover">
                            <!-- <div class="tablink-cover-flex">
                                <div class="tablink-cover-item">
                                    <a href="#create">Create
                                </div>
                                <div class="tablink-cover-item"></div>
                            </div> -->


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="true">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="views-tab" data-toggle="tab" href="#views" role="tab" aria-controls="views" aria-selected="false">Views</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="tablink-content-cover" id="tablink-content-cover-profile"></div>
                                </div>
                                <div class="tab-pane fade show active" id="create" role="tabpanel" aria-labelledby="create-tab">
                                    <div class="tablink-content-cover company-tablink-content-cover" id="company-tablink-content-cover-create">
                                        <div class="content-cover-create-flex">
                                            <div class="content-cover-create-item">
                                                <div class="create-btn-cover"> 
                                                    <a href="#" class="btn btn-default create-btn" data-toggle="modal" data-target="#user_form_modal_center">+ Create Employee</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="views" role="tabpanel" aria-labelledby="views-tab">
                                    <div class="tablink-content-cover" id="tablink-content-cover-views"></div>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                    <div class="tablink-content-cover" id="tablink-content-cover-settings"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

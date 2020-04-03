@extends('layouts.employee')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('create_alert_message'))
                        @createAlertModal(['create_alert_message' => session('create_alert_message')])
                    @endif
                    <div class="dashboard-company-tab-container">
                        <div class="dashboard-company-tab-cover">
                            <!-- <div class="tablink-cover-flex">
                                <div class="tablink-cover-item">
                                    <a href="#create">Create
                                </div>
                                <div class="tablink-cover-item"></div>
                            </div> -->


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="views-tab" data-toggle="tab" href="#views" role="tab" aria-controls="views" aria-selected="false">Views</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="tablink-content-cover" id="tablink-content-cover-profile"></div>
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

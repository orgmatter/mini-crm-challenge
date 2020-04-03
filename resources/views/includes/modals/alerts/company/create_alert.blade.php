<!-- App Dashboard Employee Modal -->
<div class="modal fade app-dashboard-modal" id="create_employee_alert_modal_center" tabindex="-1" role="dialog" aria-labelledby="create-employee-modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id=""role="document">
        <div class="modal-content dashboard-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-employee-modal-center-title">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-body-container">
                <div class="modal-body-cover">
                    @isset ($create_alert_message)
                        <p class="modal-body-p">{{ $create_alert_message }}</p>
                    @endisset
                </div>
            </div>
            <div class="modal-footer app-dashboard-modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal assign inventory -->
<div class="modal fade" id="modal-assign-inventory-group">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="overlay-assign-inventory-group" hidden="hidden">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Accept Assign Inventory Group</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="{{ $route_accept_assign_inventory_group }}" notification="{{ route('notification.assign-inventory-group') }}" id="form-assign-inventory-group">
                <div class="modal-body">
                    <div id="form-assign-inventory-group-js"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="btn-decline-assign-inventory-group" url="{{ $route_decline_assign_inventory_group }}" notification="{{ route('notification.assign-inventory-group') }}">Decline</button>
                    <button type="submit" class="btn btn-info" id="btn-submit-assign-inventory-group">Accept !</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal assign -->

<!-- modal assign -->
<div class="modal fade" id="modal-assign">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="overlay-assign" hidden="hidden">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Assign User {{ $title }}{{ $subtitle ? ' - '.$subtitle : '' }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="{{ $route_assign }}" id="form-assign">
                <div class="modal-body">
                    <div id="form-assign-js"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="btn-unassign" url="{{ $route_unassign }}">Un-assign</button>
                    <button type="submit" class="btn btn-info" id="btn-submit-assign">Assign !</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal assign -->

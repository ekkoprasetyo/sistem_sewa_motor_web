<!-- modal permission -->
<div class="modal fade" id="modal-permission">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="overlay-permission" hidden="hidden">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            <form class="form-horizontal" method="post" action="{{ $route }}" id="form-permission">
                <div class="modal-header">
                    <h4 class="modal-title">Edit {{ $title }}{{ $subtitle ? ' - '.$subtitle : '' }} Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="form-permission-js"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn-submit-permission">Save !</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal permission -->

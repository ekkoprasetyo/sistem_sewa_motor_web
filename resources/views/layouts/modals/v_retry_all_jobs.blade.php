<!-- modal retry alll jobs -->
<div class="modal fade" id="modal-retry-all-jobs">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="overlay-retry-all-jobs" hidden="hidden">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            <form class="form-horizontal" method="post" action="{{ $route }}" id="form-retry-all-jobs">
                <div class="modal-header">
                    <h4 class="modal-title">Retry All Jobs {{ $title }}{{ $subtitle ? ' - '.$subtitle : '' }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Are you sure want to retry all failed jobs ?</h3>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn-submit-retry-all-jobs">Retry All Jobs !</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal retry-all-jobs -->

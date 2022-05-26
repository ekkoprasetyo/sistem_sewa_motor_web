<!-- modal retry job -->
<div class="modal fade" id="modal-retry-job">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="overlay-retry-job" hidden="hidden">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Retry Job {{ $title }}{{ $subtitle ? ' - '.$subtitle : '' }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="{{ $route }}" id="form-retry-job">
                <div class="modal-body">
                    <div id="form-retry-job-js"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btn-submit-retry-job">Retry Job !</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal retry-job -->

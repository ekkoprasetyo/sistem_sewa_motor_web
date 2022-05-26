@csrf
<div class="card-body">
    <div class="form-group row">
        <input type="text" value="{{$failed_jobs->uuid}}" name="txt_failed_jobs_uuid" hidden="hidden">
        <label class="col-sm-3 col-form-label">UUID</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" value="{{$failed_jobs->uuid}}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Connection</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{$failed_jobs->connection}}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Queue</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{$failed_jobs->queue}}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Payload</label>
        <div class="col-sm-9">
            <textarea class="form-control is-warning" rows="5" disabled>{{ $failed_jobs->payload }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Exception</label>
        <div class="col-sm-9">
            <textarea class="form-control is-warning" rows="8" disabled>{{ $failed_jobs->exception }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Failed At</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ DateTimeHelper::FullTimeFormat($failed_jobs->failed_at) }}" readonly>
        </div>
    </div>
</div>

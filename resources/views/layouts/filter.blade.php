<!-- modal trigger filter button -->
<button type="button" data-toggle="modal" data-target="#assignModal" class="btn btn-dark ml-1">
    <i class="fa fa-filter"></i> {{  __('Filter') }}
</button>
<!-- end -->
<!-- dynamic modal create -->
<!-- Modal -->
<div class="modal rightModal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="uv-filter-head">
                <div class="uv-filter-title">
                    <h6>{{ __('Filter') }}</h6>
                </div>

                <div class="uv-filter-toggle" id="filter-close-trigger" data-dismiss="modal">
                    <span></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for=""></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->
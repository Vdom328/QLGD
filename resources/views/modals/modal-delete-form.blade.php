{!! Form::open(['url' => $url, 'id' => 'frmDelete', 'class' => '']) !!}
{!! Form::hidden('_method', 'DELETE') !!}
<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Confirm Delete
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Delete this user?</p>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> いいえ', [
                    'class' => 'btn btn-outline pull-left btn-light',
                    'type' => 'button',
                    'data-bs-dismiss' => 'modal',
                ]) !!}
                {!! Form::button('<i class="fa fa-fw fa-trash" aria-hidden="true"></i> はい', [
                    'class' => 'btn btn-danger pull-right',
                    'type' => 'button',
                    'id' => 'confirm',
                ]) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

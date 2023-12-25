<div class="modal fade" id="staffCalendarForm" role="dialog" data-submit="" aria-labelledby="staffCalendarFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          {{ trans('forms.calendar_day_off_title') }}
        </h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <x-textarea label="{{trans('forms.calendar_reason')}}" name="reason" placeholder="{{trans('forms.calendar_reason')}}" />
      </div>
      <div class="modal-footer">
        {{-- {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.form_modal_default_btn_cancel'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-bs-dismiss' => 'modal' )) !!} --}}
        {!! Form::button('<i class="fa fa-fw fa-trash" aria-hidden="true"></i> ' . trans('forms.calendar_button_delete'), array('class' => 'btn btn-danger d-none', 'type' => 'button', 'id' => 'modal-delete' )) !!}
        {!! Form::button('<i class="fa fa-fw fa-check" aria-hidden="true"></i> ' . trans('forms.calendar_button_confirm'), array('class' => 'btn btn-primary btn-thefarm-default rounded', 'type' => 'button', 'id' => 'confirm' )) !!}
      </div>
    </div>
  </div>
</div>

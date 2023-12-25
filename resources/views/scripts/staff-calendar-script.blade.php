<script>
    function showModalStaff(eventId, currentValue, dateStr) {
        var staffId = $('#staff-info').data('staff');
        var modal = $('#staffCalendarForm');
        if (eventId != undefined && eventId != '') {
            modal.find('#modal-delete').removeClass('d-none');
            modal.find('.modal-footer #modal-delete').data('form', $('#remove-dayoff').data('action'));
        } else {
            modal.find('#modal-delete').addClass('d-none');
        }
        modal.find('textarea[name="reason"]').val(currentValue);
        modal.find('.modal-footer #confirm').removeClass('sk-btn-disable');
        modal.find('.modal-footer #confirm').data('form', $('#store-dayoff').data('action'));
        modal.data('date', dateStr);
        modal.data('staff-id', staffId);
        modal.data('event-id', eventId);
        modal.modal('show');
    }


    $('#staffCalendarForm').find('.modal-footer #confirm').on('click', function() {
        $(this).addClass('sk-btn-disable');
        var modal = $('#staffCalendarForm');
        var reason = modal.find('textarea[name="reason"]').val();
        var date = modal.data('date');
        var staff_id = modal.data('staff-id');
        var event_id = modal.data('event-id');

        $.ajax({
            type:'POST',
            url : $(this).data('form'),
            data: {
                'event_id': event_id,
                'staff_id': staff_id,
                'date': date,
                'reason': reason
            }
        }).done(function (result) {
            if (result.is_update) {
                editEvent(result.id, result.title, result.backgroundColor);
            } else {
                addEvent(result)
            }
            
            $('#staffCalendarForm').modal('hide');
        }).fail(function (e) {
            alert('dayoff could not be loaded.');
        });
    });

    $('#staffCalendarForm').find('.modal-footer #modal-delete').on('click', function() {
        var modal = $('#staffCalendarForm');
        var date = modal.data('date');
        var staff_id = modal.data('staff-id');
        $.ajax({
            type:'DELETE',
            url : $(this).data('form'),
            data: {
                'staff_id': staff_id,
                'date': date
            }
        }).done(function (result) {
            if (result.id !== undefined) {
                removeEvent(result.id);
            }
            $('#staffCalendarForm').modal('hide');
        }).fail(function (e) {
            alert('dayoff could not be deleted.');
        });
    });

    function editEvent(eventId, title, color) {
        event = calendar.getEventById(eventId);
        event.setProp('title', title);
        event.setProp('backgroundColor', color);
        event.setProp('borderColor', color);
    }

    function addEvent(options) {
        calendar.addEvent({
            id: options.id,
            title: options.title,
            start: options.start,
            end: options.end,
            borderColor: options.borderColor,
            backgroundColor: options.backgroundColor,
            allDay: true
        });
    }

    function removeEvent(eventId) {
        event = calendar.getEventById(eventId);
        event.remove();
    }
</script>

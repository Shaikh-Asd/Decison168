var base_url = 'http://localhost/decision168/';
$(document).ready(function(){

///ADD NEW EVENT START///
$(".create-category").unbind('submit').on('submit', function (e){  
	//debugger;       
    e.preventDefault(); // Stop page from refreshing
    var createEventForm = $(".create-category");
    var input_allday = createEventForm.find("input[name=event_allDay]");
    var ip_sedate = createEventForm.find("input[name=event_start_date_nn]").val()+' - '+createEventForm.find("input[name=event_end_date_nn]").val();
    //console.log("ip_sedate");
    //console.log(ip_sedate);

    var event_repeat_option_value = createEventForm.find("#event_repeat_option").val();
    var input_dd = ip_sedate.split(' - ');

    var input_sdate=input_dd[0];
    var input_edate=input_dd[1];
    // console.log("input_sdate");
    // console.log(input_sdate);
    // console.log("input_edate");
    // console.log(input_edate);

    var start = new Date(input_sdate),
    end   = new Date(input_edate),
    diff  = new Date(end - start),
    days  = diff/1000/60/60/24;
    //console.log(days);
    if(days<= -1)
    {
        createEventForm.find('#event_start_end_dateErr').html('Please select correct date range');
        return false;
    }
    if(event_repeat_option_value == "Custom"){ 
    //var custom_check_val =$this.$categoryForm.find("input[name=custom_check[]]").val();
    var formDataa = new FormData(this);
    if(formDataa.get("custom_check[]")){
    }else{
        createEventForm.find('#custom_checkErr').html('Please select days');
        return false;
    }
        var start = new Date(input_sdate),
        end   = new Date(input_edate),
        diff  = new Date(end - start),
        days  = diff/1000/60/60/24;
        if(days<= 5){
        // $this.$categoryForm.find('#event_start_end_dateErr').html('Please select at least 7 days ');
        // return false;
        if($('input[name="custom_check[]"]:checked').length <=2){
            createEventForm.find('#custom_checkErr').html('Please select at least 3 days');
            return false;
        }
        }else{
            createEventForm.find('#custom_checkErr').html('');

        }
    }
    if(event_repeat_option_value == "Every Weekday"){
    var start = new Date(input_sdate),
    end   = new Date(input_edate),
    diff  = new Date(end - start),
    days  = diff/1000/60/60/24;
    // console.log("days");
    // console.log(days);
    if(days<= 1){
        createEventForm.find('#event_start_end_dateErr').html('Please select at least 3 days ');
        return false;
    }else{
        createEventForm.find('#event_start_end_dateErr').html('');
    }
}

    var input_stime = createEventForm.find("select[name=event_start_time]").val();
    var input_etime = createEventForm.find("select[name=event_end_time]").val();

    var op_sdate = new Date(input_sdate+' '+input_stime);
    var op_edate = new Date(input_edate+' '+input_etime);

    if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
    {
        var formData = new FormData(this);
        var event_repeat_option = formData.get("event_repeat_option");
        if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
        }else{
            //console.log("fffffffff");
            createEventForm.find('#event_repeat_optionErr').html('Please select correct event type');
            return false;
        }             
        $.ajax({
            url: base_url+'front/insert_draggable_event',
            type:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            success: function(data) {
                if (data.status == false)
                {
                    //show errors
                    $('[id*=Err]').html('');
                    $.each(data.errors, function(key, val) {
                        var key =key.replace(/\[]/g, '');
                        key=key+'Err';   
                        $('#'+ key).html(val);
                    })
                }
                else if(data.status == true){
                    Swal.fire("Created!", "Successfully.", "success");
                    window.location.reload();                               
                }                   
            }
        }); 
    }else{
        createEventForm.find('#event_end_timeErr').html('End Time should be greater than Start time');
    }
    
});
///ADD NEW EVENT END///

///UPDATE EVENT START///
$('.edit-list-events').unbind('click').click(function () {
    //debugger;
    var event_id = $(event.target).attr('data-eval');
    var myModalUpdate = $('#myModalUpdate');
    $.ajax({
    type: "POST",
    url: base_url+'front/view_selected_event_info_list',
    type: 'POST',
    data: {
        event_id:event_id 
    }, 
    success: function(data){
    //debugger;
        if(data.status == true)
        {
	       var task_evt_event_repeat_option_type = data.task_evt_event_repeat_option_type;
	       var task_evt_created_type = data.task_evt_created_type;
	       var task_evt_array_count = data.task_evt_array_count;
	       var task_evt_isLastCount = data.task_evt_isLastCount;
	       
            $('#update_event_one').show();
            $('#update_event_two').show();
	        $('#update_event_three').show();
	        $('#update_event_one_new').hide();
	        if(task_evt_created_type == 'task'){  
	            var geteventType = 'To Do';
	        }else{
	            var geteventType = task_evt_created_type;
	        }
	        $('#update_type_edit').html("Update recurring "+geteventType);
	        if(task_evt_array_count == 1){
	            //console.log('1st loop');
	            // $('#update_event_two').hide();
	            // $('#update_event_one').hide();
	            // $('#update_event_one_new').show();
                myModalUpdate.find('.modal-body').find('.update-next-event').attr('data-stored-eval',event_id);
	            $('.checked_if_single').prop('checked',true);
                //myModalUpdate.modal('show');

                //debugger;
                //var event_id = event_id;
                var updatecategoryForm = $(".update-category");
                var viewEvent=$("#view-event");
                var updateEventModal=$("#update-event");
                if($("input[name=update_check_value]:checked").val())
                {
                $('#event_update_Err').html('');
                updatecategoryForm.find('#event_start_end_dateErr').html('');
                $.ajax({
                    type: "POST",
                    url: base_url+'front/view_selected_event_info_list',
                    type: 'POST',
                    data: {
                        event_id:event_id 
                    }, 
                    success: function(data1){
                        //debugger;
                    if(data1.status == true)
                    {
                       var task_evt_color = data1.task_evt_color;
                       var task_evt_title = data1.task_evt_title;
                       var task_evt_allday = data1.task_evt_allday;
                       var task_evt_start_time = data1.task_evt_start_time;
                       var task_evt_end_time = data1.task_evt_end_time;
                       var task_evt_reminder = data1.task_evt_reminder;
                       var task_evt_event_repeat_option_type = data1.task_evt_event_repeat_option_type;
                       var task_evt_note = data1.task_evt_note;
                       var task_evt_created_type = data1.task_evt_created_type;
                       var task_evt_unique_key = data1.task_evt_unique_key;
                       var task_evt_task_priority = data1.task_evt_task_priority;
                       var task_evt_draggable_event = data1.task_evt_draggable_event;
                       var task_evt_draggable_id = data1.task_evt_draggable_id;
                       var task_evt_custom_all_day = data1.task_evt_custom_all_day;
                       var task_evt_type = data1.task_evt_type;

                $('.custom-class-update').hide();
                if(task_evt_event_repeat_option_type == "Daily" || task_evt_event_repeat_option_type == "Does not repeat"){
                    $('#draggable_field').show();
                }else{
                    $('#draggable_field').hide();
                }
                var update_event_id = $("input[name=update_check_value]:checked").val();
                $('#task_priority_div_update').hide();
                if(task_evt_created_type == "task"){
                    $('#task_priority_div_update').show();
                    updateEventModal.find("select[name='task_priority']").val(task_evt_task_priority);
                    $("#created_type_task_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                if(task_evt_created_type == "reminder"){
                    $("#created_type_reminder_update").prop('checked', true);
                    $("#add_note_div_update").hide();
                }
                if(task_evt_created_type == "event"){
                    $("#created_type_event_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                /////// start if 
                    if(update_event_id == 1){ //update all 
                        //debugger;
                        var event_new_id = event_id;
                        $.ajax({
                            type: "POST",
                            url: base_url+'front/view_selected_event_info',
                            type: 'POST',
                            data: {
                                event_id:event_new_id 
                            }, 
                            success: function(data){
                            var task_start_date = data.task_start_date;
                            var task_end_date = data.task_end_date;
                            //var task_evt_color = data.task_evt_color;
                            ///////   code for hide custom field
                            var i = 1;
                            for(i =1;i<=7;i++){
                                $('#radioupdate'+i).hide();
                            }
                            var datenew1 = new Date(task_start_date.split('-'));
                            var datenew2 = new Date(task_end_date.split('-'));
                            var dateArray = new Array();
                            var currentDate = datenew1;
                            while (currentDate <= datenew2) {
                                dateArray.push(new Date (currentDate)); 
                                currentDate = moment(currentDate).add(1, 'days');
                            }
                            var arrayLength = dateArray.length;
                            for (var i = 0; i < arrayLength; i++) {
                                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                                $('#radioupdate'+day_new_value).show();
                            }

                            /////////// end 
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                            //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                            updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                            updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                            // $("#event_start_date_nnn").datepicker({
                            //     minDate: task_start_date
                            // }).datepicker("setDate", task_start_date);
                            // $("#event_end_date_nnn").datepicker({
                            //     minDate: task_end_date
                            // }).datepicker("setDate", task_end_date);
                            // $("#event_start_end_date_neww").datepicker({
                            //     minDate: task_start_date
                            // }).datepicker("setDate", task_start_date);

                            let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date.split('-')).getDay()];
                                let monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ][new Date(task_start_date.split('-')).getMonth()];
                                var start_day_value = new Date(task_start_date.split('-')).getDate();
                                updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                                updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                                updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                                var start_update = new Date(task_start_date.split('-')),
                                end_update   = new Date(task_end_date.split('-')),
                                diff_update  = new Date(end_update - start_update),
                                days_diff  = diff_update/1000/60/60/24;
                                //console.log("days_diff");
                                //console.log(days_diff);
                                if(days_diff < 2){
                                    $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                                    $('.custom_value_update').prop('disabled', true);
                                }else{
                                    $(".custom_value_update").html("Custom");
                                    $('.custom_value_update').prop('disabled', false);
                                }
                                if(days_diff < 7){
                                    $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                                    $('.weekday_value_update').prop('disabled', true);
                                }else{
                                    $('.weekday_value_update').prop('disabled', false);
                                }
                                if(days_diff < 31){
                                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                                    $('.monthly_value_update').prop('disabled', true);
                                }else{
                                    $('.monthly_value_update').prop('disabled', false);
                                }
                                if(days_diff < 365){
                                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                                    $('.yearly_value_update').prop('disabled', true);
                                }else{
                                    $('.yearly_value_update').prop('disabled', false);
                                }
                            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                            }
                        });
                        if(task_evt_event_repeat_option_type == 'Does not repeat'){
                            //$('#event_start_end_date_div_update').show();
                            //$('#event_start_end_date_select_update').hide();
                            $('#event_start_end_date_select_update').show();                            
                            $('#draggable_field_update').show();
                                              
                        }else if(task_evt_event_repeat_option_type == 'Custom'){
                            const split_string = task_evt_custom_all_day.split(",");
                            split_string.forEach(myFunction);
                            function myFunction(value, index, array) {
                                $("#radioupdate_"+value).prop('checked', true);
                            }
                            $('.custom-class-update').show();
                            //$('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                            $('#draggable_field_update').hide();
                        }else{
                            //$('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                            $('#draggable_field_update').hide();
                        }
                        
                        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
                        viewEvent.modal('hide');
                        updateEventModal.modal('show');
                        updateEventModal.find("input[name=event_name]").val(task_evt_title);      
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html('');
                        if(task_evt_created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
                        }                        
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                           
                        if(task_evt_type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
                           
                            if(task_evt_allday == 'false'){
                                updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                $("#date-time-section1").show();
                                $("#old_reminder_update").show();
                                $("#new_reminder_update").hide();
                            }else{
                                updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                $("#date-time-section1").hide();
                                $("#new_reminder_update").show();
                                $("#old_reminder_update").hide();
                            }
                            updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
                            if(task_evt_draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(event_id);
                            updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
                        }
                        // else
                        // {
                        //     $("#task").addClass("active");
                        //     $("#task-2").addClass("active");
                        // }
                        $('#event_field_hide').show(); 
                        updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                            e.preventDefault(); // Stop page from refreshing
                            //debugger;
                        var input_allday = updateEventModal.find("input[name=event_allDay]");
                       // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                        var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
                        var input_dd = ip_sedate.split(' - ');

                        var input_sdate=input_dd[0];
                        var input_edate=input_dd[1];
                        var input_stime=updateEventModal.find("select[name=event_start_time]").val();
                        var input_etime=updateEventModal.find("select[name=event_end_time]").val();
                        var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
                        var start_update = new Date(input_sdate),
                        end_update   = new Date(input_edate),
                        diff_update  = new Date(end_update - start_update),
                        days_update  = diff_update/1000/60/60/24;
                        if(days_update<= -1){
                            updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                            return false;
                        }
                        var formDataaa = new FormData(this);
                        //console.log(formDataaa.get("event_repeat_option"));
                        if(formDataaa.get("event_repeat_option")){
                        }else{
                            updateEventModal.find('#event_repeat_optionErr').html('Please select correct event type');
                            return false;
                        }
                        if(event_repeat_option_value == "Custom"){
                            var formDataa = new FormData(this);
                            //console.log(formDataa.get("event_repeat_option[]"));
                            if(formDataa.get("custom_check[]")){
                            }else{
                                updateEventModal.find('#custom_checkErr_update').html('Please select days');
                                return false;
                            }
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            // if(days_update<= 7){
                            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                            //     return false;
                            // }
                        if($('input[name="custom_check[]"]:checked').length <=2){
                                updateEventModal.find('#custom_checkErr_update').html('Please select at least 3 days');
                                return false;
                            }else{
                                updateEventModal.find('#custom_checkErr_update').html('');
                        
                            }
                        }
                        if(event_repeat_option_value == "Every Weekday"){
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            if(days_update<= 1){
                                updatecategoryForm.find('#event_start_end_dateErr').html('Please select at least 3 days ');
                                return false;
                            }else{
                                updatecategoryForm.find('#event_start_end_dateErr').html('');
                            }
                        }
                        
                        var op_sdate = new Date(input_sdate+' '+input_stime);
                        var op_edate = new Date(input_edate+' '+input_etime);
                        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                            {
                                var formData = new FormData(this);
                                var event_repeat_option = formData.get("event_repeat_option");
                                if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                                }else{
                                    //console.log("fffffffff");
                                    updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                                    return false;
                                }
                                formData.append('delete_check', '1');              
                                $.ajax({
                                    url: base_url+'front/update_event_form',
                                    type:"POST",
                                    data:formData,
                                    contentType:false,
                                    processData:false,
                                    cache:false,
                                    success: function(data) {
                                        if (data.status == false)
                                        {
                                            //show errors
                                            $('[id*=Err]').html('');
                                            $.each(data.errors, function(key, val) {
                                                var key =key.replace(/\[]/g, '');
                                                key=key+'Err';    
                                                $('#'+ key).html(val);
                                            })
                                        }
                                        else if(data.status == true){
                                            var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                                            var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                                            var dragId = data.drag_id;
                                            var event_id = data.event_id;
                                            var categoryStart = data.start_date;
                                            var categoryEnd = data.end_date;
                                            var type = data.type;
                                            var draggable_id = data.draggable_id;
                                            var allDay = data.allDay;
                                            if(allDay == 'true'){
                                                var allDay = true;
                                            }else{
                                                var allDay = false;
                                            }
                                            if (categoryName !== null && categoryName.length != 0) {
                                                updateEventModal.find('#event_end_timeErr').html('');
                                                Swal.fire("Updated!", "Successfully.", "success");
                                                updateEventModal.modal('hide');
                                                location.reload();
                                                return false;
                                            } 
                                        }                   
                                    },
                                    error: function() {
                                        alert("Something went Wrong...");
                                    }
                                });
                            }else{
                                updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                            }                                 
                        });
                        
                    }else if(update_event_id =="0"){ //update this
                        var event_new_id = event_id;
                            $.ajax({
                                type: "POST",
                                url: base_url+'front/event_data_single_event',
                                type: 'POST',
                                data: {
                                    event_id:event_new_id 
                                }, 
                                success: function(data){
                                //console.log("testtttt");
                                var task_start_date = data.task_start_date;
                                var task_end_date = data.task_end_date;
                                //var task_evt_color = data.task_evt_color;
                                //console.log(task_evt_color);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                                
                                //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                                updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                                updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                                // $("#event_start_date_nnn").datepicker({
                                //     minDate: task_start_date
                                // }).datepicker("setDate", task_start_date);
                                // $("#event_end_date_nnn").datepicker({
                                //     minDate: task_end_date
                                // }).datepicker("setDate", task_end_date);
                                // $("#event_start_end_date_neww").datepicker({
                                //     minDate: task_start_date
                                // }).datepicker("setDate", task_start_date);

                                let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date).getDay()];
                                let monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ][new Date(task_start_date).getMonth()];
                                var start_day_value = new Date(task_start_date).getDate();
                                updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                                updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                                updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                                var start_update = new Date(task_start_date),
                                end_update   = new Date(task_end_date),
                                diff_update  = new Date(end_update - start_update),
                                days_diff  = diff_update/1000/60/60/24;
                                //console.log("days_diff");
                                //console.log(days_diff);

                                // if(days_diff < 2){
                                //     $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                                //     $('.custom_value_update').prop('disabled', true);
                                // }else{
                                //     $(".custom_value_update").html("Custom");
                                //     $('.custom_value_update').prop('disabled', false);
                                // }
                                // if(days_diff < 7){
                                //     $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                                //     $('.weekday_value_update').prop('disabled', true);
                                // }else{
                                //     $('.weekday_value_update').prop('disabled', false);
                                // }
                                // if(days_diff < 31){
                                //     $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                                //     $('.monthly_value_update').prop('disabled', true);
                                // }else{
                                //     $('.monthly_value_update').prop('disabled', false);
                                // }
                                // if(days_diff < 365){
                                //     $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                                //     $('.yearly_value_update').prop('disabled', true);
                                // }else{
                                //     $('.yearly_value_update').prop('disabled', false);
                                // }
                                // // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                                // }

                                if(days_diff < 2){
                                    $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                                    $('.custom_value_update').prop('disabled', false);
                                }else{
                                    $(".custom_value_update").html("Custom");
                                    $('.custom_value_update').prop('disabled', false);
                                }
                                if(days_diff < 7){
                                    $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                                    $('.weekday_value_update').prop('disabled', false);
                                }else{
                                    $('.weekday_value_update').prop('disabled', false);
                                }
                                if(days_diff < 31){
                                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                                    $('.monthly_value_update').prop('disabled', false);
                                }else{
                                    $('.monthly_value_update').prop('disabled', false);
                                }
                                if(days_diff < 365){
                                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                                    $('.yearly_value_update').prop('disabled', false);
                                }else{
                                    $('.yearly_value_update').prop('disabled', false);
                                }
                                // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                                }
                            });
                            if(task_evt_event_repeat_option_type == 'Does not repeat'){
                                // $('#event_start_end_date_div_update').show();
                                // $('#event_start_end_date_select_update').hide();
                                $('#event_start_end_date_select_update').show();
                                $('#draggable_field_update').show();
                            }else if(task_evt_event_repeat_option_type == 'Custom'){
                                const split_string = task_evt_custom_all_day.split(",");
                                split_string.forEach(myFunction);
                                function myFunction(value, index, array) {
                                    $("#radioupdate_"+value).prop('checked', true);
                                }
                                $('.custom-class-update').show();
                                //$('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                                $('#draggable_field_update').hide();
                            }else{
                                //$('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                                $('#draggable_field_update').hide();
                            }
                            viewEvent.modal('hide');
                            updateEventModal.modal('show');
                            updateEventModal.find("input[name=event_name]").val(task_evt_title); 
                            //console.log(task_evt_color);
                            updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                            updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                            updateEventModal.find("#selected_color_update_text").html(''); 
                            if(task_evt_created_type == 'task'){  
                            var cap_Heading = 'To Do';
                            }else{
                                var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
                            }
                            updateEventModal.find(".selected_type_name").html(cap_Heading);               
                            if(task_evt_type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
                                //console.log(task_evt_allday);
                                if(task_evt_allday == 'false'){
                                    //console.log('yes');
                                    updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                                    updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                                    updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                    updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                    updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                    $("#date-time-section1").show();
                                    $("#old_reminder_update").show();
                                    $("#new_reminder_update").hide();
                                }else{
                                    updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                    updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                    $("#date-time-section1").hide();
                                    $("#new_reminder_update").show();
                                    $("#old_reminder_update").hide();
                                }
                                updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
                                updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
                                updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
                                if(task_evt_draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                                }else{
                                    // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                    updateEventModal.find("input[name=draggable_event]").val('');                                
                                }
                                updateEventModal.find("input[name=event_id]").val(event_id);
                                updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
                            }
                            // else
                            // {
                            //     $("#task").addClass("active");
                            //     $("#task-2").addClass("active");
                            // }
                            if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
                                $('#event_field_hide').show();
                            }else{
                                $('#event_field_hide').hide();
                            }
                            
                            updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                                e.preventDefault(); // Stop page from refreshing
                                //debugger;
                            var input_allday = updateEventModal.find("input[name=event_allDay]");
                            // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                            var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
                            var input_dd = ip_sedate.split(' - ');

                            var input_sdate=input_dd[0];
                            var input_edate=input_dd[1];
                            var input_stime=updateEventModal.find("select[name=event_start_time]").val();
                            var input_etime=updateEventModal.find("select[name=event_end_time]").val();
                            var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            if(days_update<= -1){
                                updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                                return false;
                            }

                            if(event_repeat_option_value == "Custom"){
                                var start_update = new Date(input_sdate),
                                end_update   = new Date(input_edate),
                                diff_update  = new Date(end_update - start_update),
                                days_update  = diff_update/1000/60/60/24;
                                // if(days_update<= 7){
                                //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                                //     return false;
                                // }
                            }
                            
                            var op_sdate = new Date(input_sdate+' '+input_stime);
                            var op_edate = new Date(input_edate+' '+input_etime);
                            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                                { 
                                    var formData = new FormData(this);
                                    var event_repeat_option = formData.get("event_repeat_option");
                                    if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                                    }else{
                                        //console.log("fffffffff");
                                        updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                                        return false;
                                    }
                                    formData.append('delete_check', '0');             
                                    $.ajax({
                                        url: base_url+'front/update_event_form',
                                        type:"POST",
                                        data:formData,
                                        contentType:false,
                                        processData:false,
                                        cache:false,
                                        success: function(data) {
                                            if (data.status == false)
                                            {
                                                //show errors
                                                $('[id*=Err]').html('');
                                                $.each(data.errors, function(key, val) {
                                                    var key =key.replace(/\[]/g, '');
                                                    key=key+'Err';    
                                                    $('#'+ key).html(val);
                                                })
                                            }
                                            else if(data.status == true){
                                                var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                                                var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                                                var dragId = data.drag_id;
                                                var event_id = data.event_id;
                                                var categoryStart = data.start_date;
                                                var categoryEnd = data.end_date;
                                                var type = data.type;
                                                var draggable_id = data.draggable_id;
                                                var allDay = data.allDay;
                                                if(allDay == 'true'){
                                                    var allDay = true;
                                                }else{
                                                    var allDay = false;
                                                }
                                                if (categoryName !== null && categoryName.length != 0) {
                                                    updateEventModal.find('#event_end_timeErr').html('');
                                                    Swal.fire("Updated!", "Successfully.", "success");
                                                    updateEventModal.modal('hide');
                                                    location.reload();
                                                    return false;
                                                } 
                                            }                   
                                        },
                                        error: function() {
                                            alert("Something went Wrong...");
                                        }
                                    });
                                }else{
                                    updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                                }                                 
                            });
                    }else if(update_event_id =="2"){ //update this and following
                        var event_new_id = event_id;
                        $.ajax({
                            type: "POST",
                            url: base_url+'front/event_data_following_event',
                            type: 'POST',
                            data: {
                                event_id:event_new_id 
                            }, 
                            success: function(data){
                            var task_start_date = data.task_start_date;
                            var task_end_date = data.task_end_date;
                            //var task_evt_color = data.task_evt_color;
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                            //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                            updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                            updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                            // $("#event_start_date_nnn").datepicker({
                            //     minDate: task_start_date
                            // }).datepicker("setDate", task_start_date);
                            // $("#event_end_date_nnn").datepicker({
                            //     minDate: task_end_date
                            // }).datepicker("setDate", task_end_date);
                            // $("#event_start_end_date_neww").datepicker({
                            //     minDate: task_start_date
                            // }).datepicker("setDate", task_start_date);
                            
                            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                            }
                        });
                        if(task_evt_event_repeat_option_type == 'Does not repeat'){
                            // $('#event_start_end_date_div_update').show();
                            // $('#event_start_end_date_select_update').hide();  
                            $('#event_start_end_date_select_update').hide();
                            $('#draggable_field_update').show();                  
                        }else if(task_evt_event_repeat_option_type == 'Custom'){
                            const split_string = task_evt_custom_all_day.split(",");
                            split_string.forEach(myFunction);
                            function myFunction(value, index, array) {
                                $("#radioupdate_"+value).prop('checked', true);
                            }
                            $('.custom-class-update').show();
                            //$('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                            $('#draggable_field_update').hide();
                        }else{
                            //$('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                            $('#draggable_field_update').hide();
                        }
                        viewEvent.modal('hide');
                        updateEventModal.modal('show');
                        updateEventModal.find("input[name=event_name]").val(task_evt_title); 
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html(''); 
                        if(task_evt_created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
                        }
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                 
                        if(task_evt_type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
                           
                            if(task_evt_allday == 'false'){
                                updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                $("#date-time-section1").show();
                                $("#old_reminder_update").show();
                                $("#new_reminder_update").hide();
                            }else{
                                updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                $("#date-time-section1").hide();
                                $("#new_reminder_update").show();
                                $("#old_reminder_update").hide();
                            }
                            updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
                            if(task_evt_draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(event_id);
                            updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
                        }
                        // else
                        // {
                        //     $("#task").addClass("active");
                        //     $("#task-2").addClass("active");
                        // } 
                        if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
                            $('#event_field_hide').show();
                        }else{
                            $('#event_field_hide').hide();
                        }
                        updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                            e.preventDefault(); // Stop page from refreshing
                        var input_allday = updateEventModal.find("input[name=event_allDay]");
                        // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                        var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
                        var input_dd = ip_sedate.split(' - ');

                        var input_sdate=input_dd[0];
                        var input_edate=input_dd[1];
                        var input_stime=updateEventModal.find("select[name=event_start_time]").val();
                        var input_etime=updateEventModal.find("select[name=event_end_time]").val();
                        var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
                        var start_update = new Date(input_sdate),
                        end_update   = new Date(input_edate),
                        diff_update  = new Date(end_update - start_update),
                        days_update  = diff_update/1000/60/60/24;
                        if(days_update<= -1){
                            updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                            return false;
                        }

                        if(event_repeat_option_value == "Custom"){
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            // if(days_update<= 7){
                            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                            //     return false;
                            // }
                        }
                        
                        var op_sdate = new Date(input_sdate+' '+input_stime);
                        var op_edate = new Date(input_edate+' '+input_etime);
                        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                            {
                                var formData = new FormData(this);
                                var event_repeat_option = formData.get("event_repeat_option");
                                if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                                }else{
                                    //console.log("fffffffff");
                                    updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                                    return false;
                                }
                                formData.append('delete_check', '2');             
                                $.ajax({
                                    url: base_url+'front/update_event_form',
                                    type:"POST",
                                    data:formData,
                                    contentType:false,
                                    processData:false,
                                    cache:false,
                                    success: function(data) {
                                        if (data.status == false)
                                        {
                                            //show errors
                                            $('[id*=Err]').html('');
                                            $.each(data.errors, function(key, val) {
                                                var key =key.replace(/\[]/g, '');
                                                key=key+'Err';    
                                                $('#'+ key).html(val);
                                            })
                                        }
                                        else if(data.status == true){
                                            var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                                            var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                                            var dragId = data.drag_id;
                                            var event_id = data.event_id;
                                            var categoryStart = data.start_date;
                                            var categoryEnd = data.end_date;
                                            var type = data.type;
                                            var draggable_id = data.draggable_id;
                                            var allDay = data.allDay;
                                            if(allDay == 'true'){
                                                var allDay = true;
                                            }else{
                                                var allDay = false;
                                            }
                                            if (categoryName !== null && categoryName.length != 0) {
                                                updateEventModal.find('#event_end_timeErr').html('');
                                                Swal.fire("Updated!", "Successfully.", "success");
                                                updateEventModal.modal('hide');
                                                location.reload();
                                                return false;
                                            } 
                                        }                   
                                    },
                                    error: function() {
                                        alert("Something went Wrong...");
                                    }
                                });
                            }else{
                                updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                            }                                 
                        });
                    }
                /////////   end if
                  }
                  }
                });
                }
                else
                {
                    $('#event_update_Err').html('Please select option!');
                } 
	            
	        }else{
	         //console.log('2nd loop');
	            if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
	                //console.log('2-1st loop');
	                $('#update_event_two').hide();
                    myModalUpdate.find('.modal-body').find('.update-next-event').attr('data-stored-eval',event_id);
	                myModalUpdate.modal('show');
	                
	            }else{
	                if(task_evt_isLastCount == 1){
	                    $('#update_event_three').hide();
                        myModalUpdate.find('.modal-body').find('.update-next-event').attr('data-stored-eval',event_id);
	                    myModalUpdate.modal('show');
	                }else{
                        myModalUpdate.find('.modal-body').find('.update-next-event').attr('data-stored-eval',event_id);
	                    myModalUpdate.modal('show');
	                }
	            }  
	        }
	        //return false; 
            }  
	        }
	});                 
});

$('.update-next-event').unbind('click').click(function () {
//debugger;
var event_id = $(event.target).attr('data-stored-eval');
var updatecategoryForm = $(".update-category");
var viewEvent=$("#view-event");
var updateEventModal=$("#update-event");
if($("input[name=update_check_value]:checked").val())
{
$('#event_update_Err').html('');
updatecategoryForm.find('#event_start_end_dateErr').html('');
$.ajax({
    type: "POST",
    url: base_url+'front/view_selected_event_info_list',
    type: 'POST',
    data: {
        event_id:event_id 
    }, 
    success: function(data1){
        //debugger;
    if(data1.status == true)
    {
       var task_evt_color = data1.task_evt_color;
       var task_evt_title = data1.task_evt_title;
       var task_evt_allday = data1.task_evt_allday;
       var task_evt_start_time = data1.task_evt_start_time;
       var task_evt_end_time = data1.task_evt_end_time;
       var task_evt_reminder = data1.task_evt_reminder;
       var task_evt_event_repeat_option_type = data1.task_evt_event_repeat_option_type;
       var task_evt_note = data1.task_evt_note;
       var task_evt_created_type = data1.task_evt_created_type;
       var task_evt_unique_key = data1.task_evt_unique_key;
       var task_evt_task_priority = data1.task_evt_task_priority;
       var task_evt_draggable_event = data1.task_evt_draggable_event;
       var task_evt_draggable_id = data1.task_evt_draggable_id;
       var task_evt_custom_all_day = data1.task_evt_custom_all_day;
       var task_evt_type = data1.task_evt_type;

$('.custom-class-update').hide();
if(task_evt_event_repeat_option_type == "Daily" || task_evt_event_repeat_option_type == "Does not repeat"){
    $('#draggable_field').show();
}else{
    $('#draggable_field').hide();
}
var update_event_id = $("input[name=update_check_value]:checked").val();
$('#task_priority_div_update').hide();
if(task_evt_created_type == "task"){
    $('#task_priority_div_update').show();
    updateEventModal.find("select[name='task_priority']").val(task_evt_task_priority);
    $("#created_type_task_update").prop('checked', true);
    $("#add_note_div_update").show();
}
if(task_evt_created_type == "reminder"){
    $("#created_type_reminder_update").prop('checked', true);
    $("#add_note_div_update").hide();
}
if(task_evt_created_type == "event"){
    $("#created_type_event_update").prop('checked', true);
    $("#add_note_div_update").show();
}
/////// start if 
    if(update_event_id == 1){ //update all 
        //debugger;
        var event_new_id = event_id;
        $.ajax({
            type: "POST",
            url: base_url+'front/view_selected_event_info',
            type: 'POST',
            data: {
                event_id:event_new_id 
            }, 
            success: function(data){
            var task_start_date = data.task_start_date;
            var task_end_date = data.task_end_date;
            //var task_evt_color = data.task_evt_color;
            ///////   code for hide custom field
            var i = 1;
            for(i =1;i<=7;i++){
                $('#radioupdate'+i).hide();
            }
            var datenew1 = new Date(task_start_date.split('-'));
            var datenew2 = new Date(task_end_date.split('-'));
            var dateArray = new Array();
            var currentDate = datenew1;
            while (currentDate <= datenew2) {
                dateArray.push(new Date (currentDate)); 
                currentDate = moment(currentDate).add(1, 'days');
            }
            var arrayLength = dateArray.length;
            for (var i = 0; i < arrayLength; i++) {
                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                $('#radioupdate'+day_new_value).show();
            }

            /////////// end 
            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
            //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
            updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
            updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

            // $("#event_start_date_nnn").datepicker({
            //     minDate: task_start_date
            // }).datepicker("setDate", task_start_date);
            // $("#event_end_date_nnn").datepicker({
            //     minDate: task_end_date
            // }).datepicker("setDate", task_end_date);
            // $("#event_start_end_date_neww").datepicker({
            //     minDate: task_start_date
            // }).datepicker("setDate", task_start_date);

            let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date.split('-')).getDay()];
                let monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
                ][new Date(task_start_date.split('-')).getMonth()];
                var start_day_value = new Date(task_start_date.split('-')).getDate();
                updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                var start_update = new Date(task_start_date.split('-')),
                end_update   = new Date(task_end_date.split('-')),
                diff_update  = new Date(end_update - start_update),
                days_diff  = diff_update/1000/60/60/24;
                //console.log("days_diff");
                //console.log(days_diff);
                if(days_diff < 2){
                    $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                    $('.custom_value_update').prop('disabled', true);
                }else{
                    $(".custom_value_update").html("Custom");
                    $('.custom_value_update').prop('disabled', false);
                }
                if(days_diff < 7){
                    $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                    $('.weekday_value_update').prop('disabled', true);
                }else{
                    $('.weekday_value_update').prop('disabled', false);
                }
                if(days_diff < 31){
                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                    $('.monthly_value_update').prop('disabled', true);
                }else{
                    $('.monthly_value_update').prop('disabled', false);
                }
                if(days_diff < 365){
                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                    $('.yearly_value_update').prop('disabled', true);
                }else{
                    $('.yearly_value_update').prop('disabled', false);
                }
            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
            }
        });
        if(task_evt_event_repeat_option_type == 'Does not repeat'){
            //$('#event_start_end_date_div_update').show();
            //$('#event_start_end_date_select_update').hide();
            $('#event_start_end_date_select_update').show();                            
            $('#draggable_field_update').show();
                              
        }else if(task_evt_event_repeat_option_type == 'Custom'){
            const split_string = task_evt_custom_all_day.split(",");
            split_string.forEach(myFunction);
            function myFunction(value, index, array) {
                $("#radioupdate_"+value).prop('checked', true);
            }
            $('.custom-class-update').show();
            //$('#event_start_end_date_div_update').hide();
            $('#event_start_end_date_select_update').show();
            $('#draggable_field_update').hide();
        }else{
            //$('#event_start_end_date_div_update').hide();
            $('#event_start_end_date_select_update').show();
            $('#draggable_field_update').hide();
        }
        
        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
        viewEvent.modal('hide');
        updateEventModal.modal('show');
        updateEventModal.find("input[name=event_name]").val(task_evt_title);      
        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
        updateEventModal.find("#selected_color_update_text").html('');
        if(task_evt_created_type == 'task'){  
            var cap_Heading = 'To Do';
        }else{
            var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
        }                        
        updateEventModal.find(".selected_type_name").html(cap_Heading);                           
        if(task_evt_type == 'event')
        {
            $("#event").addClass("active");
            $("#event-1").addClass("active");
            updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
           
            if(task_evt_allday == 'false'){
                updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                $("#date-time-section1").show();
                $("#old_reminder_update").show();
                $("#new_reminder_update").hide();
            }else{
                updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                $("#date-time-section1").hide();
                $("#new_reminder_update").show();
                $("#old_reminder_update").hide();
            }
            updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
            updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
            updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
            if(task_evt_draggable_event == 'on'){
                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                updateEventModal.find("input[name=draggable_event]").val('on');
            }else{
                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                updateEventModal.find("input[name=draggable_event]").val('');                                
            }
            updateEventModal.find("input[name=event_id]").val(event_id);
            updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
        }
        // else
        // {
        //     $("#task").addClass("active");
        //     $("#task-2").addClass("active");
        // }
        $('#event_field_hide').show(); 
        updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
            e.preventDefault(); // Stop page from refreshing
            //debugger;
        var input_allday = updateEventModal.find("input[name=event_allDay]");
       // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
        var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
        var input_dd = ip_sedate.split(' - ');

        var input_sdate=input_dd[0];
        var input_edate=input_dd[1];
        var input_stime=updateEventModal.find("select[name=event_start_time]").val();
        var input_etime=updateEventModal.find("select[name=event_end_time]").val();
        var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
        var start_update = new Date(input_sdate),
        end_update   = new Date(input_edate),
        diff_update  = new Date(end_update - start_update),
        days_update  = diff_update/1000/60/60/24;
        if(days_update<= -1){
            updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
            return false;
        }
        var formDataaa = new FormData(this);
        //console.log(formDataaa.get("event_repeat_option"));
        if(formDataaa.get("event_repeat_option")){
        }else{
            updateEventModal.find('#event_repeat_optionErr').html('Please select correct event type');
            return false;
        }
        if(event_repeat_option_value == "Custom"){
            var formDataa = new FormData(this);
            //console.log(formDataa.get("event_repeat_option[]"));
            if(formDataa.get("custom_check[]")){
            }else{
                updateEventModal.find('#custom_checkErr_update').html('Please select days');
                return false;
            }
            var start_update = new Date(input_sdate),
            end_update   = new Date(input_edate),
            diff_update  = new Date(end_update - start_update),
            days_update  = diff_update/1000/60/60/24;
            // if(days_update<= 7){
            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
            //     return false;
            // }
        if($('input[name="custom_check[]"]:checked').length <=2){
                updateEventModal.find('#custom_checkErr_update').html('Please select at least 3 days');
                return false;
            }else{
                updateEventModal.find('#custom_checkErr_update').html('');
        
            }
        }
        if(event_repeat_option_value == "Every Weekday"){
            var start_update = new Date(input_sdate),
            end_update   = new Date(input_edate),
            diff_update  = new Date(end_update - start_update),
            days_update  = diff_update/1000/60/60/24;
            if(days_update<= 1){
                updatecategoryForm.find('#event_start_end_dateErr').html('Please select at least 3 days ');
                return false;
            }else{
                updatecategoryForm.find('#event_start_end_dateErr').html('');
            }
        }
        
        var op_sdate = new Date(input_sdate+' '+input_stime);
        var op_edate = new Date(input_edate+' '+input_etime);
        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
            {
                var formData = new FormData(this);
                var event_repeat_option = formData.get("event_repeat_option");
                if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                }else{
                    //console.log("fffffffff");
                    updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                    return false;
                }
                formData.append('delete_check', '1');              
                $.ajax({
                    url: base_url+'front/update_event_form',
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    success: function(data) {
                        if (data.status == false)
                        {
                            //show errors
                            $('[id*=Err]').html('');
                            $.each(data.errors, function(key, val) {
                                var key =key.replace(/\[]/g, '');
                                key=key+'Err';    
                                $('#'+ key).html(val);
                            })
                        }
                        else if(data.status == true){
                            var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                            var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                            var dragId = data.drag_id;
                            var event_id = data.event_id;
                            var categoryStart = data.start_date;
                            var categoryEnd = data.end_date;
                            var type = data.type;
                            var draggable_id = data.draggable_id;
                            var allDay = data.allDay;
                            if(allDay == 'true'){
                                var allDay = true;
                            }else{
                                var allDay = false;
                            }
                            if (categoryName !== null && categoryName.length != 0) {
                                updateEventModal.find('#event_end_timeErr').html('');
                                Swal.fire("Updated!", "Successfully.", "success");
                                updateEventModal.modal('hide');
                                location.reload();
                                return false;
                            } 
                        }                   
                    },
                    error: function() {
                        alert("Something went Wrong...");
                    }
                });
            }else{
                updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
            }                                 
        });
        
    }else if(update_event_id =="0"){ //update this
        var event_new_id = event_id;
            $.ajax({
                type: "POST",
                url: base_url+'front/event_data_single_event',
                type: 'POST',
                data: {
                    event_id:event_new_id 
                }, 
                success: function(data){
                //console.log("testtttt");
                var task_start_date = data.task_start_date;
                var task_end_date = data.task_end_date;
                //var task_evt_color = data.task_evt_color;
                //console.log(task_evt_color);
                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                
                //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                // $("#event_start_date_nnn").datepicker({
                //     minDate: task_start_date
                // }).datepicker("setDate", task_start_date);
                // $("#event_end_date_nnn").datepicker({
                //     minDate: task_end_date
                // }).datepicker("setDate", task_end_date);
                // $("#event_start_end_date_neww").datepicker({
                //     minDate: task_start_date
                // }).datepicker("setDate", task_start_date);

                let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date).getDay()];
                let monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
                ][new Date(task_start_date).getMonth()];
                var start_day_value = new Date(task_start_date).getDate();
                updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                var start_update = new Date(task_start_date),
                end_update   = new Date(task_end_date),
                diff_update  = new Date(end_update - start_update),
                days_diff  = diff_update/1000/60/60/24;
                //console.log("days_diff");
                //console.log(days_diff);

                // if(days_diff < 2){
                //     $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                //     $('.custom_value_update').prop('disabled', true);
                // }else{
                //     $(".custom_value_update").html("Custom");
                //     $('.custom_value_update').prop('disabled', false);
                // }
                // if(days_diff < 7){
                //     $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                //     $('.weekday_value_update').prop('disabled', true);
                // }else{
                //     $('.weekday_value_update').prop('disabled', false);
                // }
                // if(days_diff < 31){
                //     $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                //     $('.monthly_value_update').prop('disabled', true);
                // }else{
                //     $('.monthly_value_update').prop('disabled', false);
                // }
                // if(days_diff < 365){
                //     $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                //     $('.yearly_value_update').prop('disabled', true);
                // }else{
                //     $('.yearly_value_update').prop('disabled', false);
                // }
                // // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                // }

                if(days_diff < 2){
                    $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
                    $('.custom_value_update').prop('disabled', false);
                }else{
                    $(".custom_value_update").html("Custom");
                    $('.custom_value_update').prop('disabled', false);
                }
                if(days_diff < 7){
                    $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                    $('.weekday_value_update').prop('disabled', false);
                }else{
                    $('.weekday_value_update').prop('disabled', false);
                }
                if(days_diff < 31){
                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                    $('.monthly_value_update').prop('disabled', false);
                }else{
                    $('.monthly_value_update').prop('disabled', false);
                }
                if(days_diff < 365){
                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                    $('.yearly_value_update').prop('disabled', false);
                }else{
                    $('.yearly_value_update').prop('disabled', false);
                }
                // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                }
            });
            if(task_evt_event_repeat_option_type == 'Does not repeat'){
                // $('#event_start_end_date_div_update').show();
                // $('#event_start_end_date_select_update').hide();
                $('#event_start_end_date_select_update').show();
                $('#draggable_field_update').show();
            }else if(task_evt_event_repeat_option_type == 'Custom'){
                const split_string = task_evt_custom_all_day.split(",");
                split_string.forEach(myFunction);
                function myFunction(value, index, array) {
                    $("#radioupdate_"+value).prop('checked', true);
                }
                $('.custom-class-update').show();
                //$('#event_start_end_date_div_update').hide();
                $('#event_start_end_date_select_update').show();
                $('#draggable_field_update').hide();
            }else{
                //$('#event_start_end_date_div_update').hide();
                $('#event_start_end_date_select_update').show();
                $('#draggable_field_update').hide();
            }
            viewEvent.modal('hide');
            updateEventModal.modal('show');
            updateEventModal.find("input[name=event_name]").val(task_evt_title); 
            //console.log(task_evt_color);
            updateEventModal.find("input[name='event_color']").val(task_evt_color); 
            updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
            updateEventModal.find("#selected_color_update_text").html(''); 
            if(task_evt_created_type == 'task'){  
            var cap_Heading = 'To Do';
            }else{
                var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
            }
            updateEventModal.find(".selected_type_name").html(cap_Heading);               
            if(task_evt_type == 'event')
            {
                $("#event").addClass("active");
                $("#event-1").addClass("active");
                updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
                //console.log(task_evt_allday);
                if(task_evt_allday == 'false'){
                    //console.log('yes');
                    updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                    updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                    updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                    updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                    updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                    updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                    $("#date-time-section1").show();
                    $("#old_reminder_update").show();
                    $("#new_reminder_update").hide();
                }else{
                    updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                    updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                    $("#date-time-section1").hide();
                    $("#new_reminder_update").show();
                    $("#old_reminder_update").hide();
                }
                updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
                updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
                updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
                if(task_evt_draggable_event == 'on'){
                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                updateEventModal.find("input[name=draggable_event]").val('on');
                }else{
                    // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                    updateEventModal.find("input[name=draggable_event]").val('');                                
                }
                updateEventModal.find("input[name=event_id]").val(event_id);
                updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
            }
            // else
            // {
            //     $("#task").addClass("active");
            //     $("#task-2").addClass("active");
            // }
            if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
                $('#event_field_hide').show();
            }else{
                $('#event_field_hide').hide();
            }
            
            updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                e.preventDefault(); // Stop page from refreshing
                //debugger;
            var input_allday = updateEventModal.find("input[name=event_allDay]");
            // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
            var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
            var input_dd = ip_sedate.split(' - ');

            var input_sdate=input_dd[0];
            var input_edate=input_dd[1];
            var input_stime=updateEventModal.find("select[name=event_start_time]").val();
            var input_etime=updateEventModal.find("select[name=event_end_time]").val();
            var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
            var start_update = new Date(input_sdate),
            end_update   = new Date(input_edate),
            diff_update  = new Date(end_update - start_update),
            days_update  = diff_update/1000/60/60/24;
            if(days_update<= -1){
                updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                return false;
            }

            if(event_repeat_option_value == "Custom"){
                var start_update = new Date(input_sdate),
                end_update   = new Date(input_edate),
                diff_update  = new Date(end_update - start_update),
                days_update  = diff_update/1000/60/60/24;
                // if(days_update<= 7){
                //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                //     return false;
                // }
            }
            
            var op_sdate = new Date(input_sdate+' '+input_stime);
            var op_edate = new Date(input_edate+' '+input_etime);
            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                { 
                    var formData = new FormData(this);
                    var event_repeat_option = formData.get("event_repeat_option");
                    if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                    }else{
                        //console.log("fffffffff");
                        updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                        return false;
                    }
                    formData.append('delete_check', '0');             
                    $.ajax({
                        url: base_url+'front/update_event_form',
                        type:"POST",
                        data:formData,
                        contentType:false,
                        processData:false,
                        cache:false,
                        success: function(data) {
                            if (data.status == false)
                            {
                                //show errors
                                $('[id*=Err]').html('');
                                $.each(data.errors, function(key, val) {
                                    var key =key.replace(/\[]/g, '');
                                    key=key+'Err';    
                                    $('#'+ key).html(val);
                                })
                            }
                            else if(data.status == true){
                                var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                                var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                                var dragId = data.drag_id;
                                var event_id = data.event_id;
                                var categoryStart = data.start_date;
                                var categoryEnd = data.end_date;
                                var type = data.type;
                                var draggable_id = data.draggable_id;
                                var allDay = data.allDay;
                                if(allDay == 'true'){
                                    var allDay = true;
                                }else{
                                    var allDay = false;
                                }
                                if (categoryName !== null && categoryName.length != 0) {
                                    updateEventModal.find('#event_end_timeErr').html('');
                                    Swal.fire("Updated!", "Successfully.", "success");
                                    updateEventModal.modal('hide');
                                    location.reload();
                                    return false;
                                } 
                            }                   
                        },
                        error: function() {
                            alert("Something went Wrong...");
                        }
                    });
                }else{
                    updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                }                                 
            });
    }else if(update_event_id =="2"){ //update this and following
        var event_new_id = event_id;
        $.ajax({
            type: "POST",
            url: base_url+'front/event_data_following_event',
            type: 'POST',
            data: {
                event_id:event_new_id 
            }, 
            success: function(data){
            var task_start_date = data.task_start_date;
            var task_end_date = data.task_end_date;
            //var task_evt_color = data.task_evt_color;
            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
            //updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
            updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
            updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

            // $("#event_start_date_nnn").datepicker({
            //     minDate: task_start_date
            // }).datepicker("setDate", task_start_date);
            // $("#event_end_date_nnn").datepicker({
            //     minDate: task_end_date
            // }).datepicker("setDate", task_end_date);
            // $("#event_start_end_date_neww").datepicker({
            //     minDate: task_start_date
            // }).datepicker("setDate", task_start_date);
            
            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
            }
        });
        if(task_evt_event_repeat_option_type == 'Does not repeat'){
            // $('#event_start_end_date_div_update').show();
            // $('#event_start_end_date_select_update').hide();  
            $('#event_start_end_date_select_update').hide();
            $('#draggable_field_update').show();                  
        }else if(task_evt_event_repeat_option_type == 'Custom'){
            const split_string = task_evt_custom_all_day.split(",");
            split_string.forEach(myFunction);
            function myFunction(value, index, array) {
                $("#radioupdate_"+value).prop('checked', true);
            }
            $('.custom-class-update').show();
            //$('#event_start_end_date_div_update').hide();
            $('#event_start_end_date_select_update').show();
            $('#draggable_field_update').hide();
        }else{
            //$('#event_start_end_date_div_update').hide();
            $('#event_start_end_date_select_update').show();
            $('#draggable_field_update').hide();
        }
        viewEvent.modal('hide');
        updateEventModal.modal('show');
        updateEventModal.find("input[name=event_name]").val(task_evt_title); 
        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
        updateEventModal.find("#selected_color_update_text").html(''); 
        if(task_evt_created_type == 'task'){  
            var cap_Heading = 'To Do';
        }else{
            var cap_Heading = (task_evt_created_type).charAt(0).toUpperCase() + (task_evt_created_type).slice(1);
        }
        updateEventModal.find(".selected_type_name").html(cap_Heading);                 
        if(task_evt_type == 'event')
        {
            $("#event").addClass("active");
            $("#event-1").addClass("active");
            updateEventModal.find("textarea[name=event_note]").val(task_evt_note);
           
            if(task_evt_allday == 'false'){
                updateEventModal.find("select[name=event_start_time]").val(moment(task_evt_start_time, "HH:mm").format('hh:mm A'));
                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                updateEventModal.find("select[name=event_end_time]").val(moment(task_evt_end_time, "HH:mm").format('hh:mm A'));
                updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                $("#date-time-section1").show();
                $("#old_reminder_update").show();
                $("#new_reminder_update").hide();
            }else{
                updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                $("#date-time-section1").hide();
                $("#new_reminder_update").show();
                $("#old_reminder_update").hide();
            }
            updateEventModal.find("select[name='event_repeat_option']").val(task_evt_event_repeat_option_type); 
            updateEventModal.find("select[name='event_reminder']").val(task_evt_reminder);
            updateEventModal.find("select[name='event_reminder_new']").val(task_evt_reminder); 
            if(task_evt_draggable_event == 'on'){
                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                updateEventModal.find("input[name=draggable_event]").val('on');
            }else{
                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                updateEventModal.find("input[name=draggable_event]").val('');                                
            }
            updateEventModal.find("input[name=event_id]").val(event_id);
            updateEventModal.find("input[name=draggable_id]").val(task_evt_draggable_id);
        }
        // else
        // {
        //     $("#task").addClass("active");
        //     $("#task-2").addClass("active");
        // } 
        if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
            $('#event_field_hide').show();
        }else{
            $('#event_field_hide').hide();
        }
        updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
            e.preventDefault(); // Stop page from refreshing
        var input_allday = updateEventModal.find("input[name=event_allDay]");
        // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
        var ip_sedate=updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+updateEventModal.find("input[name=event_end_date_nn]").val();
        var input_dd = ip_sedate.split(' - ');

        var input_sdate=input_dd[0];
        var input_edate=input_dd[1];
        var input_stime=updateEventModal.find("select[name=event_start_time]").val();
        var input_etime=updateEventModal.find("select[name=event_end_time]").val();
        var event_repeat_option_value=updateEventModal.find("#event_repeat_option").val();
        var start_update = new Date(input_sdate),
        end_update   = new Date(input_edate),
        diff_update  = new Date(end_update - start_update),
        days_update  = diff_update/1000/60/60/24;
        if(days_update<= -1){
            updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
            return false;
        }

        if(event_repeat_option_value == "Custom"){
            var start_update = new Date(input_sdate),
            end_update   = new Date(input_edate),
            diff_update  = new Date(end_update - start_update),
            days_update  = diff_update/1000/60/60/24;
            // if(days_update<= 7){
            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
            //     return false;
            // }
        }
        
        var op_sdate = new Date(input_sdate+' '+input_stime);
        var op_edate = new Date(input_edate+' '+input_etime);
        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
            {
                var formData = new FormData(this);
                var event_repeat_option = formData.get("event_repeat_option");
                if(event_repeat_option == 'Does not repeat' || event_repeat_option == 'Daily' ||event_repeat_option == 'Every Weekday' ||event_repeat_option == 'Custom' || event_repeat_option == 'Weekly' || event_repeat_option == 'Monthly' || event_repeat_option == 'Yearly'){
                }else{
                    //console.log("fffffffff");
                    updatecategoryForm.find('#event_repeat_optionErr').html('Please select correct event type');
                    return false;
                }
                formData.append('delete_check', '2');             
                $.ajax({
                    url: base_url+'front/update_event_form',
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    success: function(data) {
                        if (data.status == false)
                        {
                            //show errors
                            $('[id*=Err]').html('');
                            $.each(data.errors, function(key, val) {
                                var key =key.replace(/\[]/g, '');
                                key=key+'Err';    
                                $('#'+ key).html(val);
                            })
                        }
                        else if(data.status == true){
                            var categoryName = updatecategoryForm.find("input[name='event_name']").val(); 
                            var categoryColor = updatecategoryForm.find("input[name='event_color']").val();
                            var dragId = data.drag_id;
                            var event_id = data.event_id;
                            var categoryStart = data.start_date;
                            var categoryEnd = data.end_date;
                            var type = data.type;
                            var draggable_id = data.draggable_id;
                            var allDay = data.allDay;
                            if(allDay == 'true'){
                                var allDay = true;
                            }else{
                                var allDay = false;
                            }
                            if (categoryName !== null && categoryName.length != 0) {
                                updateEventModal.find('#event_end_timeErr').html('');
                                Swal.fire("Updated!", "Successfully.", "success");
                                updateEventModal.modal('hide');
                                location.reload();
                                return false;
                            } 
                        }                   
                    },
                    error: function() {
                        alert("Something went Wrong...");
                    }
                });
            }else{
                updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
            }                                 
        });
    }
/////////   end if
  }
  }
});
}
else
{
    $('#event_update_Err').html('Please select option!');
} 
});
///UPDATE EVENT END///

///DELETE EVENT START///
$('.delete-list-events').unbind('click').click(function () {
//debugger;
var event_id = $(event.target).attr('data-deval');
$.ajax({
type: "POST",
url: base_url+'front/view_selected_event_info_list',
type: 'POST',
data: {
    event_id:event_id 
}, 
success: function(data){
if(data.status == true)
{
   var task_evt_event_repeat_option_type = data.task_evt_event_repeat_option_type;
   var task_evt_created_type = data.task_evt_created_type;
   var task_evt_array_count = data.task_evt_array_count;
   var task_evt_isLastCount = data.task_evt_isLastCount;

    $('#delete_event_two').show();
    $('#delete_event_three').show();
    if(task_evt_created_type == 'task'){  
        var geteventType = 'To Do';
    }else{
        var geteventType = task_evt_created_type;
    }
    $('#delete_type_edit').html("Delete recurring "+geteventType);            
    if(task_evt_array_count == 1){
        $('#delete_event_two').hide();
        $("#myModal").find('.modal-body').find('.delete-next-event').attr('data-stored-deval',event_id);
        $("#myModal").modal('show');                    
    }else{                 
            if(task_evt_event_repeat_option_type == 'Does not repeat' || task_evt_event_repeat_option_type == 'Daily'){
                $('#delete_event_two').hide();
                $("#myModal").find('.modal-body').find('.delete-next-event').attr('data-stored-deval',event_id);
                $("#myModal").modal('show');
            }else{
                    if(task_evt_isLastCount == 1){
                        $('#delete_event_three').hide();
                        $("#myModal").find('.modal-body').find('.delete-next-event').attr('data-stored-deval',event_id);
                        $("#myModal").modal('show');
                    }else{
                        $("#myModal").find('.modal-body').find('.delete-next-event').attr('data-stored-deval',event_id);
                        $("#myModal").modal('show');
                    }                    
            }  
        }
    }
    }
    }); 
});

$('.delete-next-event').unbind('click').click(function () {
//debugger;
if($("input[name=delete_check_value]:checked").val())
{
    $('#event_delete_Err').html('');
    var event_id = $(event.target).attr('data-stored-deval');         
    var delete_event_id = $("input[name=delete_check_value]:checked").val();
    $.ajax({
            type: "POST",
            url: base_url+'front/delete_event',
            type: 'POST',
            data: {
                event_id:event_id,
                delete_check : delete_event_id
            }, 
            success: function(html){
                //debugger;
                Swal.fire("Deleted!", "Successfully.", "success");
                location.reload();
            }
    });
}
else
{
    $('#event_delete_Err').html('Please select option!');
}                

});
///DELETE EVENT END///

});

/////////////////////////////////////////////////////////////////////
$('#new_reminder').hide();
    // $('#event_start_end_date_select').hide();
    // $('#event_start_end_date_div').show();
function showEndDate(value) 
{
    if(value == "Does not repeat")
    {
        var check_start_date = $('#event_start_date_nn').val();
        $(".create-category").find("input[name=event_end_date_nn]").val(moment(check_start_date).format('Y-MM-DD'));
    }

    if(value == "Daily" || value == "Does not repeat"){
        // $('#draggable_field_create').show();
        $('#draggable_event').val("on");
    }else{
        // $('#draggable_field_create').hide();
        $('#draggable_event').val("");
    }
    if(value == 'Custom'){
        //console.log("Fgf");
        //debugger;
        var start_date_selected = $('#event_start_date_nn').val();
        var end_date_selected = $('#event_end_date_nn').val();
        var date1 = new Date(start_date_selected.split('-'));
        var date2 = new Date(end_date_selected.split('-'));
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        //console.log("Difference_In_Time");
        //console.log(Difference_In_Days);
        if(Difference_In_Days > 5){
            $('#event_start_end_date_select').show();
            //$('#event_start_end_date_div').hide();  
            $('.custom-class').css('display','block');
            for($i =1;$i<=7;$i++){
                $('#radioId'+$i).show();
            }
        }else{
            for($i =1;$i<=7;$i++){
                $('#radioId'+$i).hide();
            }
            $('#event_start_end_date_select').show();
            //$('#event_start_end_date_div').hide();
            $('.custom-class').css('display','block'); 
            var dateArray = new Array();
            var currentDate = date1;
            while (currentDate <= date2) {
                dateArray.push(new Date (currentDate));
                currentDate = moment(currentDate).add(1, 'days');
            }
            var arrayLength = dateArray.length;
            for (var i = 0; i < arrayLength; i++) {
                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                $('#radioId'+day_new_value).show();
            }

        }
        
    }
    // else if(value == 'Does not repeat'){
    //     $('#event_start_end_date_select').hide();
    //     $('#event_start_end_date_div').show();
    //     $('.custom-class').css('display','none');
    // }
    else
    {
        $('#event_start_end_date_select').show();
        // $('#event_start_end_date_div').hide();
        $('.custom-class').css('display','none');
    }
}
function showEndDateUpdate(value) 
{
    //debugger;
    if(value == "Does not repeat")
    {
        var check_start_date = $('#event_start_date_nnn').val();
        $(".update-category").find("input[name=event_end_date_nn]").val(moment(check_start_date).format('Y-MM-DD'));
    }

    if(value == "Daily" || value == "Does not repeat"){
        // $('#draggable_field').show();
        $('#draggable_event1').val("on");
    }else{
        // $('#draggable_field').hide();
        $('#draggable_event1').val("");
    }
    if(value == 'Custom'){
        
        var start_date_selected = $('#event_start_date_nnn').val();
        var end_date_selected = $('#event_end_date_nnn').val();
        var date1 = new Date(start_date_selected.split('-'));
        var date2 = new Date(end_date_selected.split('-'));
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        //console.log("Difference_In_Time");
        //console.log(Difference_In_Days);
        if(Difference_In_Days > 5){
            $('#event_start_end_date_select_update').show();
            //$('#event_start_end_date_div_update').hide();
            $('.custom-class-update').css('display','block');
        }else{
            for($i =1;$i<=7;$i++){
                $('#radioupdate'+$i).hide();
            }
            $('#event_start_end_date_select_update').show();
            //$('#event_start_end_date_div_update').hide();
            $('.custom-class-update').css('display','block');
            var dateArray = new Array();
            var currentDate = date1;
            while (currentDate <= date2) {
                dateArray.push(new Date (currentDate));
                currentDate = moment(currentDate).add(1, 'days');
            }
            var arrayLength = dateArray.length;
            for (var i = 0; i < arrayLength; i++) {
                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                $('#radioupdate'+day_new_value).show();
            }

        } 
    }
    // else if(value == 'Does not repeat')
    // {
    //     $('#event_start_end_date_select_update').hide();
    //     $('#event_start_end_date_div_update').show();
    //     $('.custom-class-update').css('display','none');
    // }
    else{
        $('#event_start_end_date_select_update').show();
        //$('#event_start_end_date_div_update').hide();
        $('.custom-class-update').css('display','none');
    }
}
function check_reminder(value){  
//debugger;   
    var check_new_value = $('#checkbox_value_get').val();
    if(check_new_value == 'true'){
        $('#checkbox_value_get').val("false");
        $('#date-time-section').hide();
        $('#old_reminder').hide();
        $('#new_reminder').show();
    }else{
        $('#checkbox_value_get').val("true");
        $('#date-time-section').show();
        $('#old_reminder').show();
        $('#new_reminder').hide();
    }

}
function check_reminder_update(value){    
//debugger;  
    var check_new_value = $('#checkbox_value_get_update').val();
    if(check_new_value == 'true'){
        $('#checkbox_value_get_update').val("false");
        $('#date-time-section1').hide();
        $('#old_reminder_update').hide();
        $('#new_reminder_update').show();
    }else{
        $('#checkbox_value_get_update').val("true");
        $('#date-time-section1').show();
        $('#old_reminder_update').show();
        $('#new_reminder_update').hide();
        $("#update-event").find("select[name=event_start_time]").select2().trigger('change');
        $("#update-event").find("select[name=event_end_time]").select2().trigger('change');
    }

}
function check_reminder_drag(value) {
   // alert();
   var check_new_value = $('#checkbox_value_get_drag').val();
   if (check_new_value == 'true') {
     $('#checkbox_value_get_drag').val("false");
     $('#old_reminder_drag').hide();
     $('#date-time-section-drag').hide();
     $('#new_reminder_drag').show();
   } else {
     $('#checkbox_value_get_drag').val("true");
     $('#old_reminder_drag').show();
     $('#date-time-section-drag').show();
     $('#new_reminder_drag').hide();
   }
 }
 function check_reminder_dragUpdate(value) {
   // alert();
   var check_new_value = $('#checkbox_value_get_drag_update').val();
   if (check_new_value == 'true') {
     //alert('1')
     $('#checkbox_value_get_drag_update').val("false");
     $('#old_reminder_drag_update').hide();
     $('#date-time-section-drag-update').hide();
     $('#new_reminder_drag_update').show();
   } else {
     //alert('2')
     $('#checkbox_value_get_drag_update').val("true");
     $('#old_reminder_drag_update').show();
     $('#date-time-section-drag-update').show();
     $('#new_reminder_drag_update').hide();
   }
 }
function dateChange(value){
    alert(value);
}

function event_type_task(){
    $('#created_type_event').prop('checked', false);
    $('#created_type_task').prop('checked', true);
    $('#created_type_reminder').prop('checked', false);
    $('#task_priority_div').show();
    $('#add_note_div').show();
}
function event_type_event(){
    $('#created_type_event').prop('checked', true);
    $('#created_type_task').prop('checked', false);
    $('#created_type_reminder').prop('checked', false);
    $('#task_priority_div').hide();
    $('#add_note_div').show();
}
function event_type_reminder(){
    $('#created_type_event').prop('checked', false);
    $('#created_type_task').prop('checked', false);
    $('#created_type_reminder').prop('checked', true);
    $('#add_note_div').hide();
    $('#task_priority_div').hide();
}
function customChange(){
    //console.log("customChangeFunction");
    //debugger;
    $('#custom_value').prop('disabled', false);
    var check_start_date = $('#event_start_date_nn').val();
    var check_end_date = $('#event_end_date_nn').val();
    var check_event_repeat_option = $(".create-category").find("select[name='event_repeat_option']").val();
    if(check_start_date == check_end_date)
    {
        $(".create-category").find("select[name='event_repeat_option']").val('Does not repeat');
        $('.custom-class').hide();
    }
    else
    {
        if(check_event_repeat_option == 'Does not repeat')
        {
            $(".create-category").find("select[name='event_repeat_option']").val('Daily');
        }
        else
        {
            $(".create-category").find("select[name='event_repeat_option']").val(check_event_repeat_option);
        }
    }

    var event_repeat_option = $('#event_repeat_option').val();
    //console.log("Ddfd"+event_repeat_option);
    if(event_repeat_option == "Custom"){
        for($i =1;$i<=7;$i++){
                $('#radioId'+$i).hide();
            }
            $('#event_start_end_date_select').show();
            //$('#event_start_end_date_div').hide();
            $('.custom-class').css('display','block'); 
            var start_date_selected = $('#event_start_date_nn').val();
            var end_date_selected = $('#event_end_date_nn').val();
            var date1 = new Date(start_date_selected.split('-'));
            var date2 = new Date(end_date_selected.split('-'));
            var dateArray = new Array();
            var currentDate = date1;
            while (currentDate <= date2) {
                dateArray.push(new Date (currentDate));
                currentDate = moment(currentDate).add(1, 'days');
            }
            var arrayLength = dateArray.length;
            //console.log("array_leng"+arrayLength);
            for (var i = 0; i < arrayLength; i++) {
                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                $('#radioId'+day_new_value).show();
            }
            
    }
    /////////   Event date time update
    var start_date_selected = $('#event_start_date_nn').val();
    var end_date_selected = $('#event_end_date_nn').val();
    var date1 = new Date(start_date_selected.split('-'));
    var startd = start_date_selected;
    let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd.split('-')).getDay()];
    let monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ][new Date(startd.split('-')).getMonth()];
    var start_day_value = new Date(startd.split('-')).getDate();
    $("#weekday_value").html("Weekly on "+weekday);
    $("#monthly_value").html("Monthly on "+start_day_value);
    $("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

    var start_update = new Date(start_date_selected.split('-')),
    end_update   = new Date(end_date_selected.split('-')),
    diff_update  = new Date(end_update - start_update),
    days_diff  = diff_update/1000/60/60/24;
    //console.log("days_diff");
    //console.log(days_diff);
    if(days_diff < 2){
        $("#custom_value").html("Custom (Please select more than 2 Days in date range!)");
        $('#custom_value').prop('disabled', true);
    }else{
        $("#custom_value").html("Custom");
        $('#custom_value').prop('disabled', false);
    }
    if(days_diff < 7){
        $("#weekday_value").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
        $('#weekday_value').prop('disabled', true);
    }else{
        $('#weekday_value').prop('disabled', false);
    }
    if(days_diff < 31){
        $("#monthly_value").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
        $('#monthly_value').prop('disabled', true);
    }else{
        $('#monthly_value').prop('disabled', false);
    }
    if(days_diff < 365){
        $("#yearly_value").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
        $('#yearly_value').prop('disabled', true);
    }else{
        $('#yearly_value').prop('disabled', false);
    }

}
function customChangeUpdate(){
    //console.log("Dfdfd");
    //debugger;
    $('.custom_value_update').prop('disabled', false);
    var check_start_date = $('#event_start_date_nnn').val();
    var check_end_date = $('#event_end_date_nnn').val();
    var check_event_repeat_option = $(".update-category").find("select[name='event_repeat_option']").val();
    if(check_start_date == check_end_date)
    {
        $(".update-category").find("select[name='event_repeat_option']").val('Does not repeat');
        $('.custom-class-update').hide();
    }
    else
    {
        if(check_event_repeat_option == 'Does not repeat')
        {
            $(".update-category").find("select[name='event_repeat_option']").val('Daily');
        }
        else
        {
            $(".update-category").find("select[name='event_repeat_option']").val(check_event_repeat_option);
        }
    }

    var event_repeat_option = $('.event_repeat_optionn').val();
    //console.log("event_repeat_optionkkk");
    //console.log(event_repeat_option);
    if(event_repeat_option == "Custom"){
        //console.log("custommmmmm");
        var start_date_selected = $('#event_start_date_nnn').val();
        var end_date_selected = $('#event_end_date_nnn').val();
        var date1 = new Date(start_date_selected.split('-'));
        var date2 = new Date(end_date_selected.split('-'));
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        //console.log("Difference_In_Time");
        //console.log(Difference_In_Days);
        if(Difference_In_Days > 5){
            $('#event_start_end_date_select_update').show();
            //$('#event_start_end_date_div_update').hide();
            $('.custom-class-update').css('display','block');
            for($i =1;$i<=7;$i++){
                $('#radioupdate'+$i).show();
            }
        }else{
            for($i =1;$i<=7;$i++){
                $('#radioupdate'+$i).hide();
            }
            $('#event_start_end_date_select_update').show();
            //$('#event_start_end_date_div_update').hide();
            $('.custom-class-update').css('display','block');
            var dateArray = new Array();
            var currentDate = date1;
            while (currentDate <= date2) {
                dateArray.push(new Date (currentDate));
                currentDate = moment(currentDate).add(1, 'days');
            }
            var arrayLength = dateArray.length;
            for (var i = 0; i < arrayLength; i++) {
                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                $('#radioupdate'+day_new_value).show();
            }

        }
    }
    /////////   Event date time update
    //console.log("rrrrrrrrrrr");
    var start_date_selected = $('#event_start_date_nnn').val();
    var end_date_selected = $('#event_end_date_nnn').val();
    var startd = start_date_selected;
    let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd.split('-')).getDay()];
    let monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ][new Date(startd.split('-')).getMonth()];
    var start_day_value = new Date(startd.split('-')).getDate();
    $(".weekday_value_update").html("Weekly on "+weekday);
    $(".monthly_value_update").html("Monthly on "+start_day_value);
    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames);

    var start_update = new Date(start_date_selected.split('-')),
    end_update   = new Date(end_date_selected.split('-')),
    diff_update  = new Date(end_update - start_update),
    days_diff  = diff_update/1000/60/60/24;
    //console.log("days_diff");
    //console.log(days_diff);
    if(days_diff < 2){
        $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
        $('.custom_value_update').prop('disabled', true);
    }else{
        $(".custom_value_update").html("Custom");
        $('.custom_value_update').prop('disabled', false);
    }
    if(days_diff < 7){
        $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
        $('.weekday_value_update').prop('disabled', true);
    }else{
        $('.weekday_value_update').prop('disabled', false);
    }
    if(days_diff < 31){
        $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
        $('.monthly_value_update').prop('disabled', true);
    }else{
        $('.monthly_value_update').prop('disabled', false);
    }
    if(days_diff < 365){
        $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
        $('.yearly_value_update').prop('disabled', true);
    }else{
        $('.yearly_value_update').prop('disabled', false);
    }
}
// $( function() {
//     $( "#task_start_date" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
//     // $( "#event_end_date_nn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
//     // $( "#event_start_end_date_new" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
//     // $( "#event_start_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
//     // $( "#event_end_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
//     // $( "#event_start_end_date_neww" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
// } );
function resetSelectDrag()
{
    $("#add-new-drag").modal('show');
    $("#add-new-drag").find("select[name=event_start_time]").select2().trigger('change');
    $("#add-new-drag").find("select[name=event_end_time]").select2().trigger('change');
}   
 
function reset_updateCalFrom()
{
    //console.log('1');
    var updatecategoryForm = $(".update-category");
    updatecategoryForm.trigger("reset");
    updatecategoryForm.find('#event_start_end_date_select_update').load(document.URL + ' #event_start_end_date_select_update>*'); 
        updatecategoryForm.find('#selected_color_update').removeClass (function (index, css) {
         return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
        });
        updatecategoryForm.find('#event_color').val('');
        updatecategoryForm.find('#selected_color_update_text').html('Choose a color...');
    $("input[type=radio][name=update_check_value]").prop('checked', false);
    $("#view-event").find('.modal-header').find('.delete-list-events').removeAttr('data-deval');
    $("#view-event").find('.modal-header').find('.edit-list-events').removeAttr('data-eval');
    $('#myModalUpdate').find('.modal-body').find('.update-next-event').removeAttr('data-stored-eval');
    $("#myModal").find('.modal-body').find('.delete-next-event').removeAttr('data-stored-deval');
    $('#update-event').modal('hide');
    $('#myModalUpdate').modal('hide');
}

function reset_updateOptions()
{
    //console.log('1');
    $("input[type=radio][name=update_check_value]").prop('checked', false);
    $('#myModalUpdate').modal('hide');
}

function reset_deleteOptions()
{
    //console.log('1');
    $("input[type=radio][name=delete_check_value]").prop('checked', false);
    $('#myModal').modal('hide');
}
///ADD NEW EVENT START///
function add_event_list_modal()
{
    //debugger;
    var addEvent=$("#add-new-events");
    var createEventForm = $(".create-category");
    $('#event_start_end_dateErr').html('');
    $('#cus_radioBTN').hide();
    $('#custom_value').prop('disabled', false);
    $('#weekday_value').prop('disabled', false);
    $('#monthly_value').prop('disabled', false);
    $('#yearly_value').prop('disabled', false);

    addEvent.modal('show');
            var start = moment().format('Y-MM-DD');
            var end = moment().add(1, 'days').format('Y-MM-DD');
            var week_class = $('.fc-timeGridWeek-button').hasClass('active');
            var day_class = $('.fc-timeGridDay-button').hasClass('active');
            var startd = moment(start).format('Y-MM-DD');

            if(week_class == true || day_class == true)
            {
                var ended = moment(end).format('Y-MM-DD');
            }
            else
            {
                var ended = moment(end).subtract(1, 'days').format('Y-MM-DD');
            }

            let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd.split('-')).getDay()];
            let monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
            ][new Date(startd.split('-')).getMonth()];
            // console.log(weekday);
            // console.log(monthNames);
            var start_day_value =  moment(start).format('DD');
            createEventForm.find("#weekday_value").html("Weekly on "+weekday);
            createEventForm.find("#monthly_value").html("Monthly on "+start_day_value);
            createEventForm.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);
            //console.log(start_day_value);
            // validation start //
            var start_update = new Date(start.split('-')),
            end_update   = new Date(ended.split('-')),
            diff_update  = new Date(end_update - start_update),
            days_diff  = diff_update/1000/60/60/24;
            //console.log(days_diff);
            if(days_diff < 2){
                createEventForm.find("#custom_value").html("Custom (Please select more than 2 Days in date range!)");
                $('#custom_value').prop('disabled', true);
            }
            else
            {
                createEventForm.find("#custom_value").html("Custom");
                $('#custom_value').prop('disabled', false);
            }
            if(days_diff < 7){
                createEventForm.find("#weekday_value").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
                $('#weekday_value').prop('disabled', true);
            }
            else
            {
                createEventForm.find("#weekday_value").html("Weekly on "+weekday);
                $('#weekday_value').prop('disabled', false);
            }
            if(days_diff < 31){
                createEventForm.find("#monthly_value").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
                $('#monthly_value').prop('disabled', true);
            }
            else
            {
                createEventForm.find("#monthly_value").html("Monthly on "+start_day_value);
                $('#monthly_value').prop('disabled', false);
            }
            if(days_diff < 365){
                createEventForm.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
                $('#yearly_value').prop('disabled', true);
            }
            else
            {
                createEventForm.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);
                $('#yearly_value').prop('disabled', false);
            }
            // validation end //
            createEventForm.find("input[name=event_start_date_nn]").val('');
            createEventForm.find("input[name=event_end_date_nn]").val('');
            //createEventForm.find("input[name=event_start_end_date_new]").val('');
            createEventForm.find("input[name=event_start_date_nn]").val(moment(startd).format('Y-MM-DD'));
            createEventForm.find("input[name=event_end_date_nn]").val(moment(ended).format('Y-MM-DD'));
            //createEventForm.find("input[name=event_start_end_date_new]").val(moment(startd).format('Y-MM-DD'));
            // $("#event_start_date_nn").datepicker({
            //     minDate: startd
            //   }).datepicker("setDate", startd);
            // $("#event_end_date_nn").datepicker({
            //     minDate: ended
            // }).datepicker("setDate", ended);
            // $("#event_start_end_date_new").datepicker({
            //     minDate: startd
            // }).datepicker("setDate", startd);

            if(startd === ended){
                //$('#event_start_end_date_div').show();
                //$('#event_start_end_date_select').hide();
                $('#event_start_end_date_select').show();
                createEventForm.find("select[name='event_repeat_option']").val('Does not repeat');
            }else{
                $('#event_start_end_date_select').show();
                //$('#event_start_end_date_div').hide();
                createEventForm.find("select[name='event_repeat_option']").val('Daily');
            }

            var start = moment(start).format('Y-MM-DD HH:mm');
            var currentDate = new Date(start);
            var start = moment(currentDate).format("hh:mm A"); 
            var end = moment(end).format("Y-MM-DD HH:mm");; 
            var end = moment(end).format("hh:mm A"); 
            if(start == '12:00 AM'){
                var start = '06:00 AM';
                var end = '06:30 AM';
            }

            $('#radioId1').hide();
            $('#radioId2').hide();
            $('#radioId3').hide();
            $('#radioId4').hide();
            $('#radioId5').hide();
            $('#radioId6').hide();
            $('#radioId7').hide();

            createEventForm.find("select[name=event_start_time]").val(start);
            createEventForm.find("select[name=event_start_time]").select2().trigger('change');
            createEventForm.find("select[name=event_end_time]").val(end);
            createEventForm.find("select[name=event_end_time]").select2().trigger('change');

            createEventForm.find('.close-category').unbind('click').click(function () {
                //console.log('1');
                createEventForm.trigger("reset");
                createEventForm.find('#event_start_end_date_select').load(document.URL + ' #event_start_end_date_select>*'); 
                    createEventForm.find('#selected_color').removeClass (function (index, css) {
                     return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
                    });
                    createEventForm.find('#event_color').val('');
                    createEventForm.find('#selected_color_text').html('Choose a color...');
            });
}
///ADD NEW EVENT END///

///VIEW EVENT START///
function EventListViewModal(id)
{
    // debugger;
var viewEvent=$("#view-event");
var event_id = id;                   
$.ajax({
    type: "POST",
    url: base_url+'front/view_selected_event_info_list',
    type: 'POST',
    data: {
        event_id:event_id 
    }, 
    success: function(data){
    // debugger;
    if(data.status == true)
    {
        //debugger;
       var task_start_date_new = data.task_start_date;
       var task_end_date_new = data.task_end_date;
       var task_evt_color = data.task_evt_color;
       var task_evt_title = data.task_evt_title;
       var task_evt_allday = data.task_evt_allday;
       var task_evt_start_time = data.task_evt_start_time;
       var task_evt_end_time = data.task_evt_end_time;
       var task_evt_reminder = data.task_evt_reminder;
       var task_evt_event_repeat_option_type = data.task_evt_event_repeat_option_type;
       var task_evt_note = data.task_evt_note;
       var task_evt_created_type = data.task_evt_created_type;
       var task_evt_unique_key = data.task_evt_unique_key;
       var task_evt_task_priority = data.task_evt_task_priority;

       var date12 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
       var date14 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
       //console.log("date12");
       //console.log(date12);
      // return false;
       var start_date = moment(task_start_date_new).format("Y-MM-DD HH:mm:ss");
        var allDay = task_evt_allday;
        if(allDay == 'false'){
            if(data.startDate == data.endDate){
                var date1 = moment(data.startDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var time1 = moment(task_evt_start_time, 'HH:mm').format('hh:mm A');
                var time2 = moment(task_evt_end_time, 'HH:mm').format('hh:mm A');
                var eventdate = date1 + ', ' + time1+ ' - ' + time2;
            }else{
                var date1 = moment(data.startDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var date2 = moment(data.endDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var time1 = moment(task_evt_start_time, 'HH:mm').format('hh:mm A');
                var time2 = moment(task_evt_end_time, 'HH:mm').format('hh:mm A');
                var eventdate = date1 + ', ' + time1 + ' - ' + date2 + ', ' + time2;
            }
            var eventallDay = '';
        }else{
            var end_date = task_end_date_new + ' 00:00:00';
            if(data.startDate == data.endDate){
                var date1 = moment(data.startDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var eventdate = date1;
            }else{
                var date1 = moment(data.startDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var date2 = moment(data.endDate, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                var eventdate = date1 +' - '+ date2;
            }
            var eventallDay = '&nbsp;&nbsp;-&nbsp;&nbsp;All Day Event';
        }  
        if(task_evt_reminder != 'No reminder'){
            var eventReminder = '<div class="col-md-1"><i class="fa fa-bell"></i></div><div class="col-md-5"><p class="event-reminder">' + task_evt_reminder + '</p></div>';
        }else{
            var eventReminder = '';
        }  
        if(task_evt_event_repeat_option_type != 'Does not repeat'){
            var eventRepeatOption = '<div class="col-md-1"><i class="fa fa-sync"></div><div class="col-md-5"></i><p class="event-repeatoption">' + task_evt_event_repeat_option_type + '</p></div>';
        }else{
            var eventRepeatOption = '<div class="col-md-1"><i class="fa fa-arrow-right"></div><div class="col-md-5"></i><p class="event-repeatoption">' + task_evt_event_repeat_option_type + '</p></div>';
        } 
        if(task_evt_title != ''){
            if(task_evt_title.length > 80){  
            var typee = "'event_name'";  
                var eventTitle = task_evt_title.substr(0, 80) +'<a class="readmore read-moreevent_name'+event_id+'" onclick="return readMoreContent('+typee+','+event_id+');"> Read more</a><span class="show-moreevent_name'+event_id+'" style="display: none;">'+task_evt_title.substr(80)+' <a class="readless read-lessevent_name'+event_id+'" onclick="return readLess('+typee+','+event_id+');">Read less</a></span>';
            }else{
                var eventTitle = task_evt_title;
            }
            
        }else{
            var eventTitle = '';
        }

        if(task_evt_note != ''){
            if(task_evt_note.length > 120){  
            var typee = "'event'";  
                var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ task_evt_note.substr(0, 120) +'<a class="readmore read-moreevent'+event_id+'" onclick="return readMoreContent('+typee+','+event_id+');"> Read more</a><span class="show-moreevent'+event_id+'" style="display: none;">'+task_evt_note.substr(120)+' <a class="readless read-lessevent'+event_id+'" onclick="return readLess('+typee+','+event_id+');">Read less</a></span></p></div>';
            }else{
                var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ task_evt_note +'</p></div>';
            }
            
        }else{
            var eventNote = '';
        } 
        
        if(task_evt_created_type != ''){
            if(task_evt_created_type == 'task'){  
                var taskPriority = '<div class="col-md-1"><i class="fa fa-level-up-alt"></div><div class="col-md-5"></i><p class="event-repeatoption">' + task_evt_task_priority + '</p></div>';
            }else{
                var taskPriority = '';
            }
            
        }else{
            var taskPriority = '';
        } 

        if(task_evt_created_type == 'task'){  
                var geteventType = 'To Do';
            }else{
                var geteventType = task_evt_created_type;
            }
        var event_color = task_evt_color;
        //console.log(event_color); 
        var event_div = $('<div class="event-modal"></div>');
            event_div.append('<div class="row first-row"></div>');
            event_div.find('.first-row')
                    .append('<div class="col-md-12"><h3 class="event-title"><small><i class="'+ event_color +' event-color-cus-icon event-color-icon"></i></small>&nbsp;' + eventTitle + '</h3><small class="event-datetime">' + eventdate + '</small><small class="event-allday">' + eventallDay + '</small></div>');
            event_div.append('<br><div class="row second-row"></div>');   
            event_div.find('.second-row')    
                    .append(eventNote)
                    .append(taskPriority)
                    .append(eventReminder)
                    .append(eventRepeatOption)
                    .append('<div class="col-md-1"><i class="fa fa-list"></i></div><div class="col-md-5"><p class="event-task"> My ' + geteventType + '</p></div><input type="hidden" name="event_id" value="' + event_id + '" >');
            
            viewEvent.find('.modal-header').find('.delete-list-events').attr('data-deval',event_id);
            viewEvent.find('.modal-header').find('.edit-list-events').attr('data-eval',event_id);
            viewEvent.find('.modal-header').find('.refresh-list-events').attr('data-refresheval',event_id);
            viewEvent.modal('show');
            //viewEvent.find('.view_label_modal').html(eventTitle);

            //$('#add-todo').find('#cl_task_start_date').load(document.URL + ' #cl_task_start_date>*'); 

            viewEvent.find('.modal-body').empty().prepend(event_div).end();
            $('#add-todo').find("input[name=event_id]").val(event_id);
            $('#add-todo').find("input[name=event_unique_key]").val(task_evt_unique_key);
            $('#add-todo').find("input[name=get_task_start_date]").val(data.endDate);
            // $('#add-todo').find("#event_id").select2().trigger('change');
            $('#add-todo').find("input[name=task_start_date]").val(data.endDate);
            
            //console.log(task_end_date_new);
            //$(".cl_task_start_date").datepicker({format: 'yyyy-mm-dd',autoclose: true, maxDate: '2022-10-25'});
            //$("#task_start_date").datepicker("setDate", new Date(task_end_date_new)).datepicker("setEndDate", new Date(task_end_date_new));
            
            //console.log($("#task_start_date").datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date('2022-10-25')}));
            $.ajax({
                  url: base_url+'front/restrict_task_start_time',
                  method: 'POST',
                  data: {event_id:event_id},  
                  success: function(data) {
                      $('#add-todo').find(".task_create_event_start_time").html(data);
                      //console.log(data);                   
                  }
            });
            $.ajax({
                  type: "POST",
                  url: base_url+'front/calendar_get_inside_event_todo',
                  type: 'POST',
                  data: {
                      event_id:event_id
                  },
                  success: function(data){
                      viewEvent.find('.modal-body-inside-todo').empty().prepend(data).end();
                  }
            });
    }
    }
});
}
///VIEW EVENT END///


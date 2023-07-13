//[calendar Javascript]
var base_url = 'http://localhost/decision168/';
!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {             
            var addEvent=$("#add-new-events");
            var viewEvent=$("#view-event");
            var myModal = $('#myModal');
            var myModalUpdate = $('#myModalUpdate');
            var updateEventModal=$("#update-event");
            var modalTitle = $("#modal-title");
            var formEvent = $("#form-event");
            var createEventForm = $(".create-category");
            var updatecategoryForm = $(".update-category");
            var extEvents = $('#external-events');
            var newEventData = null;
            var forms = document.getElementsByClassName('needs-validation');
            var calEvent = null;
            var calEventinfo = null;
            var newEventData = null;
            var eventObject = null;
            var task_evt_color = null;
            var portfolio_update = null;
            /* initialize the calendar */

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var today = new Date($.now());
            var month_year = today;
            var Draggable = FullCalendarInteraction.Draggable;
            var externalEventContainerEl = document.getElementById('external-events');
            // init dragable
            new Draggable(externalEventContainerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        id: $(eventEl).attr('id'),
                        className: $(eventEl).attr('data-class'),
                        title: eventEl.innerText,
                    };
                }
            });
            var event_data = function () {
                //debugger;
                var evt = null;
                $.ajax({
                    method: "POST",
                    async: false,
                    data: {
                        month_year:month_year,
                    },
                    url: base_url+'front/get_calendar_events',            
                    success: function(data){
                        var db_events = data; 
                        function renameKey(obj, old_key, new_key) {   
                            // check if old key = new key  
                            if (old_key !== new_key) {                  
                                Object.defineProperty(obj, new_key, // modify old key
                                // fetch description from object
                                Object.getOwnPropertyDescriptor(obj, old_key));
                                delete obj[old_key]; // delete old key
                            }
                        }

                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                        var lim = db_events.length;
                        for (var i = 0; i < lim; i++)
                        {                        
                            if(db_events[i].type == 'event'){
                                if(db_events[i].event_allDay == 'true')
                                {
                                    var dateFormatTotime = new Date(db_events[i].event_end_date);
                                    var increasedDate = new Date(dateFormatTotime.getTime() +(1 *86400000));                                
                                    var end_date_new = moment(increasedDate, 'Y-MM-DD').format('YYYY-MM-DD');
                                    db_events[i].event_end_date = end_date_new;
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                db_events[i].event_id = db_events[i].id;

                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'record-circle-outline';
                                }else if(icon_val == "meeting"){
                                    db_events[i].icon = 'link-variant';
                                }else{
                                    db_events[i].icon = 'calendar-check';
                                }

                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();

            var defaultEvents = event_data;
            var draggableEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');            

            var calendar = new FullCalendar.Calendar(calendarEl, {
                //plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar'],
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                editable: true,
                droppable: true,
                selectable: true,
                eventLimit: true,
                displayEventTime : false,
                defaultView: 'dayGridMonth',
                showNonCurrentDates: false, 
                handleWindowResize: true, 
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,dayGridDay'
                },    
                customButtons: {
                    today: {
                         text: 'Today',
                         click: function() {
                            //debugger;
                            calendar.today();
                            var view = calendar.view;
                            //console.log(view);
                            var month_year = view.title;
                            var event_data = function () {
                                var evt = null;
                                $.ajax({
                                    method: "POST",
                                    async: false,
                                    data: {
                                        month_year:month_year, button:'today',
                                    },
                                    url: base_url+'front/get_allcalendar_events',            
                                    success: function(data){
                                        var db_events = data; 
                                        function renameKey(obj, old_key, new_key) {   
                                            // check if old key = new key  
                                            if (old_key !== new_key) {                  
                                                Object.defineProperty(obj, new_key, // modify old key
                                                // fetch description from object
                                                Object.getOwnPropertyDescriptor(obj, old_key));
                                                delete obj[old_key]; // delete old key
                                            }
                                        }
                                        
                                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                        var lim = db_events.length;
                                        for (var i = 0; i < lim; i++)
                                        {                        
                                            if(db_events[i].type == 'event'){
                                                if(db_events[i].event_allDay == 'true')
                                                {
                                                    db_events[i].allDay = true;
                                                }else{
                                                    db_events[i].allDay = false;
                                                }
                                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                db_events[i].event_id = db_events[i].id;
                                                
                                                var icon_val = db_events[i].created_type;
                                                if(icon_val == "reminder"){
                                                    db_events[i].icon = 'bell';
                                                }else if(icon_val == "task"){
                                                    db_events[i].icon = 'record-circle-outline';
                                                }else if(icon_val == "meeting"){
                                                    db_events[i].icon = 'link-variant';
                                                }else{
                                                    db_events[i].icon = 'calendar-check';
                                                }

                                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                db_events[i].new_time = time11+'-'+time22;
                                                if(db_events[i].draggable_event == "on"){
                                                    db_events[i].editable = true;
                                                }else{
                                                    db_events[i].editable = false;
                                                }
                                            }
                                        }
                                        evt = db_events; 

                                    }
                                });
                                return evt;
                            }();
                            if(event_data)
                            {
                               var len = event_data.length;
                                for (var i = 0; i < len; i++) { 
                                    //console.log(event_data[i].id);
                                    var event = calendar.getEventById(event_data[i].id);
                                    if(event != null){
                                        event.remove();
                                    }                             
                                }  
                                calendar.addEventSource(event_data);
                            } 
                            //calendar.today();
                        }
                    },
                    dayGridMonth: {
                         text: 'Month',
                         click: function() {
                            //debugger;
                            calendar.changeView('dayGridMonth');
                            var view = calendar.view;
                            var month_year = view.title;
                            var event_data = function () {
                                var evt = null;
                                $.ajax({
                                    method: "POST",
                                    async: false,
                                    data: {
                                        month_year:month_year, button:'month',
                                    },
                                    url: base_url+'front/get_allcalendar_events',            
                                    success: function(data){
                                        var db_events = data; 
                                        function renameKey(obj, old_key, new_key) {   
                                            // check if old key = new key  
                                            if (old_key !== new_key) {                  
                                                Object.defineProperty(obj, new_key, // modify old key
                                                // fetch description from object
                                                Object.getOwnPropertyDescriptor(obj, old_key));
                                                delete obj[old_key]; // delete old key
                                            }
                                        }

                                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                        var lim = db_events.length;
                                        for (var i = 0; i < lim; i++)
                                        {                        
                                            if(db_events[i].type == 'event'){
                                                if(db_events[i].event_allDay == 'true')
                                                {
                                                    db_events[i].allDay = true;
                                                }else{
                                                    db_events[i].allDay = false;
                                                }
                                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                db_events[i].event_id = db_events[i].id;
                                                
                                                var icon_val = db_events[i].created_type;
                                                if(icon_val == "reminder"){
                                                    db_events[i].icon = 'bell';
                                                }else if(icon_val == "task"){
                                                    db_events[i].icon = 'record-circle-outline';
                                                }else if(icon_val == "meeting"){
                                                    db_events[i].icon = 'link-variant';
                                                }else{
                                                    db_events[i].icon = 'calendar-check';
                                                }

                                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                db_events[i].new_time = time11+'-'+time22;
                                                if(db_events[i].draggable_event == "on"){
                                                    db_events[i].editable = true;
                                                }else{
                                                    db_events[i].editable = false;
                                                }
                                            }
                                        }
                                        evt = db_events; 

                                    }
                                });
                                return evt;
                            }();
                            if(event_data)
                            {
                               var len = event_data.length;
                                for (var i = 0; i < len; i++) { 
                                    var event = calendar.getEventById(event_data[i].id);
                                    if(event != null){
                                        event.remove();
                                    }                             
                                }  
                                calendar.addEventSource(event_data);
                            } 
                            //calendar.changeView('dayGridMonth');
                        }
                    },
                    timeGridWeek: {
                         text: 'Week',
                         click: function() {
                            //debugger;
                            calendar.changeView('timeGridWeek');
                            var view = calendar.view;
                            var month_year = view.title;
                            var event_data = function () {
                                var evt = null;
                                $.ajax({
                                    method: "POST",
                                    async: false,
                                    data: {
                                        month_year:month_year, button:'week',
                                    },
                                    url: base_url+'front/get_allcalendar_events',            
                                    success: function(data){
                                        var db_events = data; 
                                        function renameKey(obj, old_key, new_key) {   
                                            // check if old key = new key  
                                            if (old_key !== new_key) {                  
                                                Object.defineProperty(obj, new_key, // modify old key
                                                // fetch description from object
                                                Object.getOwnPropertyDescriptor(obj, old_key));
                                                delete obj[old_key]; // delete old key
                                            }
                                        }

                                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                        var lim = db_events.length;
                                        for (var i = 0; i < lim; i++)
                                        {                        
                                            if(db_events[i].type == 'event'){
                                                if(db_events[i].event_allDay == 'true')
                                                {
                                                    db_events[i].allDay = true;
                                                }else{
                                                    db_events[i].allDay = false;
                                                }
                                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                db_events[i].event_id = db_events[i].id;
                                                
                                                var icon_val = db_events[i].created_type;
                                                if(icon_val == "reminder"){
                                                    db_events[i].icon = 'bell';
                                                }else if(icon_val == "task"){
                                                    db_events[i].icon = 'record-circle-outline';
                                                }else if(icon_val == "meeting"){
                                                    db_events[i].icon = 'link-variant';
                                                }else{
                                                    db_events[i].icon = 'calendar-check';
                                                }

                                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                db_events[i].new_time = time11+'-'+time22;
                                                if(db_events[i].draggable_event == "on"){
                                                    db_events[i].editable = true;
                                                }else{
                                                    db_events[i].editable = false;
                                                }
                                            }
                                        }
                                        evt = db_events; 

                                    }
                                });
                                return evt;
                            }();
                            if(event_data)
                            {
                               var len = event_data.length;
                                for (var i = 0; i < len; i++) { 
                                    var event = calendar.getEventById(event_data[i].id);
                                    if(event != null){
                                        event.remove();
                                    }                             
                                }  
                                calendar.addEventSource(event_data);
                            } 
                            //calendar.changeView('timeGridWeek');
                        }
                    },
                    timeGridDay: {
                         text: 'Day',
                         click: function() {
                            //debugger;
                            calendar.changeView('timeGridDay');
                            var view = calendar.view;
                            //console.log(view);
                            var month_year = view.title;
                            var event_data = function () {
                                var evt = null;
                                $.ajax({
                                    method: "POST",
                                    async: false,
                                    data: {
                                        month_year:month_year, button:'day',
                                    },
                                    url: base_url+'front/get_allcalendar_events',            
                                    success: function(data){
                                        var db_events = data; 
                                        function renameKey(obj, old_key, new_key) {   
                                            // check if old key = new key  
                                            if (old_key !== new_key) {                  
                                                Object.defineProperty(obj, new_key, // modify old key
                                                // fetch description from object
                                                Object.getOwnPropertyDescriptor(obj, old_key));
                                                delete obj[old_key]; // delete old key
                                            }
                                        }

                                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                        var lim = db_events.length;
                                        for (var i = 0; i < lim; i++)
                                        {                        
                                            if(db_events[i].type == 'event'){
                                                if(db_events[i].event_allDay == 'true')
                                                {
                                                    var dateFormatTotime = new Date(db_events[i].event_end_date);
                                                    var increasedDate = new Date(dateFormatTotime.getTime() +(1 *86400000));                                
                                                    var end_date_new = moment(increasedDate, 'Y-MM-DD').format('YYYY-MM-DD');
                                                    db_events[i].event_end_date = end_date_new;
                                                    db_events[i].allDay = true;
                                                }else{
                                                    db_events[i].allDay = false;
                                                }
                                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                db_events[i].event_id = db_events[i].id;
                                                
                                                var icon_val = db_events[i].created_type;
                                                if(icon_val == "reminder"){
                                                    db_events[i].icon = 'bell';
                                                }else if(icon_val == "task"){
                                                    db_events[i].icon = 'record-circle-outline';
                                                }else if(icon_val == "meeting"){
                                                    db_events[i].icon = 'link-variant';
                                                }else{
                                                    db_events[i].icon = 'calendar-check';
                                                }

                                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                db_events[i].new_time = time11+'-'+time22;
                                                if(db_events[i].draggable_event == "on"){
                                                    db_events[i].editable = true;
                                                }else{
                                                    db_events[i].editable = false;
                                                }
                                            }
                                        }
                                        evt = db_events; 

                                    }
                                });
                                return evt;
                            }();
                            if(event_data)
                            {
                               var len = event_data.length;
                                for (var i = 0; i < len; i++) { 
                                    var event = calendar.getEventById(event_data[i].id);
                                    if(event != null){
                                        event.remove();
                                    }                             
                                }  
                                calendar.addEventSource(event_data);
                            } 
                            //calendar.changeView('timeGridDay');
                        }
                    },
                    dayGridDay: {
                         text: 'List',
                         click: function() {
                            //debugger;
                            calendar.changeView('dayGridDay');
                            var view = calendar.view;
                            //console.log(view);
                            var month_year = view.title;
                            var event_data = function () {
                                var evt = null;
                                $.ajax({
                                    method: "POST",
                                    async: false,
                                    data: {
                                        month_year:month_year, button:'list',
                                    },
                                    url: base_url+'front/get_allcalendar_events',            
                                    success: function(data){
                                        var db_events = data; 
                                        function renameKey(obj, old_key, new_key) {   
                                            // check if old key = new key  
                                            if (old_key !== new_key) {                  
                                                Object.defineProperty(obj, new_key, // modify old key
                                                // fetch description from object
                                                Object.getOwnPropertyDescriptor(obj, old_key));
                                                delete obj[old_key]; // delete old key
                                            }
                                        }

                                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                        var lim = db_events.length;
                                        for (var i = 0; i < lim; i++)
                                        {                        
                                            if(db_events[i].type == 'event'){
                                                if(db_events[i].event_allDay == 'true')
                                                {
                                                    var dateFormatTotime = new Date(db_events[i].event_end_date);
                                                    var increasedDate = new Date(dateFormatTotime.getTime() +(1 *86400000));                                
                                                    var end_date_new = moment(increasedDate, 'Y-MM-DD').format('YYYY-MM-DD');
                                                    db_events[i].event_end_date = end_date_new;
                                                    db_events[i].allDay = true;
                                                }else{
                                                    db_events[i].allDay = false;
                                                }
                                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                db_events[i].event_id = db_events[i].id;
                                                
                                                var icon_val = db_events[i].created_type;
                                                if(icon_val == "reminder"){
                                                    db_events[i].icon = 'bell';
                                                }else if(icon_val == "task"){
                                                    db_events[i].icon = 'record-circle-outline';
                                                }else if(icon_val == "meeting"){
                                                    db_events[i].icon = 'link-variant';
                                                }else{
                                                    db_events[i].icon = 'calendar-check';
                                                }

                                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                db_events[i].new_time = time11+'-'+time22;
                                                if(db_events[i].draggable_event == "on"){
                                                    db_events[i].editable = true;
                                                }else{
                                                    db_events[i].editable = false;
                                                }
                                            }
                                        }
                                        evt = db_events; 

                                    }
                                });
                                return evt;
                            }();
                            if(event_data)
                            {
                               var len = event_data.length;
                                for (var i = 0; i < len; i++) { 
                                    var event = calendar.getEventById(event_data[i].id);
                                    if(event != null){
                                        event.remove();
                                    }                             
                                }  
                                calendar.addEventSource(event_data);
                            } 
                            //calendar.changeView('dayGridDay');
                        }
                    },
                  prev: {
                    text: 'Prev',
                    click: function() {
                        //debugger;
                        calendar.prev();
                        var view = calendar.view;
                        var month_year = view.title;
                        var event_data = function () {
                            var evt = null;
                            $.ajax({
                                method: "POST",
                                async: false,
                                data: {
                                    month_year:month_year, button:'prev',
                                },
                                url: base_url+'front/get_allcalendar_events',            
                                success: function(data){
                                    var db_events = data; 
                                    function renameKey(obj, old_key, new_key) {   
                                        // check if old key = new key  
                                        if (old_key !== new_key) {                  
                                            Object.defineProperty(obj, new_key, // modify old key
                                            // fetch description from object
                                            Object.getOwnPropertyDescriptor(obj, old_key));
                                            delete obj[old_key]; // delete old key
                                        }
                                    }
                                    
                                    db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                    db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                    var lim = db_events.length;
                                    for (var i = 0; i < lim; i++)
                                    {                        
                                        if(db_events[i].type == 'event'){
                                            if(db_events[i].event_allDay == 'true')
                                            {
                                                var dateFormatTotime = new Date(db_events[i].event_end_date);
                                                var increasedDate = new Date(dateFormatTotime.getTime() +(1 *86400000));                                
                                                var end_date_new = moment(increasedDate, 'Y-MM-DD').format('YYYY-MM-DD');
                                                db_events[i].event_end_date = end_date_new;
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                            db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                            db_events[i].event_id = db_events[i].id;
                                            
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'record-circle-outline';
                                            }else if(icon_val == "meeting"){
                                                db_events[i].icon = 'link-variant';
                                            }else{
                                                db_events[i].icon = 'calendar-check';
                                            }

                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                        }
                                    }
                                    evt = db_events; 

                                }
                            });
                            return evt;
                        }();
                        if(event_data)
                        {
                           var len = event_data.length;
                            for (var i = 0; i < len; i++) { 
                                var event = calendar.getEventById(event_data[i].id);
                                if(event != null){
                                    event.remove();
                                }                             
                            }  
                            calendar.addEventSource(event_data);
                        } 
                        //calendar.prev();
                    }
                  },
                  next: {
                    text: 'Next',
                    click: function() {
                        //debugger;
                        calendar.next();
                        var view = calendar.view;
                        var month_year = view.title;
                        var event_data = function () {
                            var evt = null;
                            $.ajax({
                                method: "POST",
                                async: false,
                                data: {
                                    month_year:month_year, button:'next',
                                },
                                url: base_url+'front/get_allcalendar_events',            
                                success: function(data){
                                    var db_events = data; 
                                    //console.log(data);
                                    function renameKey(obj, old_key, new_key) {   
                                        // check if old key = new key  
                                        if (old_key !== new_key) {                  
                                            Object.defineProperty(obj, new_key, // modify old key
                                            // fetch description from object
                                            Object.getOwnPropertyDescriptor(obj, old_key));
                                            delete obj[old_key]; // delete old key
                                        }
                                    }
                                    
                                    db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                    db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));

                                    var lim = db_events.length;
                                    for (var i = 0; i < lim; i++)
                                    {                        
                                        if(db_events[i].type == 'event'){
                                            if(db_events[i].event_allDay == 'true')
                                            {
                                                var dateFormatTotime = new Date(db_events[i].event_end_date);
                                                var increasedDate = new Date(dateFormatTotime.getTime() +(1 *86400000));                                
                                                var end_date_new = moment(increasedDate, 'Y-MM-DD').format('YYYY-MM-DD');
                                                db_events[i].event_end_date = end_date_new;
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                            db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                            db_events[i].event_id = db_events[i].id;
                                            
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'record-circle-outline';
                                            }else if(icon_val == "meeting"){
                                                db_events[i].icon = 'link-variant';
                                            }else{
                                                db_events[i].icon = 'calendar-check';
                                            }

                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                        }
                                    }
                                    evt = db_events; 
                                }
                            });
                            return evt;
                        }();
                        if(event_data)
                        {
                           var len = event_data.length;
                            for (var i = 0; i < len; i++) { 
                                var event = calendar.getEventById(event_data[i].id);
                                if(event != null){
                                    event.remove();
                                }                             
                            }  
                            calendar.addEventSource(event_data);
                        }                        
                        //calendar.next();
                    }
                  },
                },       
                views: 
                {
                    dayGridMonth: {
                      eventLimit: 3 // allow "more" link when too many events
                    },
                },     
                eventReceive: function( info ) { // drag draggable events on calendar
                    //debugger;
                  //get the bits of data we want to send into a simple object
                    var drag_id = $(info.draggedEl).attr('id');
                    var drag_date = moment(info.event.start).format('Y-MM-DD HH:mm:ss');
                    var dd = drag_date.split(' ');
                    var day_type = $(info.view.el).attr('class');
                    if(day_type == 'fc-view fc-timeGridDay-view fc-timeGrid-view' || day_type == 'fc-view fc-timeGridWeek-view fc-timeGrid-view'){
                        if(dd[1] == '00:00:00'){
                            var allDay = 'true'; // All Day Event
                        }else{
                            var allDay = 'false'; // No All Day Event
                        } 
                    }else{
                       var allDay = 'true_false'; //Month Event
                    }

                    $.ajax({
                        type: "POST",
                        async: false,
                        url: base_url+'front/insert_drop_event',
                        data: {
                           drag_id:drag_id, drag_date:drag_date, allDay:allDay,
                        },
                        success: function(data) {
                            if(data.allDay == 'true'){
                                var allDay = true;
                            }else{
                                var allDay = false;
                            }
                            //console.log(info.event.id);
                            //console.log(data.event_id);
                            var event = calendar.getEventById(info.event.id);
                            event.remove();

                            // var newEvent = {
                            //     student_id: data.student_id,
                            //     event_id: data.event_id,
                            //     id: data.event_id,
                            //     title: data.event_name,
                            //     className: data.event_color,
                            //     allDay: allDay,
                            //     type: data.type,
                            //     event_start_date: data.event_start_date,
                            //     event_end_date: data.event_end_date,
                            //     event_note: data.event_note,
                            //     event_start_time: data.event_start_time,
                            //     event_end_time: data.event_end_time,
                            //     event_repeat_option: data.event_repeat_option,                                
                            //     event_repeat_option_type: data.event_repeat_option_type,
                            //     created_type: data.created_type,
                            //     event_reminder: data.event_reminder,
                            //     draggable_event: data.draggable_event,
                            //     draggable_id: data.draggable_id,
                            //     drag_id: data.drag_id,
                            //     start: data.start_date,
                            //     end: data.end_date,
                            // }
                            // calendar.addEvent(newEvent); 

                            //////// reload data
                                var view = calendar.view;
                                //console.log(view);
                                var month_year = view.title;
                                var event_data = function () {
                                    var evt = null;
                                    $.ajax({
                                        method: "POST",
                                        async: false,
                                        data: {
                                            month_year:month_year, button:'today',
                                        },
                                        url: base_url+'front/get_allcalendar_events',            
                                        success: function(data){
                                            //console.log("testt");
                                            var db_events = data; 
                                            function renameKey(obj, old_key, new_key) {   
                                                // check if old key = new key  
                                                if (old_key !== new_key) {                  
                                                    Object.defineProperty(obj, new_key, // modify old key
                                                    // fetch description from object
                                                    Object.getOwnPropertyDescriptor(obj, old_key));
                                                    delete obj[old_key]; // delete old key
                                                }
                                            }
                                            db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                            db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                                            
                                            var lim = db_events.length;
                                            for (var i = 0; i < lim; i++)
                                            {                        
                                                if(db_events[i].type == 'event'){
                                                    if(db_events[i].event_allDay == 'true')
                                                    {
                                                        db_events[i].allDay = true;
                                                    }else{
                                                        db_events[i].allDay = false;
                                                    }
                                                    db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                    db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                    db_events[i].event_id = db_events[i].id;
                                                    
                                                    var icon_val = db_events[i].created_type;
                                                    if(icon_val == "reminder"){
                                                        db_events[i].icon = 'bell';
                                                    }else if(icon_val == "task"){
                                                        db_events[i].icon = 'record-circle-outline';
                                                    }else if(icon_val == "meeting"){
                                                        db_events[i].icon = 'link-variant';
                                                    }else{
                                                        db_events[i].icon = 'calendar-check';
                                                    }

                                                    var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                    var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                    db_events[i].new_time = time11+'-'+time22;
                                                    if(db_events[i].draggable_event == "on"){
                                                        db_events[i].editable = true;
                                                    }else{
                                                        db_events[i].editable = false;
                                                    }
                                                }
                                            }
                                            evt = db_events; 

                                        }
                                    });
                                    return evt;
                                }();
                                if(event_data)
                                {
                                   var len = event_data.length;
                                    for (var i = 0; i < len; i++) { 
                                        //console.log(event_data[i].id);
                                        var event = calendar.getEventById(event_data[i].id);
                                        if(event != null){
                                            event.remove();
                                        }                             
                                    }  
                                    calendar.addEventSource(event_data);
                                }   

                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                //debugger;
                                $.ajax({
                                    type: "POST",
                                    async: false,
                                    url: base_url+'front/delete_draggable_event',
                                    data: {
                                       drag_id:drag_id,
                                    },
                                    success: function(data) {
                                        //console.log(drag_id);
                                        // if so, remove the element from the "Draggable Events" list
                                        $('.drag-event'+drag_id).remove();
                                        $('#drop-remove').prop('checked', false).blur();
                                    }
                                });
                            }                     
                        }
                    });
                },
                eventClick: function(info) {
                    // debugger;
                    var get_url = $.trim(info.event._def.url);
                    // console.log(get_url);
                    if(get_url == '')
                    {
                    calEventinfo = info.event;
                    calEvent = info.event.extendedProps;
                    var event_new_id = calEvent.event_id; 

                    ///VIEW EVENT START///                   
                    $.ajax({
                        type: "POST",
                        url: base_url+'front/view_selected_event_info',
                        type: 'POST',
                        data: {
                            event_id:event_new_id 
                        }, 
                        success: function(data){
                            //debugger;
                           var task_start_date_new = data.task_start_date;
                           var task_end_date_new = data.task_end_date;
                           var get_port_name = data.get_port_name;
                           var get_meeting_members_invitees = data.get_meeting_members_invitees; 
                           var get_meeting_members_attendees = data.get_meeting_members_attendees;
                           var get_meeting_Owner_name = data.get_meeting_Owner_name;
                           var get_meeting_owner = data.get_meeting_owner;
                           var meeting_files = data.meeting_files; 
                           var timeZone = data.timeZone;
                           var call_rate = data.call_rate;                         
                           var expert_name = data.expert_name;                         
                           var book_user_name = data.book_user_name;                         
                           var call_payment = data.call_payment;                         
                           var call_status = data.call_status;                         
                           var reject_reason = data.reject_reason;   

                           if(calEvent.created_type == 'Video Session'){
                            var eventCallSession = '<div class="col-md-1"><i class="fas fa-user-clock font-weight-semibold"></i></div><div class="col-md-5"><p class="event-repeatoption"><strong>User Name:</strong> <span class="badge badge-soft-success p-1 ms-1 font-size-12">'+book_user_name+'</span></p></div><div class="col-md-1"><i class="fas fa-user-check font-weight-semibold"></i></div><div class="col-md-5"><p class="event-task"><strong>Decision Maker:</strong> <span class="badge badge-soft-primary p-1 ms-1 font-size-12">'+expert_name+'</span></p></div>';
                            var eventCallPayment = '<div class="col-md-1"><i class="fas fa-file-invoice-dollar font-weight-semibold"></i></div><div class="col-md-5"><p class="event-repeatoption"><strong>Call Rate:</strong> <span>$'+call_rate+'</span></p></div><div class="col-md-1"><i class="fas fa-money-check-alt font-weight-semibold"></i></div><div class="col-md-5"><p class="event-task"><strong>Payment Status:</strong> <span>'+call_payment+'</span></p></div>';

                            if(reject_reason != ""){
                                var eventCallStatus = '<div class="col-md-1"><i class="fas fa-video font-weight-semibold"></i></div><div class="col-md-5"><p class="event-repeatoption"><strong>Call Status:</strong> <span>'+call_status+'</span></p></div><div class="col-md-1"><i class="fas fa-video-slash font-weight-semibold"></i></div><div class="col-md-5"><p class="event-task"><strong>Reject Reason:</strong> <span>'+reject_reason+'</span></p></div>';
                            }else{
                                var eventCallStatus = '<div class="col-md-1"><i class="fas fa-video font-weight-semibold"></i></div><div class="col-md-5"><p class="event-repeatoption"><strong>Call Status:</strong> <span>'+call_status+'</span></p></div><div class="col-md-1"></div><div class="col-md-5"></div>';
                            }
                            
                           }else{
                            var eventCallSession = '';
                            var eventCallPayment = '';
                            var eventCallStatus = '';
                           }

                           //task_evt_color = data.task_evt_color;
                           task_evt_color = calEventinfo.classNames[0];


                           var date12 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                           var date14 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                           //console.log("date12");
                           //console.log(date12);
                           //console.log(calEvent);
                           //console.log(calEventinfo);
                          // return false;
                           var start_date = moment(calEventinfo.start).format("Y-MM-DD HH:mm:ss");
                            var allDay = calEventinfo.allDay;
                            if(allDay == false){
                                //var end_date = $.fullCalendar.formatDate(calEvent.end, "Y-MM-DD HH:mm:ss");
                                if(task_start_date_new == task_end_date_new){
                                    var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var time1 = moment(calEvent.event_start_time, 'HH:mm').format('hh:mm A');
                                    var time2 = moment(calEvent.event_end_time, 'HH:mm').format('hh:mm A');
                                    var eventdate = date1 + ', ' + time1+ ' - ' + time2;
                                }else{
                                    var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var date2 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var time1 = moment(calEvent.event_start_time, 'HH:mm').format('hh:mm A');
                                    var time2 = moment(calEvent.event_end_time, 'HH:mm').format('hh:mm A');
                                    var eventdate = date1 + ', ' + time1 + ' - ' + date2 + ', ' + time2;
                                }
                                var eventallDay = '';
                            }else{
                                var end_date = calEvent.event_end_date + ' 00:00:00';
                                if(task_start_date_new == task_end_date_new){
                                    var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var eventdate = date1;
                                }else{
                                    var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var date2 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                    var eventdate = date1 +' - '+ date2;
                                }
                                var eventallDay = '&nbsp;&nbsp;-&nbsp;&nbsp;All Day Event';
                            }  
                            if(calEvent.event_reminder != 'No reminder'){
                                var eventReminder = '<div class="col-md-1"><i class="fa fa-bell"></i></div><div class="col-md-5"><p class="event-reminder">' + calEvent.event_reminder + '</p></div>';
                            }else{
                                var eventReminder = '';
                            }  
                            if(calEvent.event_repeat_option_type != 'Does not repeat'){
                                var eventRepeatOption = '<div class="col-md-1"><i class="fa fa-sync"></div><div class="col-md-5"></i><p class="event-repeatoption">' + calEvent.event_repeat_option_type + '</p></div>';
                            }else{
                                var eventRepeatOption = '<div class="col-md-1"><i class="fa fa-arrow-right"></div><div class="col-md-5"></i><p class="event-repeatoption">' + calEvent.event_repeat_option_type + '</p></div>';
                            } 
                            if(calEventinfo.title != ''){
                                if(calEventinfo.title.length > 80){  
                                var typee = "'event_name'";  
                                    var eventTitle = calEventinfo.title.substr(0, 80) +'<a class="readmore read-moreevent_name'+calEvent.event_id+'" onclick="return readMoreContent('+typee+','+calEvent.event_id+');"> Read more</a><span class="show-moreevent_name'+calEvent.event_id+'" style="display: none;">'+calEventinfo.title.substr(80)+' <a class="readless read-lessevent_name'+calEvent.event_id+'" onclick="return readLess('+typee+','+calEvent.event_id+');">Read less</a></span>';
                                }else{
                                    var eventTitle = calEventinfo.title;
                                }
                                
                            }else{
                                var eventTitle = '';
                            }

                            if(calEvent.meeting_link != ''){
                                    var meetingLink = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="fa fa-external-link-alt"></div><div class="col-md-11"></i><a href="'+calEvent.meeting_link+'" class="event-repeatoption" target="_blank" style="margin-bottom: 1rem;">' + calEvent.meeting_link + '</a></div>';
                            }else{
                                var meetingLink = '';
                            }

                            if(calEvent.meeting_location != ''){
                                    var meetingLocation = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="fas fa-map-marker-alt"></div><div class="col-md-11"></i><p style="margin-bottom: 1rem;">' + calEvent.meeting_location + '</p></div>';
                            }else{
                                var meetingLocation = '';
                            }

                            if(calEvent.event_note != ''){
                                if(calEvent.event_note.length > 120){  
                                var typee = "'event'";  
                                    var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.event_note.substr(0, 120) +'<a class="readmore read-moreevent'+calEvent.event_id+'" onclick="return readMoreContent('+typee+','+calEvent.event_id+');"> Read more</a><span class="show-moreevent'+calEvent.event_id+'" style="display: none;">'+calEvent.event_note.substr(120)+' <a class="readless read-lessevent'+calEvent.event_id+'" onclick="return readLess('+typee+','+calEvent.event_id+');">Read less</a></span></p></div>';
                                }else{
                                    var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.event_note +'</p></div>';
                                }
                                
                            }else{
                                var eventNote = '';
                            } 

                            if(calEvent.meeting_agenda != ''){
                                    var meetingAgenda = '<div class="col-md-1"><i class="fa fa-sticky-note"></i></div><div class="col-md-11">'+ calEvent.meeting_agenda +'</div>';

                                // if(calEvent.meeting_agenda.length > 120){  
                                // var typee = "'event'";  
                                //     var meetingAgenda = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.meeting_agenda.substr(0, 120) +'<a class="readmore read-moreevent'+calEvent.event_id+'" onclick="return readMoreContent('+typee+','+calEvent.event_id+');"> Read more</a><span class="show-moreevent'+calEvent.event_id+'" style="display: none;">'+calEvent.meeting_agenda.substr(120)+' <a class="readless read-lessevent'+calEvent.event_id+'" onclick="return readLess('+typee+','+calEvent.event_id+');">Read less</a></span></p></div>';
                                // }else{
                                //     var meetingAgenda = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.meeting_agenda +'</p></div>';
                                // }
                                
                            }else{
                                var meetingAgenda = '';
                            } 

                            if(meeting_files != ''){
                                var meetingFiles = '<div class="col-md-1"><i class="fa fa-paperclip"></i></div><div class="col-md-11">'+ meeting_files +'</div>';                                
                            }else{
                                var meetingFiles = '';
                            }

                            if(calEvent.portfolio_id != '0'){
                                    var portfolioName = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="far fa-list-alt"></div><div class="col-md-11"></i><p class="event-repeatoption"><strong>Portfolio: </strong>' + get_port_name + '</p></div>';
                                    var meetingMembersInvitees = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="fas fa-user-clock"></div><div class="col-md-11"></i><p class="event-repeatoption"><strong>Invitees: </strong>' + get_meeting_members_invitees + '</p></div>';
                                    var meetingMembersAttendees = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="fas fa-user-check"></div><div class="col-md-11"></i><p class="event-repeatoption"><strong>Accepted: </strong>' + get_meeting_members_attendees + '</p></div>';
                                    var meetingOwner = '<div class="col-md-1" style="margin-bottom: 1rem;"><i class="fas fa-user-cog"></div><div class="col-md-11"></i><p class="event-repeatoption"><strong>Facilitator: </strong>' + get_meeting_Owner_name + '</p></div>';
                            }else{
                                var portfolioName = '';
                                var meetingMembers = '';
                                var meetingOwner = '';
                            }
                            
                            if(calEvent.created_type != ''){
                                if(calEvent.created_type == 'task'){  
                                    var taskPriority = '<div class="col-md-1"><i class="fa fa-level-up-alt"></div><div class="col-md-5"></i><p class="event-repeatoption">' + calEvent.task_priority + '</p></div>';
                                }else{
                                    var taskPriority = '';
                                }
                                
                            }else{
                                var taskPriority = '';
                            } 

                            if(calEvent.created_type == 'task'){  
                                    var geteventType = 'To Do';
                                }else{
                                    var geteventType = calEvent.created_type;
                                }
                            // console.log(calEventinfo);
                            // console.log(calEvent);
                            var event_color = task_evt_color;
                            //console.log(event_color); 
                            var event_div = $('<div class="event-modal"></div>');
                                event_div.append('<div class="row first-row"></div>');
                                event_div.find('.first-row')
                                        .append('<div class="col-md-12"><h3 class="event-title"><small><i class="'+ event_color +' event-color-cus-icon event-color-icon"></i></small>&nbsp;' + eventTitle + '</h3><small class="event-datetime">' + eventdate + '</small><small class="event-allday">' + eventallDay + '</small><small>, Time Zone : ' + timeZone + '</small></div>');
                                event_div.append('<br><div class="row second-row"></div>');   
                                event_div.find('.second-row')    
                                        .append(eventNote)   
                                        .append(eventCallPayment)     
                                        .append(eventCallStatus)  
                                        .append(eventCallSession)     
                                        .append(meetingLink)  
                                        .append(meetingLocation)
                                        .append(meetingAgenda)
                                        .append(meetingFiles)
                                        .append(portfolioName)
                                        .append(meetingMembersInvitees)
                                        .append(meetingMembersAttendees)
                                        .append(meetingOwner)
                                        .append(taskPriority)
                                        .append(eventReminder)
                                        .append(eventRepeatOption)
                                        .append('<div class="col-md-1"><i class="fa fa-list"></i></div><div class="col-md-5"><p class="event-task"> My ' + geteventType + '</p></div><input type="hidden" name="event_id" value="' + calEvent.event_id + '" >');
                                if(calEvent.created_type == 'Video Session')
                                {
                                    viewEvent.find('.modal-header').find('.add-todo').hide();
                                    viewEvent.find('.modal-header').find('.edit-event').hide();
                                    viewEvent.find('.modal-header').find('.delete-event').hide();
                                }
                                else if(get_meeting_owner == 'no')
                                {
                                    viewEvent.find('.modal-header').find('.add-todo').show();
                                    viewEvent.find('.modal-header').find('.edit-event').hide();
                                    viewEvent.find('.modal-header').find('.delete-event').hide();
                                }else{
                                    viewEvent.find('.modal-header').find('.add-todo').show();
                                }

                                viewEvent.modal('show');
                                //viewEvent.find('.view_label_modal').html(eventTitle);

                                //$('#add-todo').find('#cl_task_start_date').load(document.URL + ' #cl_task_start_date>*'); 

                                viewEvent.find('.modal-body').empty().prepend(event_div).end();
                                $('#add-todo').find("input[name=event_id]").val(calEvent.event_id);
                                $('#add-todo').find("input[name=event_unique_key]").val(calEvent.unique_key);
                                $('#add-todo').find("input[name=get_task_start_date]").val(task_end_date_new);
                                // $('#add-todo').find("#event_id").select2().trigger('change');
                                $('#add-todo').find("input[name=task_start_date]").val(task_end_date_new);
                                
                                //console.log(task_end_date_new);
                                //$(".cl_task_start_date").datepicker({format: 'yyyy-mm-dd',autoclose: true, maxDate: '2022-10-25'});
                                //$("#task_start_date").datepicker("setDate", new Date(task_end_date_new)).datepicker("setEndDate", new Date(task_end_date_new));
                                
                                //console.log($("#task_start_date").datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date('2022-10-25')}));
                                $.ajax({
                                      url: base_url+'front/restrict_task_start_time',
                                      method: 'POST',
                                      data: {event_id:calEvent.event_id},  
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
                                          event_id:calEvent.event_id
                                      },
                                      success: function(data){
                                          viewEvent.find('.modal-body-inside-todo').empty().prepend(data).end();
                                      }
                                });
                        }
            });
            ///VIEW EVENT END///
            
            ///UPDATE EVENT START///
            viewEvent.find('.modal-header').find('.edit-event').unbind('click').click(function () {
                //debugger;
                $('#update_event_one').show();
                $('#update_event_two').show();
                $('#update_event_three').show();
                $('#update_event_one_new').hide();
                if(calEvent.created_type == 'task'){  
                    var geteventType = 'To Do';
                }else{
                    var geteventType = calEvent.created_type;
                }
                $('#update_type_edit').html("Update recurring "+geteventType);
                //console.log(calEvent.array_count);
                //console.log(calEvent);
                if(calEvent.array_count == 1){
                    // console.log('1st loop');
                    // $('#update_event_two').hide();
                    // $('#update_event_one').hide();
                    // $('#update_event_one_new').show();
                    $('.checked_if_single').prop('checked',true);
                    //myModalUpdate.modal('show');

                    //debugger;
                if($("input[name=update_check_value]:checked").val())
                {
                $('#event_update_Err').html('');
                //console.log("hello js", $("input[name=update_check_value]:checked").val());
                updatecategoryForm.find('#event_start_end_dateErr').html('');
                $('.custom-class-update').hide();
                if(calEvent.event_repeat_option_type == "Daily" || calEvent.event_repeat_option_type == "Does not repeat"){
                    $('#draggable_field').show();
                }else{
                    $('#draggable_field').hide();
                }
                var event_id = calEvent.event_id;
                var update_event_id = $("input[name=update_check_value]:checked").val();
                $('#task_priority_div_update').hide();
                $('#meeting_sec_div_update').hide();
                $('#meeting_sec_div_update2').hide();
                // $('#meeting_link_up').prop('required', false);
                if(calEvent.created_type == "task"){
                    $('#task_priority_div_update').show();
                    updateEventModal.find("select[name='task_priority']").val(calEvent.task_priority);
                    $("#created_type_task_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                if(calEvent.created_type == "reminder"){
                    $("#created_type_reminder_update").prop('checked', true);
                    $("#add_note_div_update").hide();
                }
                if(calEvent.created_type == "event"){
                    $("#created_type_event_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                if(calEvent.created_type == "meeting"){
                    $("#created_type_meeting_update").prop('checked', true);
                    $('#meeting_sec_div_update').show();
                    $('#meeting_sec_div_update2').show();
                    $("#add_note_div_update").hide();
                    // $('#meeting_link_up').prop('required', true);
                }
                /////// start if 
                    if(update_event_id == 1){ //update all 
                        //debugger;
                        var event_new_id = calEvent.event_id;
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
                            var portfolio_update = data.portfolio_update;
                            var meeting_members_selected = data.meeting_members_selected;
                            var meeting_members = data.meeting_members;
                            var meeting_old_files = data.meeting_old_files;
                            var meeting_files = data.meeting_files;
                            var meeting_members_emailids = data.meeting_members_emailids;
                            //task_evt_color = data.task_evt_color;
                            task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                } 
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            //$('#event_start_end_date_div_update').show();
                            //$('#event_start_end_date_select_update').hide();
                            $('#event_start_end_date_select_update').show();                            
                            $('#draggable_field_update').show();
                                              
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
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
                        // if(calEvent.event_repeat_option_type == 'Custom'){
                        //     $('.custom-class-update').css('display','block');
                        //     var day_cal = new Date(calEvent.event_start_date);
                            
                        // }
                        
                        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
                        viewEvent.modal('hide');
                        updateEventModal.modal('show');
                        updateEventModal.find("input[name=event_name]").val(calEventinfo.title);
                        updateEventModal.find("input[name=meeting_link]").val(''); 
                        updateEventModal.find("input[name=meeting_location]").val('');
                        updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                        if(calEvent.created_type == 'meeting')
                        {
                            updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                            updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                            //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda);
                            tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                            updateEventModal.find("#show_porfolio_div").show();
                            updateEventModal.find("#show_member_div").show();
                            updateEventModal.find(".imember_div_up").show();
                        } 
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html('');
                        if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                        }                        
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                           
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEventinfo.allDay == false){
                                updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                            updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
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
                                            if(data.removedeventmem == 'yes')
                                            {
                                                $('#removedmem').val(data.removedmem);
                                                $('#removedunique_key').val(data.removedunique_key);
                                                $('#RemoveMemberMailUpdateModal').modal('show');
                                            }
                                            else
                                            {
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
                                                    // $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                    //     return (calEvent._id == evnt._id);   
                                                    // });
                                                    // $this.$calendarObj.fullCalendar('renderEvent', {
                                                    //     title: categoryName,
                                                    //     start: categoryStart,
                                                    //     event_id: event_id,
                                                    //     end: categoryEnd,
                                                    //     allDay: allDay,
                                                    //     className: categoryColor,
                                                    //     event_note: data.event_note,
                                                    //     event_start_date: data.event_start_date,
                                                    //     event_end_date: data.event_end_date,
                                                    //     event_start_time: data.event_start_time,
                                                    //     event_end_time: data.event_end_time,
                                                    //     event_repeat_option: data.event_repeat_option,
                                                    //     event_allDay: data.event_allDay,
                                                    //     event_reminder: data.event_reminder,
                                                    //     draggable_event: data.draggable_event,
                                                    //     draggable_id: data.draggable_id,
                                                    //     drag_id: data.drag_id,
                                                    //     type: data.type,
                                                    // }, true);
                                                    // $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            //$this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    myModalUpdate.modal('hide');
                                                    updateEventModal.modal('hide');
                                                    Swal.fire("Updated!", "Successfully.", "success");
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
                                                    location.reload();
                                                    return false;
                                                } 
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
                        var event_new_id = calEvent.event_id;
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
                                var portfolio_update = data.portfolio_update;
                                var meeting_members_selected = data.meeting_members_selected;
                                var meeting_members = data.meeting_members;
                                var meeting_old_files = data.meeting_old_files;
                                var meeting_files = data.meeting_files;
                                var meeting_members_emailids = data.meeting_members_emailids;
                                //task_evt_color = data.task_evt_color;
                                task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                }
                                }
                            });
                            if(calEvent.event_repeat_option_type == 'Does not repeat'){
                                // $('#event_start_end_date_div_update').show();
                                // $('#event_start_end_date_select_update').hide();
                                $('#event_start_end_date_select_update').show();
                                $('#draggable_field_update').show();
                            }else if(calEvent.event_repeat_option_type == 'Custom'){
                                const split_string = calEvent.custom_all_day.split(",");
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
                            updateEventModal.find("input[name=event_name]").val(calEventinfo.title); 
                            updateEventModal.find("input[name=meeting_link]").val(''); 
                            updateEventModal.find("input[name=meeting_location]").val('');
                            updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                            if(calEvent.created_type == 'meeting')
                            {
                                updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                                updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                                //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda); 
                                tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                                updateEventModal.find("#show_porfolio_div").hide();
                                updateEventModal.find("#show_member_div").hide();
                                updateEventModal.find(".imember_div_up").hide();
                            } 
                            //console.log(task_evt_color);
                            updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                            updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                            updateEventModal.find("#selected_color_update_text").html(''); 
                            if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                            }else{
                                var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                            }
                            updateEventModal.find(".selected_type_name").html(cap_Heading);               
                            if(calEvent.type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                                // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                               //console.log(calEventinfo.allDay);
                                if(calEventinfo.allDay == false){
                                    //console.log('yes');
                                    updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                    updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                                updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                                updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                                updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                                if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                                }else{
                                    // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                    updateEventModal.find("input[name=draggable_event]").val('');                                
                                }
                                updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                                updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                            }
                            // else
                            // {
                            //     $("#task").addClass("active");
                            //     $("#task-2").addClass("active");
                            // }
                            if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
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
                                                    // calendar.fullCalendar('removeEvents', function (evnt) {
                                                    //     return (calEvent._id == evnt._id);   
                                                    // });
                                                    // $this.$calendarObj.fullCalendar('renderEvent', {
                                                    //     title: categoryName,
                                                    //     start: categoryStart,
                                                    //     event_id: event_id,
                                                    //     end: categoryEnd,
                                                    //     allDay: allDay,
                                                    //     className: categoryColor,
                                                    //     event_note: data.event_note,
                                                    //     event_start_date: data.event_start_date,
                                                    //     event_end_date: data.event_end_date,
                                                    //     event_start_time: data.event_start_time,
                                                    //     event_end_time: data.event_end_time,
                                                    //     event_repeat_option: data.event_repeat_option,
                                                    //     event_allDay: data.event_allDay,
                                                    //     event_reminder: data.event_reminder,
                                                    //     draggable_event: data.draggable_event,
                                                    //     draggable_id: data.draggable_id,
                                                    //     drag_id: data.drag_id,
                                                    //     type: data.type,
                                                    // }, true);
                                                    // $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            //$this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    myModalUpdate.modal('hide');
                                                    updateEventModal.modal('hide');
                                                    Swal.fire("Updated!", "Successfully.", "success");
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
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
                        var event_new_id = calEvent.event_id;
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
                            var portfolio_update = data.portfolio_update;
                            var meeting_members_selected = data.meeting_members_selected;
                            var meeting_members = data.meeting_members;
                            var meeting_old_files = data.meeting_old_files;
                            var meeting_files = data.meeting_files;
                            var meeting_members_emailids = data.meeting_members_emailids;
                            // task_evt_color = data.task_evt_color;
                            task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                }
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            // $('#event_start_end_date_div_update').show();
                            // $('#event_start_end_date_select_update').hide();  
                            $('#event_start_end_date_select_update').hide();
                            $('#draggable_field_update').show();                  
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
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
                        updateEventModal.find("input[name=event_name]").val(calEventinfo.title); 
                        updateEventModal.find("input[name=meeting_link]").val(''); 
                        updateEventModal.find("input[name=meeting_location]").val('');
                        updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                        if(calEvent.created_type == 'meeting')
                        {
                            updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                            updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                            //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda); 
                            tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                            updateEventModal.find("#show_porfolio_div").hide();
                            updateEventModal.find("#show_member_div").hide();
                            updateEventModal.find(".imember_div_up").hide();
                        } 
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html(''); 
                        if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                        }
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                 
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEventinfo.allDay == false){
                                updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                            updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                        }
                        // else
                        // {
                        //     $("#task").addClass("active");
                        //     $("#task-2").addClass("active");
                        // } 
                        if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
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
                                                // $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                //     return (calEvent._id == evnt._id);   
                                                // });
                                                // $this.$calendarObj.fullCalendar('renderEvent', {
                                                //     title: categoryName,
                                                //     start: categoryStart,
                                                //     event_id: event_id,
                                                //     end: categoryEnd,
                                                //     allDay: allDay,
                                                //     className: categoryColor,
                                                //     event_note: data.event_note,
                                                //     event_start_date: data.event_start_date,
                                                //     event_end_date: data.event_end_date,
                                                //     event_start_time: data.event_start_time,
                                                //     event_end_time: data.event_end_time,
                                                //     event_repeat_option: data.event_repeat_option,
                                                //     event_allDay: data.event_allDay,
                                                //     event_reminder: data.event_reminder,
                                                //     draggable_event: data.draggable_event,
                                                //     draggable_id: data.draggable_id,
                                                //     drag_id: data.drag_id,
                                                //     type: data.type,
                                                // }, true);
                                                // $this.$calendarObj.fullCalendar('refetchEvents');
                                                if(dragId != 'no_drag_id'){
                                                    if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                        extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                        //$this.enableDrag();
                                                    }
                                                }else if(dragId == 'no_drag_id'){       
                                                    if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                        $(".drag-event"+draggable_id).remove();
                                                    }  
                                                }
                                                myModalUpdate.modal('hide');
                                                updateEventModal.modal('hide');
                                                Swal.fire("Updated!", "Successfully.", "success");
                                                // setTimeout(function(){ 
                                                //    $.CalendarApp.init()
                                                // }, 1000);
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
                else
                {
                    $('#event_update_Err').html('Please select option!');
                }

                    
                }else{
                 // console.log('2nd loop');
                    $('.checked_if_single').prop('checked',false);
                    if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                        //console.log('2-1st loop');
                        $('#update_event_two').hide();
                        myModalUpdate.modal('show');
                        
                    }else{
                        //console.log('2-2nd loop');
                        //console.log("calEvent.isLastCount");
                        //console.log(calEvent.isLastCount);
                        if(calEvent.isLastCount == 1){
                            $('#update_event_three').hide();
                            myModalUpdate.modal('show');
                        }else{
                            myModalUpdate.modal('show');
                        }
                    }  
                }
                return false;                
            });

            myModalUpdate.find('.modal-body').find('.update-next-event').unbind('click').click(function () {
                //debugger;
                if($("input[name=update_check_value]:checked").val())
                {
                $('#event_update_Err').html('');
                //console.log("hello js", $("input[name=update_check_value]:checked").val());
                updatecategoryForm.find('#event_start_end_dateErr').html('');
                $('.custom-class-update').hide();
                if(calEvent.event_repeat_option_type == "Daily" || calEvent.event_repeat_option_type == "Does not repeat"){
                    $('#draggable_field').show();
                }else{
                    $('#draggable_field').hide();
                }
                var event_id = calEvent.event_id;
                var update_event_id = $("input[name=update_check_value]:checked").val();
                $('#task_priority_div_update').hide();
                $('#meeting_sec_div_update').hide();
                $('#meeting_sec_div_update2').hide();
                // $('#meeting_link_up').prop('required', false);
                if(calEvent.created_type == "task"){
                    $('#task_priority_div_update').show();
                    updateEventModal.find("select[name='task_priority']").val(calEvent.task_priority);
                    $("#created_type_task_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                if(calEvent.created_type == "reminder"){
                    $("#created_type_reminder_update").prop('checked', true);
                    $("#add_note_div_update").hide();
                }
                if(calEvent.created_type == "event"){
                    $("#created_type_event_update").prop('checked', true);
                    $("#add_note_div_update").show();
                }
                if(calEvent.created_type == "meeting"){
                    $("#created_type_meeting_update").prop('checked', true);
                    $('#meeting_sec_div_update').show();
                    $('#meeting_sec_div_update2').show();
                    $("#add_note_div_update").hide();
                    // $('#meeting_link_up').prop('required', true);
                }
                /////// start if 
                    if(update_event_id == 1){ //update all 
                        //debugger;
                        var event_new_id = calEvent.event_id;
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
                            var portfolio_update = data.portfolio_update;
                            var meeting_members_selected = data.meeting_members_selected;
                            var meeting_members = data.meeting_members;
                            var meeting_old_files = data.meeting_old_files;
                            var meeting_files = data.meeting_files;
                            var meeting_members_emailids = data.meeting_members_emailids;
                            //task_evt_color = data.task_evt_color;
                            task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                } 
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            //$('#event_start_end_date_div_update').show();
                            //$('#event_start_end_date_select_update').hide();
                            $('#event_start_end_date_select_update').show();                            
                            $('#draggable_field_update').show();
                                              
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
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
                        // if(calEvent.event_repeat_option_type == 'Custom'){
                        //     $('.custom-class-update').css('display','block');
                        //     var day_cal = new Date(calEvent.event_start_date);
                            
                        // }
                        
                        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
                        viewEvent.modal('hide');
                        updateEventModal.modal('show');
                        updateEventModal.find("input[name=event_name]").val(calEventinfo.title);
                        updateEventModal.find("input[name=meeting_link]").val(''); 
                        updateEventModal.find("input[name=meeting_location]").val('');
                        updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                        if(calEvent.created_type == 'meeting')
                        {
                            updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                            updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                            //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda);
                            tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                            updateEventModal.find("#show_porfolio_div").show();
                            updateEventModal.find("#show_member_div").show();
                            updateEventModal.find(".imember_div_up").show();
                        } 
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html('');
                        if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                        }                        
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                           
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEventinfo.allDay == false){
                                updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                            updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
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
                                            if(data.removedeventmem == 'yes')
                                            {
                                                $('#removedmem').val(data.removedmem);
                                                $('#removedunique_key').val(data.removedunique_key);
                                                $('#RemoveMemberMailUpdateModal').modal('show');
                                            }
                                            else
                                            {
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
                                                    // $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                    //     return (calEvent._id == evnt._id);   
                                                    // });
                                                    // $this.$calendarObj.fullCalendar('renderEvent', {
                                                    //     title: categoryName,
                                                    //     start: categoryStart,
                                                    //     event_id: event_id,
                                                    //     end: categoryEnd,
                                                    //     allDay: allDay,
                                                    //     className: categoryColor,
                                                    //     event_note: data.event_note,
                                                    //     event_start_date: data.event_start_date,
                                                    //     event_end_date: data.event_end_date,
                                                    //     event_start_time: data.event_start_time,
                                                    //     event_end_time: data.event_end_time,
                                                    //     event_repeat_option: data.event_repeat_option,
                                                    //     event_allDay: data.event_allDay,
                                                    //     event_reminder: data.event_reminder,
                                                    //     draggable_event: data.draggable_event,
                                                    //     draggable_id: data.draggable_id,
                                                    //     drag_id: data.drag_id,
                                                    //     type: data.type,
                                                    // }, true);
                                                    // $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            //$this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    myModalUpdate.modal('hide');
                                                    updateEventModal.modal('hide');
                                                    Swal.fire("Updated!", "Successfully.", "success");
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
                                                    location.reload();
                                                    return false;
                                                } 
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
                        var event_new_id = calEvent.event_id;
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
                                var portfolio_update = data.portfolio_update;
                                var meeting_members_selected = data.meeting_members_selected;
                                var meeting_members = data.meeting_members;
                                var meeting_old_files = data.meeting_old_files;
                                var meeting_files = data.meeting_files;
                                var meeting_members_emailids = data.meeting_members_emailids;
                                //task_evt_color = data.task_evt_color;
                                task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                }
                                }
                            });
                            if(calEvent.event_repeat_option_type == 'Does not repeat'){
                                // $('#event_start_end_date_div_update').show();
                                // $('#event_start_end_date_select_update').hide();
                                $('#event_start_end_date_select_update').show();
                                $('#draggable_field_update').show();
                            }else if(calEvent.event_repeat_option_type == 'Custom'){
                                const split_string = calEvent.custom_all_day.split(",");
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
                            updateEventModal.find("input[name=event_name]").val(calEventinfo.title); 
                            updateEventModal.find("input[name=meeting_link]").val(''); 
                            updateEventModal.find("input[name=meeting_location]").val('');
                            updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                            if(calEvent.created_type == 'meeting')
                            {
                                updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                                updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                                //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda); 
                                tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                                updateEventModal.find("#show_porfolio_div").hide();
                                updateEventModal.find("#show_member_div").hide();
                                updateEventModal.find(".imember_div_up").hide();
                            } 
                            //console.log(task_evt_color);
                            updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                            updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                            updateEventModal.find("#selected_color_update_text").html(''); 
                            if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                            }else{
                                var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                            }
                            updateEventModal.find(".selected_type_name").html(cap_Heading);               
                            if(calEvent.type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                                // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                               //console.log(calEventinfo.allDay);
                                if(calEventinfo.allDay == false){
                                    //console.log('yes');
                                    updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                    updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                                updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                                updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                                updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                                if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                                }else{
                                    // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                    updateEventModal.find("input[name=draggable_event]").val('');                                
                                }
                                updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                                updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                            }
                            // else
                            // {
                            //     $("#task").addClass("active");
                            //     $("#task-2").addClass("active");
                            // }
                            if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
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
                                                    // calendar.fullCalendar('removeEvents', function (evnt) {
                                                    //     return (calEvent._id == evnt._id);   
                                                    // });
                                                    // $this.$calendarObj.fullCalendar('renderEvent', {
                                                    //     title: categoryName,
                                                    //     start: categoryStart,
                                                    //     event_id: event_id,
                                                    //     end: categoryEnd,
                                                    //     allDay: allDay,
                                                    //     className: categoryColor,
                                                    //     event_note: data.event_note,
                                                    //     event_start_date: data.event_start_date,
                                                    //     event_end_date: data.event_end_date,
                                                    //     event_start_time: data.event_start_time,
                                                    //     event_end_time: data.event_end_time,
                                                    //     event_repeat_option: data.event_repeat_option,
                                                    //     event_allDay: data.event_allDay,
                                                    //     event_reminder: data.event_reminder,
                                                    //     draggable_event: data.draggable_event,
                                                    //     draggable_id: data.draggable_id,
                                                    //     drag_id: data.drag_id,
                                                    //     type: data.type,
                                                    // }, true);
                                                    // $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            //$this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    myModalUpdate.modal('hide');
                                                    updateEventModal.modal('hide');
                                                    Swal.fire("Updated!", "Successfully.", "success");
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
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
                        var event_new_id = calEvent.event_id;
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
                            var portfolio_update = data.portfolio_update;
                            var meeting_members_selected = data.meeting_members_selected;
                            var meeting_members = data.meeting_members;
                            var meeting_old_files = data.meeting_old_files;
                            var meeting_files = data.meeting_files;
                            var meeting_members_emailids = data.meeting_members_emailids;
                            // task_evt_color = data.task_evt_color;
                            task_evt_color = calEventinfo.classNames[0];
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
                                updateEventModal.find("#portfolio_id_up").html('');
                                updateEventModal.find("#team_member_up").html('');
                                updateEventModal.find("#selected_T_member_up").val('');
                                updateEventModal.find(".imember_div_up").html('');
                                if(calEvent.created_type == 'meeting')
                                {
                                    updateEventModal.find("#portfolio_id_up").html(portfolio_update);
                                    updateEventModal.find("#team_member_up").html(meeting_members);
                                    updateEventModal.find("#selected_T_member_up").val(meeting_members_selected);
                                    updateEventModal.find("#mfile_old_up").val(meeting_old_files);
                                    updateEventModal.find(".refresh_remove_mdelfiles").html(meeting_files);
                                    updateEventModal.find(".imember_div_up").html(meeting_members_emailids);
                                }
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            // $('#event_start_end_date_div_update').show();
                            // $('#event_start_end_date_select_update').hide();  
                            $('#event_start_end_date_select_update').hide();
                            $('#draggable_field_update').show();                  
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
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
                        updateEventModal.find("input[name=event_name]").val(calEventinfo.title); 
                        updateEventModal.find("input[name=meeting_link]").val(''); 
                        updateEventModal.find("input[name=meeting_location]").val('');
                        updateEventModal.find("textarea[name=meeting_agenda]").val(''); 
                        if(calEvent.created_type == 'meeting')
                        {
                            updateEventModal.find("input[name=meeting_link]").val(calEvent.meeting_link); 
                            updateEventModal.find("input[name=meeting_location]").val(calEvent.meeting_location);
                            //updateEventModal.find("textarea[name=meeting_agenda]").val(calEvent.meeting_agenda); 
                            tinymce.get("meeting_agenda_up").setContent(calEvent.meeting_agenda);
                            updateEventModal.find("#show_porfolio_div").hide();
                            updateEventModal.find("#show_member_div").hide();
                            updateEventModal.find(".imember_div_up").hide();
                        } 
                        updateEventModal.find("input[name='event_color']").val(task_evt_color); 
                        updateEventModal.find("#selected_color_update").addClass(task_evt_color); 
                        updateEventModal.find("#selected_color_update_text").html(''); 
                        if(calEvent.created_type == 'task'){  
                            var cap_Heading = 'To Do';
                        }else{
                            var cap_Heading = (calEvent.created_type).charAt(0).toUpperCase() + (calEvent.created_type).slice(1);
                        }
                        updateEventModal.find(".selected_type_name").html(cap_Heading);                 
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEventinfo.allDay == false){
                                updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
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
                            updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                updateEventModal.find("input[name=draggable_event]").val('on');
                            }else{
                                // updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                updateEventModal.find("input[name=draggable_event]").val('');                                
                            }
                            updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                        }
                        // else
                        // {
                        //     $("#task").addClass("active");
                        //     $("#task-2").addClass("active");
                        // } 
                        if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
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
                                                // $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                //     return (calEvent._id == evnt._id);   
                                                // });
                                                // $this.$calendarObj.fullCalendar('renderEvent', {
                                                //     title: categoryName,
                                                //     start: categoryStart,
                                                //     event_id: event_id,
                                                //     end: categoryEnd,
                                                //     allDay: allDay,
                                                //     className: categoryColor,
                                                //     event_note: data.event_note,
                                                //     event_start_date: data.event_start_date,
                                                //     event_end_date: data.event_end_date,
                                                //     event_start_time: data.event_start_time,
                                                //     event_end_time: data.event_end_time,
                                                //     event_repeat_option: data.event_repeat_option,
                                                //     event_allDay: data.event_allDay,
                                                //     event_reminder: data.event_reminder,
                                                //     draggable_event: data.draggable_event,
                                                //     draggable_id: data.draggable_id,
                                                //     drag_id: data.drag_id,
                                                //     type: data.type,
                                                // }, true);
                                                // $this.$calendarObj.fullCalendar('refetchEvents');
                                                if(dragId != 'no_drag_id'){
                                                    if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                        extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                        //$this.enableDrag();
                                                    }
                                                }else if(dragId == 'no_drag_id'){       
                                                    if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                        $(".drag-event"+draggable_id).remove();
                                                    }  
                                                }
                                                myModalUpdate.modal('hide');
                                                updateEventModal.modal('hide');
                                                Swal.fire("Updated!", "Successfully.", "success");
                                                // setTimeout(function(){ 
                                                //    $.CalendarApp.init()
                                                // }, 1000);
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
                else
                {
                    $('#event_update_Err').html('Please select option!');
                } 
            });
            ///UPDATE EVENT END///

            ///DELETE EVENT START///
            viewEvent.find('.modal-header').find('.delete-event').unbind('click').click(function () {
            //debugger;
            //var event_id = event_div.find("input[name=event_id]").val(); 
            $('#delete_event_two').show();
            $('#delete_event_three').show();
            if(calEvent.created_type == 'task'){  
                var geteventType = 'To Do';
            }else{
                var geteventType = calEvent.created_type;
            }
            $('#delete_type_edit').html("Delete recurring "+geteventType);
            var event_id = calEvent.event_id;
            //console.log("calEvent.dataaaaaa");
            //console.log(calEvent);
            //console.log("calEvent.array_count");
            //console.log(calEvent.array_count);
                if(calEvent.array_count == 1){
                    $('#delete_event_two').hide();
                    $("#myModal").modal('show');
                    
                }else{
                 
                if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                    $('#delete_event_two').hide();
                    $("#myModal").modal('show');
                }else{
                        //console.log("calEvent.isLastCount");
                        //console.log(calEvent.isLastCount);
                        if(calEvent.isLastCount == 1){
                            $('#delete_event_three').hide();
                            $("#myModal").modal('show');
                        }else{
                            $("#myModal").modal('show');
                        }                    
                }  
            }
            });
            
            myModal.find('.modal-body').find('.delete-next-event').unbind('click').click(function () {
                //debugger;
                if($("input[name=delete_check_value]:checked").val())
                {
                    $('#event_delete_Err').html('');
                    var event_id = calEvent.event_id;                
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
                                //console.log(calEvent.event_id);
                                //console.log(calEvent.unique_key);
                                //console.log(delete_event_id);
                                if(delete_event_id == "0") //delete this event
                                {
                                    // $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                    //     return (ev.event_id === calEvent.event_id);   
                                    // });
                                    var r_event = calendar.getEventById(calEvent.event_id);
                                        r_event.remove();
                                }
                                else if(delete_event_id == "1") //delete all
                                {
                                    // $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                    //     return (ev.unique_key === calEvent.unique_key);   
                                    // });
                                    //console.log(calEvent);
                                    calendar.getEvents().filter(function(info) {
                                        // console.log(info._def.extendedProps.unique_key);
                                        // console.log(calEvent.unique_key);
                                      if(info._def.extendedProps.unique_key === calEvent.unique_key)
                                      {
                                        //console.log(info);
                                        var r_event = calendar.getEventById(info._def.extendedProps.event_id);
                                        r_event.remove();
                                      }
                                    });
                                }
                                else if(delete_event_id == "2") //delete this and following
                                {
                                        $.each(html.data, function(index) {
                                            //console.log(html.data[index].id);
                                        //     $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                        //     return (ev.event_id === html.data[index].id);   
                                        // });
                                            var r_event = calendar.getEventById(html.data[index].id);
                                                r_event.remove();
                                            myModal.modal('hide');
                                        });
                                }

                                myModal.modal('hide');
                                viewEvent.modal('hide');
                                //////// reload data
                                var view = calendar.view;
                                //console.log(view);
                                var month_year = view.title;
                                var event_data = function () {
                                    var evt = null;
                                    $.ajax({
                                        method: "POST",
                                        async: false,
                                        data: {
                                            month_year:month_year, button:'today',
                                        },
                                        url: base_url+'front/get_allcalendar_events',            
                                        success: function(data){
                                            //console.log("testt");
                                            var db_events = data; 
                                            function renameKey(obj, old_key, new_key) {   
                                                // check if old key = new key  
                                                if (old_key !== new_key) {                  
                                                    Object.defineProperty(obj, new_key, // modify old key
                                                    // fetch description from object
                                                    Object.getOwnPropertyDescriptor(obj, old_key));
                                                    delete obj[old_key]; // delete old key
                                                }
                                            }
                                            db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                            db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                                            
                                            var lim = db_events.length;
                                            for (var i = 0; i < lim; i++)
                                            {                        
                                                if(db_events[i].type == 'event'){
                                                    if(db_events[i].event_allDay == 'true')
                                                    {
                                                        db_events[i].allDay = true;
                                                    }else{
                                                        db_events[i].allDay = false;
                                                    }
                                                    db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                    db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                    db_events[i].event_id = db_events[i].id;
                                                    
                                                    var icon_val = db_events[i].created_type;
                                                    if(icon_val == "reminder"){
                                                        db_events[i].icon = 'bell';
                                                    }else if(icon_val == "task"){
                                                        db_events[i].icon = 'record-circle-outline';
                                                    }else if(icon_val == "meeting"){
                                                        db_events[i].icon = 'link-variant';
                                                    }else{
                                                        db_events[i].icon = 'calendar-check';
                                                    }

                                                    var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                    var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                    db_events[i].new_time = time11+'-'+time22;
                                                    if(db_events[i].draggable_event == "on"){
                                                        db_events[i].editable = true;
                                                    }else{
                                                        db_events[i].editable = false;
                                                    }
                                                }
                                            }
                                            evt = db_events; 

                                        }
                                    });
                                    return evt;
                                }();
                                if(event_data)
                                {
                                   var len = event_data.length;
                                    for (var i = 0; i < len; i++) { 
                                        //console.log(event_data[i].id);
                                        var event = calendar.getEventById(event_data[i].id);
                                        if(event != null){
                                            event.remove();
                                        }                             
                                    }  
                                    calendar.addEventSource(event_data);
                                }
                                // setTimeout(function(){ 
                                //                    $.CalendarApp.init()
                                //                 }, 1000);
                                //location.reload();
                            }
                    });
                }
                else
                {
                    $('#event_delete_Err').html('Please select option!');
                }                

            });
            ///DELETE EVENT END///
                }
                },
                select: function(info) {
                    //debugger;
                    addNewEvent(info.startStr, info.endStr, info.allDay);
                },
                eventDrop: function( info ) { // drag calendar events
                //debugger;   
                //console.log(info);
                //console.log(info.event.id);
                    calEventinfo = info.event;
                    calEvent = info.event.extendedProps;  
                    var start = moment(calEventinfo.start).format("Y-MM-DD HH:mm:ss");
                    
                    if(calEventinfo.end == null && calEventinfo.allDay == false){
                       var minutesToAdd=15;
                        var currentDate = new Date(moment(calEventinfo.start).format("Y-MM-DD HH:mm:ss"));
                        var end = new Date(currentDate.getTime() + minutesToAdd*60000);
                        var end = moment(end).format("Y-MM-DD HH:mm:ss"); 
                    }else if(calEventinfo.end == null && calEventinfo.allDay == true){
                       var end = moment(calEventinfo.start).format("Y-MM-DD HH:mm:ss");
                    }else{
                        var end = moment(calEventinfo.end).format("Y-MM-DD HH:mm:ss");
                    }
                    
                    var allDay = calEventinfo.allDay;
                    var title = calEventinfo.title;
                    var event_id = calEvent.event_id;
                    $.ajax({                        
                        type: "POST",
                        url: base_url+'front/update_event',
                        data: {
                           event_name:title, event_color:calEventinfo.classNames[0], start_date:start, end_date:end, event_id:event_id, allDay:allDay
                        },
                        success: function (response) {  
                            var event = calendar.getEventById(info.event.id);
                            event.setExtendedProp('event_start_date', response.event_start_date);
                            event.setExtendedProp('event_end_date', response.event_end_date);
                            event.setExtendedProp('event_start_time', response.event_start_time);
                            event.setExtendedProp('event_end_time', response.event_end_time);
                            event.setExtendedProp('event_allDay', response.event_allDay);
                            event.setProp('end', response.end);
                            calendar.refetchEvents();
                        }
                    });
                },
                eventResize:function(info)
                {
                    //debugger;
                    calEventinfo = info.event;
                    calEvent = info.event.extendedProps;  
                    var start = moment(calEventinfo.start).format("Y-MM-DD HH:mm:ss");
                    var end = moment(calEventinfo.end).format("Y-MM-DD HH:mm:ss");
                    var title = calEventinfo.title;
                    var event_id = calEvent.event_id;
                    var allDay = calEventinfo.allDay;
                    $.ajax({
                        type:"POST",
                        url: base_url+'front/update_event',
                        data: {
                           event_name:title, event_color:calEventinfo.classNames[0], start_date:start, end_date:end, event_id:event_id, allDay:allDay 
                        },
                        success:function(response){
                            //console.log(info);
                            //console.log(info.event.id);
                            var event = calendar.getEventById(info.event.id);
                            event.setExtendedProp('event_start_date', response.event_start_date);
                            event.setExtendedProp('event_end_date', response.event_end_date);
                            event.setExtendedProp('event_start_time', response.event_start_time);
                            event.setExtendedProp('event_end_time', response.event_end_time);
                            event.setExtendedProp('event_allDay', response.event_allDay);
                            event.setProp('end', response.end);
                            calendar.refetchEvents();
                        }
                     })
                },            
                eventSources: [{
                //googleCalendarApiKey: 'AIzaSyC82HbzVJVYr2pwtSzqUbnaG_vxk80vwGo',
                //googleCalendarId: $('#get_sess_email').val(),
                className: 'fc-event-google-email', editable: false}],    
                events : defaultEvents,
                eventRender: function(info) {
                    let icon = info.event.extendedProps.icon;
                    let title = $(info.el).first('.fc-time');
                    if (icon !== undefined) {
                        title.prepend("<i class='mdi mdi-" + info.event.extendedProps.icon + "' style='float: left;margin-right: 3px;'></i>");
                    }
                },
            });
            calendar.render();  
            //console.log(calendar);          
            
            ///ADD NEW EVENT START///
             function addNewEvent(start, end, allDay) { //onSelect function
                //debugger;
                $('#event_start_end_dateErr').html('');
                $('#cus_radioBTN').hide();
                $('#custom_value').prop('disabled', false);
                $('#weekday_value').prop('disabled', false);
                $('#monthly_value').prop('disabled', false);
                $('#yearly_value').prop('disabled', false);

                addEvent.modal('show');

                //console.log(start);
                //console.log(end);
                // var startd = moment(start).format('Y-MM-DD');
                // var ended = moment(end).subtract(1, 'days').format('Y-MM-DD');
                // console.log(startd);
                // console.log(ended);

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
                        createEventForm.find('#mfileErr').html('');
                        createEventForm.find('#mfile').val('');
                        createEventForm.find('.all_mfiles').html('');
                        createEventForm.find('.all_mfiles_name').html('');
                        createEventForm.find('.display_all_maddfiles_li').html('');
                        createEventForm.find('#add_mfile_but_create').hide();
                        createEventForm.find('#mrabcloader2').hide();
                        createEventForm.find('#cmf_cntVal').val('0'); 
                        createEventForm.find('#cmf_cntVal2').val('0');  
                        $('#created_type_event').prop('checked', true);
                        $('#created_type_task').prop('checked', false);
                        $('#created_type_reminder').prop('checked', false);
                        $('#created_type_meeting').prop('checked', false);
                        $('#task_priority_div').hide();
                        $('#add_note_div').show();
                        $('#meeting_sec_div').hide();
                        $('#meeting_sec_div2').hide();   
                        if($('.mclose_remove_active').hasClass('active'))
                        {
                            $('.mclose_remove_active').removeClass('active');      
                        }  
                        if($('.rclose_remove_active').hasClass('active'))
                        {
                            $('.rclose_remove_active').removeClass('active');      
                        }  
                        if($('.tclose_remove_active').hasClass('active'))
                        {
                            $('.tclose_remove_active').removeClass('active');      
                        }    
                        $('.eclose_remove_active').addClass('active');        
                });

                calendar.unselect();
            }

            // // Form to add new event clear
            // createEventForm.find('.close-category').unbind('click').click(function () {
            //     //debugger;
            //     console.log('2');
            //     createEventForm.trigger("reset");
            // });

            createEventForm.unbind('submit').on('submit', function (e){  
            // debugger;       
                e.preventDefault(); // Stop page from refreshing
                tinyMCE.triggerSave();
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
                    //console.log($('#mfile').val());
                    formData.append("mfile[]", $('#mfile_add_create').val());
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
                            else if(data.status == 'file_uploadSizeErr')
                            {
                                $('#mfileErr').html('Oops Size is Large! It must be less than 2MB.');
                            }
                            else if(data.status == 'Error_Uploading')
                            {
                                $('#mfileErr').html('File Uploading Error! Please Try Again!');          
                            }
                            else if(data.status == true){
                                Swal.fire("Created!", "Successfully.", "success");
                                window.location.href = base_url+"calendar";
                                exit;
                                var categoryName = createEventForm.find("input[name='event_name']").val(); 
                                var categoryColor = createEventForm.find("input[name='event_color']").val();
                                var type = data.type;
                                if(type == 'event'){
                                    var dragId = data.drag_id;
                                    var event_id = data.event_id;
                                    var categoryStart = data.start_date;
                                    var categoryEnd = data.end_date;
                                    var allDay = data.allDay;
                                    if(allDay == 'true'){
                                        var allDay = true;
                                    }else{
                                        var allDay = false;
                                    }                                
                                    if (categoryName !== null && categoryName.length != 0) {
                                        createEventForm.find('#event_end_timeErr').html('');
                                        var newEvent = {
                                                title: categoryName,
                                                start: categoryStart,
                                                event_id: event_id,
                                                end: categoryEnd,
                                                allDay: allDay,
                                                className: categoryColor,
                                                event_note: data.event_note,
                                                event_start_date: data.event_start_date,
                                                event_end_date: data.event_end_date,
                                                event_start_time: data.event_start_time,
                                                event_end_time: data.event_end_time,
                                                event_repeat_option: data.event_repeat_option,
                                                event_allDay: data.event_allDay,
                                                event_reminder: data.event_reminder,
                                                draggable_event: data.draggable_event,
                                                draggable_id: data.draggable_id,
                                                drag_id: data.drag_id,
                                                type: data.type,
                                            }
                                        calendar.addEvent(newEvent);
                                        createEventForm.trigger("reset");
                                        if(dragId != 'no_drag_id'){
                                            extEvents.append('<div id="' + dragId + '" class="external-event fc-event drag-event' + dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '"><i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>' + categoryName + '</div>')   
                                        }
                                        addEvent.modal('hide');
                                    }
                                }                                
                            }                   
                        }
                    }); 
                }else{
                    createEventForm.find('#event_end_timeErr').html('End Time should be greater than Start time');
                }
                
            });
            ///ADD NEW EVENT END///            
    },
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CalendarPage.init()
}(window.jQuery);
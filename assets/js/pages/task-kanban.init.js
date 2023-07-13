var base_url = 'https://app.decision168.com/';
$(document).ready(() => {
		dragula([
		    document.getElementById("to_do-task"), 
		    document.getElementById("in_progress-task"),
        document.getElementById("in_review-task"),
		    document.getElementById("done-task")
		])
      .on('dragend', function(el) {
      	//debugger;
      	var task_id = $(el).attr('data-id');
       
        var task_class = $(el).attr('data-class');
      	//console.log(task_id);
      	var section_div = $(el).parent('div').attr('id');
      	//console.log(section_div);

        if(task_class == 'task_class')
        {
          if(section_div == "to_do-task")
          {
            $.ajax({
                  url: base_url+'front/taskgrid_todo_status',
                  method: 'POST',
                  data: {task_id:task_id},
                  async:false,  
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*'); 
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*');   
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );
                  }
              });
          }

          if(section_div == "in_progress-task")
          {
            $.ajax({
                  url: base_url+'front/taskgrid_inprogress_status',
                  method: 'POST',
                  data: {task_id:task_id},
                  async:false,  
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*');
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*'); 
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*');  
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );      
                  }
              });
          }

          if(section_div == "in_review-task")
          {
            $.ajax({
                  url: base_url+'front/taskgrid_inreview_status',
                  method: 'POST',
                  data: {task_id:task_id},  
                  async:false,
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*');
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*');  
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*'); 
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*'); 
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );           
                  }
              });
          }

          if(section_div == "done-task")
          {
            $.ajax({
                  url: base_url+'front/taskgrid_done_status',
                  method: 'POST',
                  data: {task_id:task_id},  
                  async:false,
                  success: function(data) {
                    //debugger;   
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*');   
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*'); 
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*'); 
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );        
                  }
              });
          }
        }
        else
        {
          if(section_div == "to_do-task")
          {
            $.ajax({
                  url: base_url+'front/subtaskgrid_todo_status',
                  method: 'POST',
                  data: {task_id:task_id}, 
                  async:false, 
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*');  
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*'); 
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');    
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );      
                  }
              });
          }

          if(section_div == "in_progress-task")
          {
            $.ajax({
                  url: base_url+'front/subtaskgrid_inprogress_status',
                  method: 'POST',
                  data: {task_id:task_id}, 
                  async:false, 
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*');   
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*'); 
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');       
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );      
                  }
              });
          }

          if(section_div == "in_review-task")
          {
            $.ajax({
                  url: base_url+'front/subtaskgrid_inreview_status',
                  method: 'POST',
                  data: {task_id:task_id}, 
                  async:false, 
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*');   
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*'); 
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');       
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );      
                  }
              });
          }

          if(section_div == "done-task")
          {
            $.ajax({
                  url: base_url+'front/subtaskgrid_done_status',
                  method: 'POST',
                  data: {task_id:task_id},
                  async:false,  
                  success: function(data) {
                    //debugger;
                      $('#to_do-task').load(document.URL + ' #to_do-task>*');
                      $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                      $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                      $('#done-task').load(document.URL + ' #done-task>*'); 
                      $('#refresh_grid_message').load(document.URL + ' #refresh_grid_message>*');  
                      $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');    
                      setTimeout( function(){ 
                          GetTask_Filter();
                        }  , 2000 );      
                  }
              });
          }
        }
      	
      });
  });
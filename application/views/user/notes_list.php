<?php
   $page = 'notes-list';
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <meta charset="utf-8" />
      <title>Note List</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
      <!-- Bootstrap Css -->
      <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <!-- DataTables -->
      <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

      <?php
         include('header_links.php');
         ?>
      <link href="<?php echo base_url();?>assets/css/new-cards.css" rel="stylesheet" type="text/css" />
   </head>
   <style>
        .large-textarea {
            height: 765px;
            border: none;
            padding: 0px 25px 0px 25px;
            font-size: 16px;
        }

        .large-textarea:hover,
        .large-textarea:active,
        .large-textarea:focus {
            outline: none;
            border-color: transparent;
        }
        .ScrollStyle
            {
               max-height: 450px;
               overflow-y: hidden;
               border-radius: 15px;
            }
         .large-texttile {
            height: 65px;
            border: none;
            padding: 0px 25px 0px 25px;
            font-size: 22px;
        }

        .large-texttile:hover,
        .large-texttile:active,
        .large-texttile:focus {
            outline: none;
            border-color: transparent;
        }
        .no-notes{
         margin-left: 50px;
         margin-top: 50px;
         margin-bottom: 50px;
        }
        .note-active{
         background-color: rgba(120,120,128,.16);
        }
        /* .tox:not([dir=rtl]) { */
  
.tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary {
    background: #ffffff !important;
}
.tox .tox-tbtn {
    background-color: #ffffff!important;
}
.tox .tox-tbtn:hover {
    background-color: #ffffff!important;
}
   </style>
   <body data-sidebar="dark">
      <!-- Begin page -->
      <div id="layout-wrapper">
         <?php
            include('header.php');
            ?>
         <!-- ========== Left Sidebar Start ========== -->
         <?php
            include('sidebar.php');
            ?>
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <!-- start page title -->
                  <!-- <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Notes</h4>
                           
                        </div>
                     </div>
                  </div> -->
                  <!-- end page title -->
                  <div class="row">
                     <div class="col-12">
                        <!-- Left sidebar -->
                        <!-- <div class="row">
                          

                           <div class="col-md-3">
                           <div class="card">
                        <div class="input-group mb-2">
                              <input type="text" class="form-control" placeholder="Search..." id="search-note-list" style="line-height: 1.5; border: none;padding: 15px 5px 5px 30px;">
                              <button type="button" class="btn bg-transparent" style="line-height: 0.5; margin-left: -40px; z-index: 100; display: block;" id="search-clear-list">
                              <i class="fa fa-times"></i>
                              </button>
                        </div>
                        </div>
                           </div>
                        </div> -->
                        <div class="row mb-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding-bottom: 0px !important;">
            <div class="row align-items-center">
                <div class="col-2">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Notes</h4>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item" onclick="checkButton();">
                                <a class="nav-link active" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>
                            </li>
                            <li class="nav-item me-2"  onclick="checkButton2();">
                                <a class="nav-link " id="v-pills-grid-tab" data-bs-toggle="pill" href="#v-pills-grid" role="tab" aria-controls="v-pills-grid" aria-selected="true">
                                    <i class="mdi mdi-view-grid-outline"></i>
                                </a>
                            </li>
                
                                        </ul>
                    </div>
                </div>
                <div class="col-6">                    
                
                <input type="text" class="form-control" placeholder="Search..." id="search-note-list" style="line-height: 1.5; border: none; background-color: rgba(120,120,128,.16); border-radius: 10px;">
                <button type="button" class="btn bg-transparent" style="line-height: 0.5;  z-index: 100; display: none; margin-left: 140px; margin-top: -30px;" id="search-clear-list">
                  <i class="fa fa-times"></i>
                </button>
            </div>
            </div>
            <div class="page-title-right">                    
            <div class="btn-group me-2 mb-2 mb-sm-0" style="float: right; margin-left:30px" id="createShow">
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="Save" onclick="myFunction()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-all-outline"></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="newNote()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-edit-outline"></i></a>
            </div> 
            <div class="btn-group me-2 mb-2 mb-sm-0" style="float: right; margin-left:30px; display:none" id="updateShow" >
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="Save" onclick="updateNote()" id="saveNote" data-updateid="" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-all-outline"></i></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="newNote()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-edit-outline"></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="deleteNote()" id="deleteNote" data-deleteid="" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
            </div>
            </div>

        </div>
    </div>
</div>
   <div class ="tab-content" id="v-pills-tabContent">
   <div class="tab-pane fade active show" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="email-leftbar card ScrollStyle" id="notes-list">
                        <div class="input-group mb-2">
                           <!-- <span class="bx bx-search-alt"></span> -->
                         

                           
                          
                           <!-- <input type="text" class="form-control" placeholder="Search..." id="search-note-list" style="line-height: 1.5; border: none; background-color: rgba(120,120,128,.16); border-radius: 10px;"> -->
                           <!-- <button type="button" class="btn bg-transparent" style="line-height: 0.5; margin-left: -40px; z-index: 100; display: none;" id="search-clear-list">
                              <i class="fa fa-times"></i>
                              </button> -->
                              
                        </div>
                           <?php if ($get_notes){
                           ?>
                           <div class="mail-list " >

                           <?php
                           foreach($get_notes as $note)
                           { 
                            $str = $note->content;
                            $title = $note->title;
                            $first20Chars = substr($str, 0, 15);
                            if (strlen($str) > 15) {
                                $first20Chars .= "...";
                            }

                            $title_old = substr($title, 0, 15);
                            if (strlen($title) > 15) {
                                $title_old .= "...";
                            }

                            if($title != ''){
                              $title = $title_old;
                              $title_new = $first20Chars;
                            }
                            else{
                              $title = $first20Chars;
                              $title_new = 'No additional text..';

                            }
                            $dateString = $note->updated_at;
                            $dateTime = new DateTime($dateString);
                            $newTime = $dateTime->format("h:i A");
                           ?>
                           <div class="note-list note-line_<?php echo $note->id ?>" onclick="noteView(<?php echo $note->id ?>)">
                             <a style="font-size: 16px; font-weight: 1000; color: #000;" href="javascript: void(0);" class="" ><?php echo $title;?></a>
                             <span style="margin-left: 5px; font-weight: 1000; color: #000;"><?php echo $newTime;?></span>
                             <span><?php echo strip_tags($title_new);?></span>
                             
                             <hr>
                           </div>
                             
                           <?php  
                           }
                           ?>
                           </div>
                           <?php }
                           else{
                              ?>
                           <p class="no-notes"><?php echo 'No Notes'?></p>

                              <?php
                           }
                           ?>
                        </div>
                        <!-- End Left sidebar -->
                        <!-- Right Sidebar -->
                        <div class="email-rightbar mb-3" id="notes-data">
                           <!-- <div class="card"> -->
                                <!-- <div class="btn-toolbar p-3" role="toolbar">
                                 <div class="btn-group me-2 mb-2 mb-sm-0">
                                 <button type="button" class="btn btn-d btn-sm" onclick="myFunction()">Save</button>   
                                </div>                                 
                              </div> -->
                              <!-- <span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span>
                              <input type="hidden" class="large-texttile" id="notes_title" placeholder="Title" onkeyup="cleanErr()"> -->
                              <!-- <textarea class="large-textarea" id="notes" placeholder="Notes" onkeyup="cleanErr()"></textarea> -->
 
                           <!-- </div> -->
                           <!-- <button type="button" class="btn btn-d btn-sm" onclick="myFunction()">Save</button>    -->
                               <span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span> 

                           <textarea class="form-control form-white" placeholder="Enter Notes" name="meeting_agenda" id="notes" onkeyup="cleanErr()"></textarea>

                            <div class="card">                    
                <style>  
                    .tox-checklist > li:not(.tox-checklist--hidden) {
                    list-style: none;
                    margin: 0.25em 0;
                    position: relative;
                    }
                    .tox-checklist > li:not(.tox-checklist--hidden)::before {
                    content: url("data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g id="checklist-unchecked" fill="none" fill-rule="evenodd"><rect id="Rectangle" width="15" height="15" x=".5" y=".5" fill-rule="nonzero" stroke="#4C4C4C" rx="2"/></g></svg>");
                    cursor: pointer;
                    height: 1em;
                    margin-left: -1.5em;
                    margin-top: 0.125em;
                    position: absolute;
                    width: 1em;
                    }
                    .tox-checklist li:not(.tox-checklist--hidden).tox-checklist--checked::before {
                    content: url("data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g id="checklist-checked" fill="none" fill-rule="evenodd"><rect id="Rectangle" width="16" height="16" fill="#4099FF" fill-rule="nonzero" rx="2"/><path id="Path" fill="#FFF" fill-rule="nonzero" d="M11.5703186,3.14417309 C11.8516238,2.73724603 12.4164781,2.62829933 12.83558,2.89774797 C13.260121,3.17069355 13.3759736,3.72932262 13.0909105,4.14168582 L7.7580587,11.8560195 C7.43776896,12.3193404 6.76483983,12.3852142 6.35607322,11.9948725 L3.02491697,8.8138662 C2.66090143,8.46625845 2.65798871,7.89594698 3.01850234,7.54483354 C3.373942,7.19866177 3.94940006,7.19592841 4.30829608,7.5386474 L6.85276923,9.9684299 L11.5703186,3.14417309 Z"/></g></svg>");
                    }
                    .tox-statusbar__text-container{
                     display: none !important;
                  }
                </style>
                <!-- <textarea id="checklist">
                <ul class="tox-checklist">
                    </ul>
                </textarea> -->
                <!-- <textarea class="form-control form-white" placeholder="Enter Notes" name="meeting_agenda" id="meeting_agenda"></textarea> -->

            <!-- </div> -->
                           <!-- card -->
                           <!-- <div class="row">
                              <div class="col-7">
                                 Showing 1 - 20 of 1,524
                              </div>
                              <div class="col-5">
                                 <div class="btn-group float-end">
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                 </div>
                              </div>
                           </div>
                        </div> -->
                        <!-- end Col-9 -->
                     </div>
                  </div>
                  </div>
                  <div class="tab-pane fade " id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                  <div class="row" >
                  <?php if ($get_notes){
                          
                           foreach($get_notes as $note)
                           {
                              
                              $str = $note->content;
                              $title = $note->title;
                              $first20Chars = substr($str, 0, 15);
                              if (strlen($str) > 15) {
                                  $first20Chars .= "...";
                              }
  
                              $title_old = substr($title, 0, 15);
                              if (strlen($title) > 15) {
                                  $title_old .= "...";
                              }
  
                              if($title != ''){
                                $title = $title_old;
                                $title_new = $first20Chars;
                              }
                              else{
                                $title = $first20Chars;
                                $title_new = 'No additional text..';
  
                              }
                              $dateString = $note->updated_at;
                              $dateTime = new DateTime($dateString);
                              $newDate = $dateTime->format("Y-m-d");

                              ?>
  <div class="col-md-6 col-xs-12 col-lg-3 search-cards note-list">
   <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
      <section class="new_card__part new_card__part-2">
         <div class="new_card__part__side m--back">
            <div class="new_card__part__inner new_card__face">
               <div class="new_card__face__colored-side"></div>
               <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                  <a href="javascript: void(0);" onclick="return updateNote('93');" title="View Portfolio: Chain">
                  <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                  $note_name = explode(" ", $title);
                  $nts_name = "";
                     $nts_name = $note_name[0];
                     $nts_name = $nts_name[0];
                  echo strtoupper($nts_name);
                   ?></span>
                  </a>
               </div>
               <div class="new_card__face__divider"></div>
               <div class="new_card__face__path theme-purple"></div>
               <div class="new_card__face__from-to">
                
                  <p class="ng-binding">
                     <a href="javascript:editNote(<?php echo $note->id?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $title?>" data-bs-original-title="" title="">
                     <?php echo $title?></a>
                  </p>
                  <p class="ng-binding"><?php echo $title_new?></p>
               </div>
               <div class="new_card__face__deliv-date ng-binding">
                  Create<i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(9);"></i>
                  <p class="ng-binding" id="task-duedate9"><?php echo $newDate?></p>
                </div>
               <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"></p>
                  <div class="avatar-group">
                     <!-- <div class="avatar-group-item">
                        <a href="javascript:void(0)" onclick="return TeamProfileModal(1)" class="text-white" title="View: Uzma Karjikar">
                        <img src="http://localhost/decision168/assets/student_photos/1673688131_1.png" alt="" class="rounded-circle avatar-xs">
                        </a>
                     </div> -->
                     <div class="btn-group me-2 mb-2 mb-sm-0" >
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="Save" onclick="editNote(<?php echo $note->id?>)" id="saveNote" data-updateid="" style="padding: 0 !important;font-size: 1.2rem; margin-left: 5px;"><i class="mdi mdi-file-document-edit-outline"></i></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="editNewNote()" style="padding: 0 !important;font-size: 1.2rem; margin-left: 10px;"><i class="mdi mdi-content-save-edit-outline"></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="deleteNote()" id="deleteNote" data-deleteid="" style="padding: 0 !important;font-size: 1.2rem; margin-left: 8px; padding-top: 1px !important;" title="Delete"><i class="bx bx-trash"></i></a>
            </div>
                  </div>
                  <p></p>
               </div>
            </div>
         </div>
      </section>
   </section>
   <!-- end ngRepeat: new_card in new_cards -->
</div>
                  
                  <?php
                           }
                        }
                  ?>
               </div>
                        <!-- end row -->
                     </div>
                  </div>
                  <!-- End row -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- Modal -->
            <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div>
                           <div class="mb-3">
                              <input type="email" class="form-control" placeholder="To">
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control" placeholder="Subject">
                           </div>
                           <div class="mb-3">
                              <form method="post">
                                 <textarea id="email-editor" name="area"></textarea>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send <i class="fab fa-telegram-plane ms-1"></i></button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end modal -->
            <?php
               include('footer.php');
               ?>
         </div>
         <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
      <!-- Right bar overlay-->
      <div class="rightbar-overlay"></div>
      <!-- JAVASCRIPT -->
      <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
      <!--tinymce js-->
            <!-- <script src="https://cdn.tiny.cloud/1/7v7gor314fr62t10k0vg4eqgh84efoxsibchc4767ohrfzas/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
                  <!-- <script src="<?php echo base_url();?>assets/libs/tinymce/tiny.js"></script> -->
      <script src="<?php echo base_url();?>assets/libs/tinymce_notes/js/tinymce/tinymce.min.js"></script>
      <!-- <script src="<?php echo base_url();?>assets/libs/tinymce/tinymce.min.js"></script> -->
      <!-- email editor init -->
      <!-- <script src="<?php echo base_url();?>assets/js/pages/email-editor.init.js"></script> -->
      <!-- App js -->
      <script src="<?php echo base_url();?>assets/js/app.js"></script>
      <?php
         include('footer_links.php');
         ?>
         <script>

function noteView(id) {
   // debugger;
   var notes = tinymce.get('notes');

    $.ajax({
        url: base_url + 'front/get_note',
        type: 'POST',
        data: {
            id: id
        },
        success: function(data) {
         $(".note-list").removeClass("note-active");  

            var data = JSON.parse(data);  
            for (var j = 0; j <data.length; j++) {
            var content = data[j].content;
            var title = data[j].title;
            var id = data[j].id;
            $('#notes-data').html('<div class="card"><span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span><textarea class="form-control form-white notesupdate" placeholder="Enter Notes" name="meeting_agenda_up" id="notes_update'+id+'">'+content+'</textarea></div></div>');
            // notes.setContent(content);
         }
            $('#createShow').hide();
            $('#updateShow').show();
            $('#saveNote').attr("data-updateid",id);
            $('#deleteNote').attr("data-deleteid",id);

            $(".note-line_"+id).addClass("note-active");
            // debugger;
         //    tinymce.init({
               
         //    selector: 'textarea#notes_update'+id,
         //    plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
         //    contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
         //    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
         //    width: "100%",
         //    height: 400,
         //    toolbar_mode: 'sliding',
         //    statusbar: false
         // });
         tinymce.remove('#notes_update'+id);
         tinymce.init({
      selector: 'textarea#notes_update'+id,
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      // toolbar: false,
      menubar:false,
      visual: false,
    });

        }
    });
    
}
function myFunction() {
      var x = document.getElementById("notes");
      //  var y = $("#notes").val();
      // var z = $("#notes_titl/e").val();
      // var y = (((tinyMCE.get('notes').getContent()).replace(/(&nbsp;)*/g, "")).replace(/(<p>)*/g, "")).replace(/<(\/)?p[^>]*>/g, "");
      
      var y=tinyMCE.get('notes').getContent();
      var notesEditor = tinymce.get('notes');

    $.ajax({
        url: base_url + 'front/store_note',
        type: 'POST',
        data: {
            text: y
            // title: z
        },
        success: function(data) {  
        if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                console.log(key);    
                console.log(val);    
                $('#'+ key).html(val);
            })
          }
          else{
            notesEditor.setContent('');
            // $("#notes_title").val('');
            Swal.fire("Created!", "Successfully.", "success");
            var divElement = document.getElementById('notes-list');
                if (divElement) {
                    $('#notes-list').load(document.URL + ' #notes-list'+'>*');  
                }
            }
        }
    });
    //   x.value = x.value.toUpperCase();
    }

    function updateNote() {
   //  var z = $("#notes").val();
   var id = $('#saveNote').attr("data-updateid");
    var z =tinyMCE.get('notes_update'+id).getContent();
      var notesEditor = tinymce.get('notes_update'+id);

    var x = $("#notes_title").val();
    $.ajax({
        url: base_url + 'front/updateNote',
        type: 'POST',
        data: {
            text: z,
            title: x,
            id: id
        },
        success: function(data) {
            Swal.fire("Updated!", "Successfully.", "success");
            var updateElement = document.getElementById('notes-list');
                if (updateElement) {
                    $('#notes-list').load(document.URL + ' #notes-list'+'>*');  
                }
                
             setTimeout(function(){
               $(".note-line_"+id).addClass("note-active");  
               }, 1000);


        }
    });
    }

    function deleteNote() {
      var id = $('#deleteNote').attr("data-deleteid");

      Swal.fire({
      title: "Are you sure?",
      text: "You want to delete note !",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
   }).then(function(result) {
      if (result.value) {
      $.ajax({
        url: base_url + 'front/delete_note',
        type: 'POST',
        data: {
            id: id
        },
        success: function(data) {
            var updateElement = document.getElementById('notes-list');
                if (updateElement) {
                    $('#notes-list').load(document.URL + ' #notes-list'+'>*');  
                }
                console.log('poi');
            $('#notes-data').html('<div class="card"><span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span><textarea class="form-control form-white" placeholder="Enter Notes" name="meeting_agenda" id="notes"></textarea></div></div>');
            
            $('#createShow').show();
            $('#updateShow').hide();
            $('#saveNote').attr("data-updateid","");
            $('#deleteNote').attr("data-deleteid","");

            tinymce.remove('#notes');
      tinymce.init({
      selector: 'textarea#notes',
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      // toolbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false,
    });
        }
    });
            }
            else {
               console.log('action failed');

            }
         });
   
    }
    function editNote(id) {
        document.getElementById("v-pills-list-tab").click();
        noteView(id);
        }
        function editNewNote(id) {
        document.getElementById("v-pills-list-tab").click();
        }
        function checkButton() {
            $('#createShow').show();
        }

        function checkButton2() {
            $('#createShow').hide();
            $('#updateShow').hide();
        }
            function newNote(id) {

            $('#createShow').show();
            $('#updateShow').hide();
            $('#saveNote').attr("data-updateid","");
            $('#deleteNote').attr("data-deleteid","");

      $('#notes-data').html('<div class="card"><span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span><textarea class="form-control form-white" placeholder="Enter Notes" name="meeting_agenda" id="notes"></textarea></div></div>');
      tinymce.remove('#notes');
      tinymce.init({
      selector: 'textarea#notes',
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      // toolbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false,
    });
    }
    function cleanErr() {
      alert();
      $('#textErr').html('');
    }

//     document.getElementById("notes_title").addEventListener("keydown", function(event) {
//     if (event.key === "Enter") {
//       event.preventDefault(); // Prevent the default behavior of the Enter key
//       // document.getElementById("notes").focus();
//       document.getElementsByClassName("mce-content-body ").focus();
//     }
//   });

// const titleInput = document.getElementById('notes_title');
// const notesTextarea = document.getElementById('notes');

// titleInput.addEventListener('keydown', function(event) {
//    console.log('ekjh');
//   if (event.keyCode === 13) { // Enter key
//     event.preventDefault(); // Prevent line break in the input field

//     notesTextarea.focus(); // Shift focus to the notes textarea
//   }
// });

  document.addEventListener("DOMContentLoaded", function() {
    var div = document.getElementById("notes-list");
    
    div.addEventListener("scroll", function() {
      if (div.scrollTop === 0) {
        div.style.overflowY = "hidden"; // Hide scrollbar when scrolled to top
      } 
      if (div.scrollTop === 1) {
        div.style.overflowY = "hidden"; // Hide scrollbar when scrolled to top
      }
      else {
        div.style.overflowY = "scroll"; // Show scrollbar when scrolled down
      }
    });
    
    window.addEventListener("resize", function() {
      if (div.scrollHeight > div.offsetHeight) {
        div.style.overflowY = "scroll"; // Show scrollbar when content exceeds height
      } else {
        div.style.overflowY = "hidden"; // Hide scrollbar when content fits
      }
    });
    
    window.addEventListener("load", function() {
      window.dispatchEvent(new Event("resize")); // Trigger resize event on page load
    });
  });

//   var divScroll = document.getElementById('notes-list');
  
//   divScroll.addEventListener('scroll', function() {
//    console.log('z');
//     if (divScroll.scrollHeight <= divScroll.clientHeight) {
//       console.log('n');
//       divScroll.style.overflowY = 'hidden';  // Hide scrollbar when content fits
//     } else {
//       console.log('y');

//       divScroll.style.overflowY = 'scroll';  // Show scrollbar when content exceeds the height
//     }
//   });
         $('#search-note-list').keyup(function(){
               //   debugger;
            $('.note-list').hide();
            $('#search-clear-list').css('display','block');
            var txt = $('#search-note-list').val();
            
               $('.note-list').each(function(){
                  if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                        $(this).show();
                  }
               });    
         });

         $("#search-clear-list").click(function(){
                $("#search-note-list").val("");
                $('.note-list').show();
                $('#search-clear-list').css('display','none');  
          });


         // tinymce.init({
         // selector: 'textarea#checklist',
         // plugins: 'lists checklist',
         // toolbar: 'checklist',
         // height: 250,
         // menu: {
         // format: {
         // title: 'Format',
         // items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
         // }
         // },
         // content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
         // });

         tinymce.init({
      selector: 'textarea#notes',
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      // toolbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false,
    });
   

    
         </script>
   </body>
</html>
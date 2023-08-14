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
      <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

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

.selected {
      border: 3px solid #006e3e;
      border-radius: 15px;
   }
   .new_selected {
      border: 3px solid #006e3e;
      border-radius: 15px;
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
                  <div class="row">
                     <div class="col-12">
                        <!-- Left sidebar -->
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
                <a class="h3 eye_preview float-end me-1 save_fun" href="javascript:void(0)" title="Save" onclick="myFunction()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-all-outline"></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="newNote()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-edit-outline"></i></a>
            </div> 
            <div class="btn-group me-2 mb-2 mb-sm-0" style="float: right; margin-left:30px; display:none" id="updateShow" >
               <a class="h3 eye_preview float-end me-1" href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#shareNoteModal" onclick="shareNote(this);" id="shrNote" data-shrid="" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.1rem;" title="Share"><i class="fas fa-share-alt"></i></a>   
               <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="duplicateNote(this);" id="dupNote" data-dupid="" data-index="0"style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>   
               <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="Save" onclick="updateNote()" id="saveNote" data-updateid="" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-all-outline"></i></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="newNote()" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;"><i class="mdi mdi-content-save-edit-outline"></i></a>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="deleteNote()" id="deleteNote" data-deleteid="" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
            </div>
            <div class="btn-group me-2 mb-2 mb-sm-0" style="float: right; margin-left:30px; display:none; " id="deleteShow">
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="deleteMultipleNote()" id="deleteMulNote" data-deleteid="" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
            </div>
            </div>

        </div>
    </div>
</div>
   <div class ="tab-content" id="v-pills-tabContent">
   <div class="tab-pane fade active show" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="email-leftbar card ScrollStyle" id="notes-list">
                        
                           <?php 
                           if ($getNotesMem){
                           ?>
                           <div class="mail-list " >

                           <?php
                           foreach($getNotesMem as $note)
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

               if($note->user_id == $this->session->userdata('d168_id')){
                  $access = '';
               }
               else{
                  $access = $note->access;
               }
                           ?>
                           <div class="note-list note-line_<?php echo $note->id ?>" onclick="noteView(<?php echo $note->id.','.$access ?>)">
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
                     </div>
                  </div>
                  </div>
                  <div class="tab-pane fade " id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                  <div class="row" >
                  <?php if ($getNotesMem){
                          $nstep = -1;
                           foreach($getNotesMem as $note)
                           {
                              $nstep++;
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
  <div class="col-md-6 col-xs-12 col-lg-3 search-cards note-list" >
   <section ng-repeat="new_card in new_cards" class="new_card theme-red drag_card" id="click_card<?php echo $note->id?>" data-color="#52A43A" data-index="<?php echo $nstep?>">
      <section class="new_card__part new_card__part-2">
         <div class="new_card__part__side m--back">
            <div class="new_card__part__inner new_card__face">
               <div class="new_card__face__colored-side"></div>
               <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                  <a href="javascript: void(0);" onclick="return updateNote(<?php echo $note->id?>);" title="View Portfolio: Chain">
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
                     <a href="javascript:editNote(<?php echo $note->id.','.$note->access?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $title?>" data-bs-original-title="" title="">
                     <?php echo $title?></a>
                  </p>
                  <p class="ng-binding"><?php echo $title_new?></p>
               </div>
               <div class="new_card__face__deliv-date ng-binding">
                  Create<i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(9);"></i>
                  <p class="ng-binding" id="task-duedate9"><?php echo $newDate?></p>
                </div>
               <?php
               if($note->user_id == $this->session->userdata('d168_id')){
                  ?>

               <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"></p>
                  <div class="avatar-group">
                     <div class="btn-group me-2 mb-2 mb-sm-0" >
                     <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="duplicateNote(this);" id="dupNote" style="padding: 0 !important;font-size: 1.2rem; margin-left: 5px;" title="Duplicate" data-dupid="<?php echo $note->id?> " data-index="1"><i class="mdi mdi-content-duplicate"></i></a>
                     <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="Save" onclick="editNote(<?php echo $note->id.','.$note->access?>)" id="saveNote" data-updateid="" style="padding: 0 !important;font-size: 1.2rem; margin-left: 5px;"><i class="mdi mdi-file-document-edit-outline"></i></i></a>
                     <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" title="New" onclick="editNewNote()" style="padding: 0 !important;font-size: 1.2rem; margin-left: 10px;"><i class="mdi mdi-content-save-edit-outline"></i></a>
                     <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="deleteNoteGrid(<?php echo $note->id?>)" id="deleteNote" data-deleteid="" style="padding: 0 !important;font-size: 1.2rem; margin-left: 8px; padding-top: 1px !important;" title="Delete"><i class="bx bx-trash"></i></a>
                  </div>
                  </div>
                  <p></p>
               </div>
                  <?php
               }
               ?>
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
            <div class="modal fade" id="shareNoteModal" tabindex="-1" role="dialog" aria-labelledby="shareNoteModalTitle" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="shareNoteModalTitle">Add Members</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form name="note_AddTeamMemberForm" id="note_AddTeamMemberForm" method="post">
                     <div class="modal-body">
                           <div class="row mb-2">
                              <div class="col-lg">
                            <select name="note_mem"  id="note_add_mem" class=" form-control note_mem pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Note_Members();" required>
                           </select>
                           <input type="hidden" name="selected_note_mem" id="selected_note_mem">
                              </div>
                              <input type="hidden" name="total_note" id="total_note" value="">
                           </div>
                        <div class="imember_div">
                        </div>
                        <span id="err_valid" class="text-danger"></span>
                        <input class="form-check-input ms-2 changes" type="checkbox" name="changes" value="1" id="write" >
                        <label class="form-check-label" for="changes">
                           Edit
                        </label>
                        <input class="form-check-input ms-2 changes" type="checkbox" name="changes"  value="2" id="read">
                        <label class="form-check-label" for="view">
                        View only
                        </label>
                  </div>
                  <span id="checkboxErr" class="text-danger" style="margin-left: 25px;"></span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="note_AddTeamMemberButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="http://localhost/decision168/assets/images/loading.gif">
                </div>                
            </form>
                  </div>
               </div>
            </div>
            <!-- end modal -->

             <!-- Project Duplicate Modal -->
             <div id="duplicate_noteModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_noteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content" id="duplicate_noteModal_content">
                     <div class="modal-header">
    <h5 class="modal-title mt-0" id="duplicate_noteModalLabel">Copy Note</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="dupid-data" value="">
    <form method="post" class="duplicate_note_form" name="duplicate_note_form" id="duplicate_note_form" autocomplete="off">
    <div class="row mb-2">
          <label for="nname" class="col-form-label col-lg-3">Note Name <span class="text-danger">*</span></label>
          <div class="col-lg-9">
              <input id="nname" name="nname" type="text" class="form-control" placeholder="Enter Note Name..." required="" value="">
              <span id="nnameErr" class="text-danger"></span>
          </div>
      </div>
    <div class="row">
          <div class="col-lg-12">
              <button type="submit" id="duplicate_note_button" class="btn btn-d btn-sm float-end">Duplicate</button>
              <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
          </div>
      </div>
      </form>
    </div>

                     </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            
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
      <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
      <!-- <script src="https://cdn.tiny.cloud/1/mbozjrs9xdctrp60i6p8fpnr2yqnvr53fecxu7qpznwjjnt6/tinymce/5-stable/tinymce.min.js"></script> -->
      <script src="<?php echo base_url();?>assets/libs/tinymce_notes/js/tinymce/tinymce.min.js"></script>

      <?php
         include('footer_links.php');
         ?>
         <script>
    const checkboxes = document.querySelectorAll('.form-check-input');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
</script>

         <script>
            var apopt;
            $(document).ready(function(){


   var add_more_member  = $('.add_more_member '); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var total_note = $('#total_note').val();
   var memberHTML = '<div class="row mb-2"><div class="col-lg-7"><select name="note_mem"  class=" form-control pro_team_member note_mem note_new " data-placeholder="Assign Goal Manager..." onchange="return Note_Members();"></selected><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-5 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_more_member2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   var a = 2;
   
   var note_new = $('.note_new'); //Input field wrapper

   //Once add button is clicked
   $(add_more_member ).click(function(){
      // alert();
    if(total_note != "")
    {
        if(a < total_note)
          {
               $(imember_div).append(memberHTML);
                  a++;
          }
    }
    else
    {
        $(imember_div).append(memberHTML);
    }
    

    // Get all target select elements by class name
    const targetSelects = document.querySelectorAll('.note_new');
console.log(targetSelects);
// Function to copy options from source to target select
function copyOptions(sourceSelect, targetSelect) {
    const options = sourceSelect.querySelectorAll('option');
    options.forEach(option => targetSelect.appendChild(option.cloneNode(true)));
}

// Get all source select elements by class name or any other suitable selector
const sourceSelects = document.querySelectorAll('.form-control.note_mem.pro_team_member.select2-hidden-accessible');
console.log(sourceSelects);

// Loop through each source select
sourceSelects.forEach(function(sourceSelect) {
    // Loop through each target select and copy options
    targetSelects.forEach(function(targetSelect) {
        copyOptions(sourceSelect, targetSelect);
    });
});

   });

   $(imember_div).on('click', '.add_more_member2', function(e){
      //debugger;
      if(total_note != "")
        {
            if(a < total_note)
              {
                   $(imember_div).append(memberHTML);
                   a++;
              }
        }
        else
        {
            $(imember_div).append(memberHTML);
        }
   });
   
   //Once remove button is clicked
   $(imember_div).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       if(total_note != "")
        {
           a--;
        }
       x--; //Decrement field counter
   });

});
</script>
         <script>
function shareNote(event) {
    //  debugger;

   var id = $(event).attr('data-shrid');
   
  //  $('.note_mem').attr("data-id",id);
    $('#total_note').val(id);

    $.ajax({
        url: base_url + 'front/get_noteMem',
        type: 'POST',
        data: {
            note_id: id
        },
        success: function(data9) {
          $('#note_add_mem').html(data9);

        }
      });


  
}
var arr = [];


function deleteMultiple(event) {
   var id = $(event).attr('id');
   $('#deleteShow').show();
   
   // Check if the ID already exists in the array
   if (!arr.includes(id)) {
     arr.push(id);
   }else{
      removeSelected(id);
   }

   console.log(arr);
   
   arr.forEach(function(id) {
      var element = document.getElementById(id);
      if (element) {
         element.classList.add('selected');
      }
   });
}
function removeSelected(id) {
   // alert(id);
   var index = arr.indexOf(id);
   if (index > -1) {
      arr.splice(index, 1); // Remove the ID from the array
   }

   var element = document.getElementById(id);
   if (element) {
      element.classList.remove('selected');
   }
   if (arr.length == 0) {
      $('#deleteShow').hide();
   }
}
function deleteMultipleNote() {



   var deleteIds = arr.map(function(str) {
   return parseInt(str.match(/\d+$/)[0]);
   });
  
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
        url: base_url + 'front/delete_multiple_note',
        type: 'POST',
        data: {
            id: deleteIds
        },
        success: function(data9) {
         $('#v-pills-grid').load(document.URL + ' #v-pills-grid'+'>*'); 
         $('#notes-list').load(document.URL + ' #notes-list'+'>*');  

      $('#deleteShow').hide();

        }
      });
   }
});

}

   $('#duplicate_notegrid_form').on('submit',function(event){
   //  debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#duplicate_note_button').hide();
    $('#loader2').css('visibility','visible');
  
   var dataId = $('#dupid-data').val();

   Swal.fire({
      title: "Are you sure?",
      text: "You want to duplicate note!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
   }).then(function(result) {
      if (result.value) {

         
$.ajax({
    url: base_url + 'front/get_note',
        type: 'POST',
        data: {
            id: dataId
        },
        success: function(data3) {
         var data3 = JSON.parse(data3); 
         console.log(data3);
        

         for (var j = 0; j <data3.length; j++) {
            var content3 = data3[j].content;
            var title3 = data3[j].title;
            var id3 = data3[j].id;
            
                  $.ajax({
        url: base_url + 'front/store_duplicate_note',
        type: 'POST',
        data: {
            text: content3,
            title: title3
        },
        success: function(data4) {  
        if (data4.status == false)
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
            Swal.fire("Duplicate!", "Successfully.", "success");
            var divElement = document.getElementById('notes-list');
                if (divElement) {
                    $('#notes-list').load(document.URL + ' #notes-list'+'>*');  
                }
              
            
            var id5 = data4.id;

                $('#notes-data').html('<div class="card"><span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span><textarea class="form-control form-white notesupdate" placeholder="Enter Notes" name="meeting_agenda_up" id="notes_update'+id5+'">'+content3+'</textarea></div></div>');
            tinymce.remove('#notes_update'+id5);
         tinymce.init({
      selector: 'textarea#notes_update'+id5,
      plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
    });
           
            $('#saveNote').attr("data-updateid",id5);
            $('#deleteNote').attr("data-deleteid",id5);
            $('#dupNote').attr("data-dupid",id5);
            $('#shrNote').attr("data-shrid",id5);
   document.getElementById("v-pills-list-tab").click();

   $('#v-pills-grid').load(document.URL + ' #v-pills-grid'+'>*');  

   $('#createShow').hide();
                $('#updateShow').show();
               //  }
            }
        }
    });
         }

   



        }
      });
      }
   });
});
function duplicateNote(elements) {
      var id = elements.getAttribute('data-dupid');
     

   $.ajax({
    url:  base_url+'front/get_note',
    type: 'post',
    data: {id: id},
    success: function(data){ 

      var data = JSON.parse(data); 
      
         for (var j = 0; j <data.length; j++) {
            // var content = data[j].content;
            var title = data[j].title;
            var id = data[j].id;
            $('#nname').val(title +' ' +'[copy]'); 
            $('#dupid-data').val(id); 
            $('#duplicate_noteModal').modal('show'); 
         }
    }
  });
}
   $('#duplicate_note_form').on('submit',function(event){
   //  debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#duplicate_note_button').hide();
    $('#loader2').css('visibility','visible');
  var id = $('#dupid-data').val();

   $.ajax({
        url: base_url + 'front/get_note',
        type: 'POST',
        data: {
            id: id
        },
        success: function(data) {
         var data = JSON.parse(data);         
         for (var j = 0; j <data.length; j++) {
            var content = data[j].content;
            // var title = data[j].title;
            var id = data[j].id;

            var new_title = $('#nname').val();
      $.ajax({
        url: base_url + 'front/store_duplicate_note',
        type: 'POST',
        data: {
            text: content,
            title: new_title
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
            $('#duplicate_noteModal').modal('hide'); 
            Swal.fire("Duplicate!", "Successfully.", "success");
            var divElement = document.getElementById('notes-list');
                if (divElement) {
                    $('#notes-list').load(document.URL + ' #notes-list'+'>*');  
                }
                noteView(data.id,'');
            var id2 = data.id;

      $('#notes-data').html('<div class="card"><span id="textErr" class="text-danger" style="padding:10px 0px 0px 20px;"></span><textarea class="form-control form-white notesupdate" placeholder="Enter Notes" name="meeting_agenda_up" id="notes_update'+id2+'">'+content+'</textarea></div></div>');
      tinymce.remove('#notes_update'+id2);
      tinymce.init({
      selector: 'textarea#notes_update'+id2,
      plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
    });
            $('#saveNote').attr("data-updateid",id2);
            $('#deleteNote').attr("data-deleteid",id2);
            $('#dupNote').attr("data-dupid",id2);
            $('#shrNote').attr("data-shrid",id2);

   
   $('#v-pills-grid').load(document.URL + ' #v-pills-grid'+'>*');  
   $('#createShow').hide();
                $('#updateShow').show();
                $('#duplicate_note_button').show();
            $('#loader2').css('visibility','hidden');  
      
            }
        }
    });
         }
        }
      });
   
});

 // Function to remove the 'data' parameter from the URL
 function removeDataParameterFromURL() {
            // Get the current page URL
            var currentURL = window.location.href;
            
            // Check if the URL contains the 'data' parameter
            if (currentURL.indexOf('?data=') !== -1) {
                // Remove the 'data' parameter and its value from the URL
                var updatedURL = currentURL.replace(/\?data=[^&]+/, '');
                
                // Update the browser's address bar with the new URL
                history.replaceState({}, '', updatedURL);
            }
        }

        

function noteView(id,id2) {

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
         if(id2 == '2'){

            $('#createShow').show();
            $('#updateShow').hide();
            $('.save_fun').hide();
            $(".note-line_"+id).addClass("note-active");
         tinymce.remove('#notes_update'+id);
         tinymce.init({
            selector: 'textarea#notes_update'+id,
            readonly: true, // Enable read-only mode
            toolbar: false, // Hide the toolbar for read-only mode
            menubar: false, // Hide the menubar for read-only mode
            width: "100%",
            height: 500,
            toolbar_mode: 'sliding',
            statusbar: false,
            visual: false,
      });
         }
         else{
            $('#createShow').hide();
            $('#updateShow').show();
            $('.save_fun').show();

            $('#saveNote').attr("data-updateid",id);
            $('#deleteNote').attr("data-deleteid",id);
            $('#dupNote').attr("data-dupid",id);
            $('#shrNote').attr("data-shrid",id);
            $(".note-line_"+id).addClass("note-active");
         tinymce.remove('#notes_update'+id);
         tinymce.init({
      selector: 'textarea#notes_update'+id,
      plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
    });
         }
            

        }
    });

    // Call the function to remove the 'data' parameter on page load
    removeDataParameterFromURL();
}



function myFunction() {
      var x = document.getElementById("notes");
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
    }

    function updateNote() {
   //  var z = $("#notes").val();
   var id = $('#saveNote').attr("data-updateid");
   x = $("#notes_title").val();
      var notesEditor = tinymce.get('notes_update'+id);
      var  z =tinyMCE.get('notes_update'+id).getContent();
      
    

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
  
      
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (decodeURIComponent(pair[0]) === variable) {
            return decodeURIComponent(pair[1]);
        }
    }
}

var myFinalValue = getQueryVariable('data');
console.log(myFinalValue);
if(myFinalValue){
// Now, extract the individual values for myID and aID from the myFinalValue string
var parsedValues = myFinalValue.split('&');
var myID = null;
var aID = null;

parsedValues.forEach((value) => {
    var pair = value.split('=');
    if (pair[0] === 'myID') {
        myID = parseInt(pair[1]);
    } else if (pair[0] === 'aID') {
        aID = parseInt(pair[1]);
    }
});

console.log("myID:", myID); // Output: 123
console.log("aID:", aID);   // Output: 456

        if(myID){
         noteView(myID,aID);
        }
}

         // notification redirect start



    function deleteNoteGrid (id) {
   var deleteId = id;

   
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
            id: deleteId
        },
        success: function(data9) {
         $('#v-pills-grid').load(document.URL + ' #v-pills-grid'+'>*'); 
         $('#notes-list').load(document.URL + ' #notes-list'+'>*');  


        }
      });
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
            $('#dupNote').attr("data-dupid","");
            $('#shrNote').attr("data-shrid","");


            tinymce.remove('#notes');
      tinymce.init({
      selector: 'textarea#notes',
      plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
    });
        }
    });
            }
            else {
               console.log('action failed');

            }
         });
   
    }
    function editNote(id,id5) {
      // alert();
        document.getElementById("v-pills-list-tab").click();
        noteView(id,id5);
        }
        function editNewNote(id) {
        document.getElementById("v-pills-list-tab").click();
        }
        function checkButton() {
            $('#createShow').show();
            // $('#v-pills-list').load(document.URL + ' #v-pills-list'+'>*');  
            $('#notes-list').load(document.URL + ' #notes-list'+'>*');  

        }

        function checkButton2() {
            $('#createShow').hide();
            $('#updateShow').hide();
            $('#v-pills-grid').load(document.URL + ' #v-pills-grid'+'>*');  
         
         var deleteButton = document.getElementById('deleteShow');

         if (deleteButton) {
        // Class exists
         deleteButton.style.display = 'none';
         } else {
            deleteButton.style.display = 'block';
         }
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
      plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
    });
    }
    function cleanErr() {
      // alert();
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
      //    tinymce.init({
      // selector: 'textarea#notes',
      // plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      // contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      // width: "100%",
      // height: 500,
      // toolbar_mode: 'sliding',
      // statusbar: false,
      // menubar:false,
      // visual: false,
      // inline_boundaries: false,
      // plugins: 'lists checklist',
//   toolbar: 'checklist',
//   height: 250,
//   menu: {
//     format: {
//       title: 'Format',
//       items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
//     }
//   },
//   content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
   //  });

   
tinymce.init({
  selector: 'textarea#notes',
  plugins: 'lists checklist anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
  toolbar: 'checklist undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
  height: 250,
  menu: {
    format: {
      title: 'Format',
      items: 'checklist | bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
    }
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  width: "100%",
      height: 500,
      toolbar_mode: 'sliding',
      statusbar: false,
      menubar:false,
      visual: false,
      inline_boundaries: false
});


    function Note_Members() {
  var selected = [];
  var noteMembers = document.getElementsByClassName('note_mem');

  for (var i = 0; i < noteMembers.length; i++) {
    var element = noteMembers[i];
    if (element.tagName === 'SELECT') {
      for (var j = 0; j < element.options.length; j++) {
        var option = element.options[j];
        if (option.selected) {
          selected.push(option.value);
        }
      }
    }
  }

  document.getElementById("selected_note_mem").value = selected;
}

// FOR ADD TEAM MEMBER FORM ----------------------------------------
$('#note_AddTeamMemberForm').on('submit',function(event){
         //  debugger;          
          event.preventDefault(); // Stop page from refreshing

           // Check if at least one checkbox is checked
  if (!$('#write').prop('checked') && !$('#read').prop('checked')) {
   //  alert('Please check at least one checkbox.');
    $('#checkboxErr').text('Please check at least one checkbox.')
    return; // Do not submit the form
  }

          $('#note_AddTeamMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/note_AddTeamMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
               success: function(data){
                if (data.status == false)
                {
                  //show errors
                  $('[id*=Err]').html('');
                  $.each(data.errors, function(key, val) {
                      var key =key.replace(/\[]/g, '');
                      key=key+'Err';
                      //console.log(key);    
                      $('#'+ key).html(val);
                  })
                  $('#note_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'Empty_NMember')
                {
                   $('#selected_T_memberErr').html('Please select Team Member!');
                   $('#note_AddTeamMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        
        // function for multiple delete
        $(function() { 
  // alert('87');
let isMouseDownNote = false;
let selectedCardsNote = [];

// Function to add the selected class to the cards
function updateSelectedCardsNote() {
var cardsNote = document.querySelectorAll('.drag_card');
console.log(cardsNote);
cardsNote.forEach((cardNote, index) => {
if (selectedCardsNote.includes(index)) {
cardNote.classList.add('new_selected');
} else {
cardNote.classList.remove('new_selected');
}

});
}

// Function to handle card selection
function handleCardSelectionNote(indexNote, isShiftPressedNote) {
if (!isShiftPressedNote) {
// If Shift key is not pressed, select/deselect the clicked card independently
var selectedIndexNote = selectedCardsNote.indexOf(indexNote);
if (selectedIndexNote !== -1) {
// Deselect the card if it is already selected
selectedCardsNote.splice(selectedIndexNote, 1);
} else {
// Select the card if it is not already selected
selectedCardsNote.push(indexNote);
}
} else {
// If Shift key is pressed, add/remove the clicked card to/from the current selection range
var minIndexNote = Math.min(indexNote, selectedCardsNote[0]);
var maxIndexNote = Math.max(indexNote, selectedCardsNote[selectedCardsNote.length - 1]);

selectedCardsNote = [];
for (let i = minIndexNote; i <= maxIndexNote; i++) {
selectedCardsNote.push(i);
}
}
// Update the selection status of cards
updateSelectedCardsNote();


var deleteButton = document.getElementById('deleteShow');
if (selectedCardsNote.length === 0) {
deleteButton.style.display = 'none';
} else {
deleteButton.style.display = 'block';
}
}

// Event listener for clicking on a card
function handleCardClickNote(event) {
var indexNote = parseInt(event.currentTarget.getAttribute('data-index'), 10);
var noteisShiftPressed = event.shiftKey;

handleCardSelectionNote(indexNote, noteisShiftPressed);
}

// Event listener for the mouse down on a card
function handleMouseDownNote(event) {
isMouseDownNote = true;
}

// Event listener for the mouse up on a card
function handleMouseUpNote(event) {
isMouseDownNote = false;
}

// Event listener for hovering over a card
function handleCardHoverNote(event) {
if (isMouseDownNote) {
var noteindex = parseInt(event.currentTarget.getAttribute('data-index'), 10);
handleCardSelectionNote(noteindex, true);
}
}

// Add event listeners to the cards
var notecards = document.querySelectorAll('.drag_card');
notecards.forEach((notecard) => {
notecard.addEventListener('click', handleCardClickNote);
notecard.addEventListener('mousedown', handleMouseDownNote);
notecard.addEventListener('mouseup', handleMouseUpNote);
notecard.addEventListener('mouseover', handleCardHoverNote);
});

// Clear selection on the document when the mouse is up outside the cards
document.addEventListener('mouseup', () => {
isMouseDownNote = false;
});
});

         </script>
         
   </body>
</html>
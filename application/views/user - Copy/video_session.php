<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video Session</title>
  </head>
  <body>
    <?php
    $stud_del = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $student_name = ucwords($stud_del->first_name.' '.$stud_del->last_name);
    $meeting_id = $this->uri->segment(2);
    $call_id = $this->uri->segment(3);
    $dataa = array('call_completed' => 1);
    $dataa = $this->security->xss_clean($dataa); // xss filter
    $this->Front_model->updateCallBooking($dataa,$call_id);
    $this->Front_model->updateEventCallBooking($dataa,$call_id);
    ?>
    <script>
      var script = document.createElement("script");
      script.type = "text/javascript";
      //
      script.addEventListener("load", function (event) {
        // Initialize the factory function
        const meeting = new VideoSDKMeeting();

        // Set apikey, meetingId and participant name
        const apiKey = "ec7941a8-287c-464e-9e6a-ded14bcd51d6"; // generated from app.videosdk.live
        const meetingId = "<?php echo $meeting_id; ?>";
        const name = "<?php echo $student_name; ?>";

        const config = {
          name: name,
          apiKey: apiKey,
          meetingId: meetingId,

          region: "sg001", // region for new meeting

          containerId: null,
          redirectOnLeave: "<?php echo base_url(); ?>",

          micEnabled: true,
          webcamEnabled: true,
          participantCanToggleSelfWebcam: true,
          participantCanToggleSelfMic: true,
          participantCanLeave: true, // if false, leave button won't be visible

          chatEnabled: true,
          screenShareEnabled: true,
          pollEnabled: true,
          whiteboardEnabled: true,
          raiseHandEnabled: true,

          recording: {
            autoStart: false, // auto start recording on participant joined
            enabled: true,
            webhookUrl: "<?php echo base_url(); ?>",
            awsDirPath: "<?php echo base_url('assets/video_sessions'); ?>", // automatically save recording in this s3 path
          },

          livestream: {
            autoStart: false,
            enabled: false,
            outputs: [
              // {
              //   url: "rtmp://x.rtmp.youtube.com/live2",
              //   streamKey: "afrin",
              // },
            ],
          },

          layout: {
            type: "SPOTLIGHT", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
            priority: "PIN", // "SPEAKER" | "PIN",
            // gridSize: 3,
          },

          branding: {
            enabled: true,
            logoURL:
              "http://localhost/decision168/assets/images/logo-main.png",
            name: "",
            poweredBy: false,
          },

          permissions: {
            pin: true,
            askToJoin: false, // Ask joined participants for entry in meeting
            toggleParticipantMic: true, // Can toggle other participant's mic
            toggleParticipantWebcam: true, // Can toggle other participant's webcam
            drawOnWhiteboard: true, // Can draw on whiteboard
            toggleWhiteboard: true, // Can toggle whiteboard
            toggleRecording: true, // Can toggle meeting recording
            toggleLivestream: false, //can toggle live stream
            removeParticipant: true, // Can remove participant
            endMeeting: true, // Can end meeting
            changeLayout: true, //can change layout
          },

          joinScreen: {
            visible: true, // Show the join screen ?
            title: "Connect with our Decision Maker", // Meeting title
            meetingUrl: window.location.href, // Meeting joining url
          },

          leftScreen: {
            // visible when redirect on leave not provieded
            actionButton: {
              // optional action button
              label: "Decision168", // action button label
              href: "https://www.decision168.com/", // action button href
            },
          },

          notificationSoundEnabled: true,

          debug: true, // pop up error during invalid config or netwrok error

          maxResolution: "sd", // "hd" or "sd"
        };

        meeting.init(config);
      });

      script.src =
        "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.30/rtc-js-prebuilt.js";
      document.getElementsByTagName("head")[0].appendChild(script);
    </script>
  </body>
</html>
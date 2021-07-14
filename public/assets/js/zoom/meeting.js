window.addEventListener('DOMContentLoaded', function(event) {
    websdkready();
  });
  
  function websdkready() {
    var testTool = window.testTool;
    // get meeting args from url
    var tmpArgs = testTool.parseQuery();
    var meetingConfig = {
      apiKey: atob(tmpArgs.apiKey),
      meetingNumber: atob(tmpArgs.mn),
      userName: (function () {
        if (tmpArgs.name) {
          try {
            return testTool.b64DecodeUnicode(tmpArgs.name);
          } catch (e) {
            return atob(tmpArgs.name);
          }
        }
        return (
          "CDN#" +
          tmpArgs.version +
          "#" +
          testTool.detectOS() +
          "#" +
          testTool.getBrowserInfo()
        );
      })(),
      passWord: atob(tmpArgs.pwd),
      leaveUrl: "/home",
      role: parseInt(atob(tmpArgs.role), 10),
      userEmail: (function () {
        try {
          return testTool.b64DecodeUnicode(tmpArgs.email);
        } catch (e) {
          return atob(tmpArgs.email);
        }
      })(),
      lang: atob(tmpArgs.lang),
      signature: atob(tmpArgs.signature),
      china: atob(tmpArgs.china)
    };
  
  
    // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
    // ZoomMtg.setZoomJSLib("https://source.zoom.us/1.9.1/lib", "/av"); // CDN version defaul
    if (meetingConfig.china)
      ZoomMtg.setZoomJSLib("https://jssdk.zoomus.cn/1.9.1/lib", "/av"); // china cdn option
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    function beginJoin(signature) {
      ZoomMtg.init({
        leaveUrl: meetingConfig.leaveUrl,
        webEndpoint: meetingConfig.webEndpoint,
        meetingInfo: [ // optional
        ],
        success: function () {
          //console.log(meetingConfig);
          //console.log("signature", signature);
          ZoomMtg.i18n.load(meetingConfig.lang);
          ZoomMtg.i18n.reload(meetingConfig.lang);
          ZoomMtg.join({
            meetingNumber: meetingConfig.meetingNumber,
            userName: meetingConfig.userName,
            signature: signature,
            apiKey: meetingConfig.apiKey,
            userEmail: meetingConfig.userEmail,
            passWord: meetingConfig.passWord,
            success: function (res) {
              //console.log("join meeting success");
              //console.log("get attendeelist");
              ZoomMtg.getAttendeeslist({});
              ZoomMtg.getCurrentUser({
                success: function (res) {
                  ZoomMtg.record({
                    record: true
                    });
                  //console.log("success getCurrentUser", res.result.currentUser);
                },
              });
            },
            error: function (res) {
              //console.log(res);
            },
          });
        },
        error: function (res) {
          //console.log(res);
        },
      });
  
      ZoomMtg.inMeetingServiceListener('onUserJoin', function (data) {
        //console.log('inMeetingServiceListener onUserJoin', data);
      });
    
      ZoomMtg.inMeetingServiceListener('onUserLeave', function (data) {
        //console.log('inMeetingServiceListener onUserLeave', data);
      });
    
      ZoomMtg.inMeetingServiceListener('onUserIsInWaitingRoom', function (data) {
        //console.log('inMeetingServiceListener onUserIsInWaitingRoom', data);
      });
    
      ZoomMtg.inMeetingServiceListener('onMeetingStatus', function (data) {
        //console.log('inMeetingServiceListener onMeetingStatus', data);
      });
    }
  
    beginJoin(meetingConfig.signature);
  };
  
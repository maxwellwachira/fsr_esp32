window.addEventListener('DOMContentLoaded', function(event) {
    websdkready();
    
  });

function websdkready() {
    var testTool = window.testTool;
    ZoomMtg.preLoadWasm(); // pre download wasm file to save time.
    
    // click join meeting button
    document
    .getElementById("join_meeting")
    .addEventListener("click", function (e) {
        e.preventDefault();
        
        $.ajax({
            url:"/zoom-signature",  
            method:"POST",  
            data:{},
            dataType: 'text', 
            success:function(res)  
            {
                var response = JSON.parse(res);
                //console.log(meetingConfig);
                var meetingConfig = {
                    name: btoa(response.name),
                    mn: btoa(response.mn),
                    email: btoa(response.email),
                    pwd: btoa(response.pwd),
                    role: btoa(response.role),
                    signature: btoa(response.signature),
                    china: btoa(response.china),
                    apiKey: btoa(response.apiKey),
                    lang: btoa(response.lang)
                }
                var joinUrl = "/meeting?" + testTool.serialize(meetingConfig);
                window.open(joinUrl);
            },
            error: function(e){
            }

        });
    });
}

var successAlert = document.getElementById("successAlert");
var pendingAlert = document.getElementById("pendingAlert");
var modalClose = document.getElementById("modalClose");
var failureUi = document.getElementById("modalFailedUi");
var paymentStatus = false;

//skip here before going live
init();
//preventRefresh(); 
//warn user that order will be lost if they refresh
//create a more clean way to prevent form to be submitted again when use refreshes the webpage
 function init(){

    //preventRefresh();

    var timerID = setInterval(function() {
        // your code goes here...
        checkPaymentStatus();
    }, 10 * 1000); 

    setTimeout(function() {
        clearInterval(timerID);
        paymentStatusCountCheck();      
    }, 300000);

 }

 function preventRefresh(){
    $(window).on('popstate', function(event) {
        return true;
       });

    //replace with sweet alerts
       window.onbeforeunload = function() {
        return "Are you sure you want to refresh. Your order will be lost.";
    }
 }

 function stkPush(){
    init();
    requestSTKpush();
 }

 function stkRequest(){
    $('#failureResponseModal').modal('hide');
     init();
     requestSTKpush();
 }

 function paymentStatusCountCheck(){
     if(!paymentStatus){
        $('#exampleModalCenter').modal('hide');
        $('#failureResponseModal').modal('show');
     } 

 }


 function requestSTKpush() {
    let _token = $('meta[name="csrf-token"]').attr('content');
    let BillrefNo = $("input[name=orderNumber]").val();

    //console.log(BillrefNo);

    $.ajax({
       type:'POST',
       url:'/requestMpesa',
       dataType: 'json',
       data:{
            BilRefNo:BillrefNo,
            _token:_token,
        },
       success:function(data) {

           if(data.status){
            //disable the request button
            $(".reSubmitButton").prop('disabled', true);

            //bring up a modal to show waiting to process payment
            $('#exampleModalCenter').modal("show");
            $(".modalClose").prop("disabled", true);    


            setTimeout(function() {
                $(".reSubmitButton").removeAttr("disabled");  
            }, 30000);

            setTimeout(function(){
                $(".modalClose").prop("disabled", false);    
            }, 1000);

            console.log(data.success);

           } else {

            console.log(data.message);
            $(".reSubmitButton").prop('disabled', true);
            $(".modalClose").prop("disabled", false);   
            failureUi.style.display = "block";
            //update ui to reflect failed request

           }

       }

    });
 }

 function checkPaymentStatus(){
    let _token = $('meta[name="csrf-token"]').attr('content');
    let BillrefNo = $("input[name=orderNumber]").val();

    //console.log(BillrefNo);

    $.ajax({
       type:'POST',
       url:'/requestOrderPaymentConfirmation',
       dataType:'json',
       data:{
            BilRefNo:BillrefNo,
            _token:_token,
        },
       success:function(odata) {

            //console.log(odata);
            if(odata.status){
                //check if modal is open. if true disable the modal and change ui of succsess alert or else change ui
            $('#exampleModalCenter').modal('hide');
            paymentStatus = true;
            
             pendingAlert.style.display = "none";
             successAlert.style.display = "block";
                //console.log(odata.success);

            } else {

                console.log(odata.failure);

            }        
       }

    });
 }
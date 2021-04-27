$(document).ready(function(){
    
    var previous = null;
    var current = null;

    setInterval(function() {
        $.getJSON('/recv/msgs', function(json) {
            current = JSON.stringify(json);
            if (previous && current && previous !== current) {
                console.log('refresh');
                location.reload();
            }
            previous = current;
        });
    }, 2000); 

    // $.ajax({
    //     url: '/recv/msgs',
    //     type: 'GET',
    //     // async: false,
    //     dataType: "json",
    //     success: function (response){
    //         console.log('Data Fetching, Success!');
    //         console.log(response);

    //         var trTD = "";
    //         var phone = "";
    //         $.each(response, function(i, item){

    //             if(item.status == 'B'){
    //                 phone   =   '<a href="#" id="phone" internalkey="'+item.internalkey+'" telnum="'+item.telnum+'" network="'+item.network+'" status="'+item.status+'" class="text-danger"><span class="fa fa-phone"></span></a> ';
    //             }
    //             else{
    //                 phone   =   '<a href="#" internalkey="'+item.internalkey+'" telnum="'+item.telnum+'" network="'+item.network+'" status="'+item.status+'"id="phone" class="text-success"><span class="fa fa-phone"></span></a> ';
    //             }

    //             trTD += '<tr id="tbl_child" internalkey="'+item.internalkey+'" telnum="'+item.telnum+'" network="'+item.network+'" status="'+item.status+'">'+
    //                         '<td>'+item.sentdate+'</td>'+
    //                         '<td>'+item.recvdate+'</td>'+
    //                         '<td>'+item.text_message+'</td>'+
    //                         '<td class="text-center">'+
    //                             phone+
    //                             '<a href="#" id="message" class="text-primary"><span class="fa fa-comments"></span></a> '+
    //                             '<a href="#" id="ticket_num" class="text-danger"><span class="fa fa-ticket"></span></a> '+
    //                         '</td>'+
    //                     '</tr>'
    //         });
    //         $('#tbl_ajax').append(trTD);

    //     },
    //     error: function(e){
    //         console.log('Data Fetching, Error!');
    //         $.alert('Something went wrong!' . e);
    //     }

    // });



    function get_data(object){
        this.internalkey    =   object.parent().parent().attr('internalkey');
        this.telnum     =   object.parent().parent().attr('telnum');
        this.network    =   object.parent().parent().attr('network');
        this.status     =   object.parent().parent().attr('status');
        this.client     =   object.parent().parent().attr('client');
    }

    $('a#phone').click(function(){
        console.log('phone');
        var obj =   new get_data($(this));

        var internalkey  =   obj.internalkey;
        var telnum       =   obj.telnum;
        var network      =   obj.network;
        var status       =   obj.status;
        var client       =   obj.client;

        if(status == 'B'){
            $.alert({
                animation: 'zoom',
                animateFromElement: false,
                draggable: false,
                type: 'red',
                icon: 'fa fa-warning',
                title: 'Alert!',
                content: '<small class="font-weight-bold">Someone is already handling this report.</small>'
            });
        }
        else{
            $.confirm({
                animation: 'zoom',
                animateFromElement: false,
                draggable: false,
                title: '<h6>'+client+'</h6>',
                content: '<div class="col-12 col-sm-12 col-md-12">'+
                            '<table width=100%>'+
                                '<tr>'+
                                    '<td width=35%>'+
                                        '<small class="font-weight-bold">Network </small>'+
                                        '<span class="float-right">:</span>'+
                                    '</td>'+
                                    '<td><small> '+ network +'</small></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td width=35%>'+
                                        '<small class="font-weight-bold">TEL. #</small>'+
                                        '<span class="float-right">:</span>'+
                                    '</td>'+
                                    '<td><small> '+ telnum +'</small></td>'+
                                '</tr>'+
                            '</table>'+
                        '</div>',
                buttons:{
                    close:{
                        btnClass: 'btn-danger'
                    },
                    ok:{
                        btnClass: 'btn-primary',
                        action: function(){
                            window.location.href    =   '/phone/call/'+internalkey;
                        }
                    }
                }
            });
        }

    });

    $('a#message').click(function(){

        var obj =   new get_data($(this));

        var internalkey  =   obj.internalkey;
        var telnum       =   obj.telnum;
        var network      =   obj.network;
        var status       =   obj.status;

        // if(status == 'B'){
        //     $.alert({
        //         animation: 'zoom',
        //         animateFromElement: false,
        //         draggable: false,
        //         type: 'red',
        //         icon: 'fa fa-warning',
        //         title: 'Alert!',
        //         content: 'Someone is already handling this report.'
        //     });
        // }
        // else{
         
            $.confirm({
                animation: 'zoom',
                animateFromElement: false,
                draggable: false,
                title: 'ADDITIONAL MESSAGE',
                content: '<form class="form-horizontal">'+
                        '<div class="col-md-12">'+
                            '<div class="row">'+
                                '<label><small>Please provide a message.</small></label>'+
                            '</div>'+
                            '<div class="row">'+
                                '<textarea class="form-control form-control-sm reason" name="reason" id="reason" style="resize: none;"></textarea>'+
                            '</div>'+
                        '</div>'+
                    '</form>',
                buttons:{
                    close:{
                        btnClass: 'btn-danger'
                    },
                    formSubmit:{
                        text: 'Confirm',
                        btnClass: 'btn-primary',
                        action: function(){
                            var remarks	=	this.$content.find('.reason').val();

                            if(!remarks){
                                $.alert('Message required!');

                                return false;
                            }

                            window.location.href	=	'/phone/message/'+ internalkey +'/'+ remarks;
                        }
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        
        // }
    });

    $('a#ticket_num').click(function(){

        var obj =   new get_data($(this));

        var internalkey  =   obj.internalkey;
        var telnum       =   obj.telnum;
        var network      =   obj.network;
        var status       =   obj.status;

        // if(status == 'B'){
        //     $.alert({
        //         animation: 'zoom',
        //         animateFromElement: false,
        //         draggable: false,
        //         type: 'red',
        //         icon: 'fa fa-warning',
        //         title: 'Alert!',
        //         content: 'Someone is already handling this report.'
        //     });
        // }
        // else{

            $.confirm({
                animation: 'zoom',
                animateFromElement: false,
                draggable: false,
                title: 'TICKET NUMBER',
                content: '<form class="form-horizontal">'+
                        '<div class="col-md-12">'+
                            '<div class="row">'+
                                // '<label>Please provide a reason.</label>'+
                                '<label><small>Input Ticket Number :</small></label>'+
                            '</div>'+
                            '<div class="row">'+
                                '<input type="text" name="tix" id="tix" class="form-control form-control-sm tix" autocomplete="off" />'+
                                // '<textarea class="form-control form-control-sm reason" name="reason" id="reason" style="resize: none;"></textarea>'+
                            '</div>'+
                        '</div>'+
                    '</form>',
                buttons:{
                    close:{
                        btnClass: 'btn-danger'
                    },
                    formSubmit:{
                        text: 'Confirm',
                        btnClass: 'btn-primary',
                        action: function(){
                            var tixnum	=	this.$content.find('.tix').val();

                            if(!tixnum){
                                $.alert('Ticket # required!');

                                return false;
                            }

                            window.location.href	=	'/phone/tix/'+ internalkey +'/'+ tixnum;
                        }
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });

        // }
    });
});
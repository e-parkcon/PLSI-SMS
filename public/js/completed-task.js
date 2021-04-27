function get_data(object){
    this.internalkey    =   object.parent().parent().attr('internalkey');
}

$('a#msglog').click(function(){
    console.log('msglog');

    var obj =   new get_data($(this));

    var internalkey  =   obj.internalkey;
    console.log(internalkey);
    
    $.confirm({
        animation: 'zoom',
        animateFromElement: false,
        // draggable: false,
        title: '<h6>Message Log</h6>',
        content: function(){
            var self    =   this;
            return $.ajax({
                url: '/msglog/'+internalkey,
                dataType: 'json',
                method: 'get'
            }).done(function(response){
                self.setContentAppend('<table class="table table-sm" width=100%>'+
                                            '<thead>'+
                                                '<tr>'+
                                                    '<th width=50% class="text-center">Date & Time</th>'+
                                                    '<th width=50% class="text-center">Remarks</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                        '</table>');
                for(i=0; i < response.length; i++){
                    self.setContentAppend('<table class="table table-sm" width=100%>'+
                                            '<tr>'+
                                                '<td width=50% class="text-center">'+response[i].txndate+", "+response[i].txntime+'</td>'+
                                                '<td width=50% class="text-center">'+ response[i].remarks +'</td>'+
                                            '</tr>'+
                                          '</table>'
                                          );
                  }
            });
        },
        buttons:{
            close:{
                btnClass: 'btn-danger',
                action: function(){

                }
            }
        }
    });
});
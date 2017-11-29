
function fnSubscribe(userid,tagId,tagName,item){

$.ajax({
              url:'subscribe?userid='+userid+'&tagId='+tagId,
              type:'GET',
              dataType:'json',
              success:function(data){
                    if(data == 1)
                    {
                          $(item).text('+ ');
                          alert('Tag ' + tagName + ' unsubscribed');
                    }
                    else
                    {
                          $(item).text('- ');
                          alert('Tag ' + tagName + ' subscribed');
                    }
              
              }
        });
}

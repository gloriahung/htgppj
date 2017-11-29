
function fnSubscribe(userid,tagId,tagName,item){

$.ajax({
              url:'/web/site/subscribe?userid='+userid+'&tagId='+tagId,
              type:'GET',
              dataType:'json',
              success:function(data){
                    if(data == 1)
                    {
                          $(".tag"+tagId).text('+ ');
                          alert('Tag ' + tagName + ' unsubscribed');
                    }
                    else
                    {
                          $(".tag"+tagId).text('- ');
                          alert('Tag ' + tagName + ' subscribed');
                    }
              
              }
        });
}

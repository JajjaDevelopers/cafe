
setInterval(localTime,1000)
function localTime()
{
  const time=new Date();
  var currentTime=time.toLocaleTimeString();
  const element=document.getElementById("current_time")
  element.innerHTML=currentTime;
}

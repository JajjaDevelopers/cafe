document.getElementById("print").addEventListener("click",()=>{
  const idsArray=['footer','divheader','sidebar','btnback','print'];
  idsArray.forEach(id => {
    document.getElementById(id).style.display="none";
  });
  window.print();
  idsArray.forEach(id => {
    document.getElementById(id).style.display="block";
  });
})
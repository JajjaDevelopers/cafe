import graph1 from "./module1.js";
import graph2 from "./module2.js";
import graded from "./module3.js";
const btnOpen=document.getElementById("openbtn");
const btnClose=document.getElementById("closebtn");
const elSideBar=document.getElementById("sidebar");
const elMain=document.getElementById("main");
const elFooter=document.getElementById("footer");
btnClose.addEventListener("click",()=>{
  // alert("God is graciously Good");
  elSideBar.style.display="none";
  elMain.style.marginLeft="0";
  elFooter.style.marginLeft="0";
  btnOpen.style.display="block";
  btnClose.style.display="none";
  graph1();
  graph2();
  graded();
})

btnOpen.addEventListener("click",()=>{
  // alert("God is graciously Good");
  elSideBar.style.display="block";
  elMain.style.marginLeft="300px";
  elFooter.style.marginLeft="300px";
  btnOpen.style.display="none";
  btnClose.style.display="Block";
  graph1();
  graph2();
  graded();
})


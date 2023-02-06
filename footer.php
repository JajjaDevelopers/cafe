<!-- <footer class="bg-dark pt-5 pb-4 text-white mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3  col-sm-12">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Our Vision</h5>
        <p>
           Coffee farmers profitably own their coffee along the coffee value chain for 
          sustainable livelihoods, consumer satisfaction and societal transformation
          To provide scalable technological solutions in form of web based applications
        </p>
      </div>
      
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3  col-sm-12">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">useful links</h5>
        <p><a href="#" class="text white" style="text-decoration:none;">Products</a></p>
        <p><a href="#" class="text white" style="text-decoration:none;">About Us</a></p>
        <p><a href="#" class="text white" style="text-decoration:none;">Mission</a></p>
      </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3  col-sm-12">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact us</h5>
        <p><i class="fas fa-home mr-3"></i><a href="#" class="text white ms-3" style="text-decoration:none;" >Plot 385 
           2nd Floor, Elgon House</a></p>
        <p><i class="fas fa-envelope mr-3"></i><a href="mailto:mechtechelectric@gmail.com" class="text white ms-3" style="text-decoration:none;">Jajjadev.tech.com</a></p>
        <p><i class="fas fa-phone mr-3"></i><a href="tel:+256750869022" class="text white ms-3" style="text-decoration:none;">+256 750 869 022</a></p>
    </div>
    <hr class="mb-4">
    <div class="row align-items-center">
      <div class="col-12 text-center">
        <p>Copyright &#169;<script>document.write(new Date().getFullYear())</script>
        All rights reserved by:<a href="mailto:jajjadev@gmail.com" style="text-decoration:none;">
        <strong class="text-warning">jajjadev.tech</strong></a></p>
      </div>
    </div>
  </div>
</footer> -->
<script src=".\ASSETS\bootsrap\js\bootstrap.bundle.min.js"></script>
  <!-- <script src=".\ASSETS\jquery-3.6.0.js"></script>
  <script src=".\ASSETS\owl.js">
  </script>
  <script src=".\ASSETS\owlcarousel\dist\owl.carousel.min.js"></script>
  <script src=".\ASSETS\jquery.js"></script>
  <script src=".\ASSETS\jquery-ui/jquery-ui.js"></script> -->
  <script>
    // alert("God is good");
    var list=document.querySelectorAll("#header");
    console.log(list);
    //  const option = document.getElementById("select");
    // const checkedOption = document.querySelectorAll(".coffee");
    // console.log(checkedOption);
    let choice;
    list.forEach(checked => {
      checked.addEventListener("click", (event) => {
      choice = event.target.className;
      if (choice === "navlist") {
        alert("We are going home...!");
      } 
  })
})
  </script>
</body>
</html>
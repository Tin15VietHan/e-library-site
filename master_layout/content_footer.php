<!-- Footer start -->
<section class="map mt-2">
  <div class="container-fluids p-0">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4366.148442070775!2d105.67735815007774!3d18.7
        06083332593316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139ce1da2d94441%3A0x21f3b0f10d92f97b!2zVHLGsOG7nW
        5nIENhbyDEkeG6s25nIEvhu7kgVGh14bqtdCBDw7RuZyBOZ2hp4buHcCBWaeG7h3QgTmFtIC0gSMOgbiBRdeG7kWM!5e0!3m2!1svi!2s!4v1709721577723!5m2!1svi!2s" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>
</section><!-- End Map Section -->
<footer>
  <div class="container"style="color: #fff;">
    <div class="copyright">
     Bản quyền thuộc Trường Cao Đẳng Kỹ Thuật Công Nghiệp Việt Nam - Hàn Quốc
    <br>
     Địa chỉ: Đường Hồ Tông Thốc  - TP.Vinh - Tỉnh Nghệ An
     <br>
     Số điện thoại: 02383.3511454 *** Fax: 038.852194
     <br>
     Website: www.vkc.edu.vn hoặc www.cdvhnghean.edu.vn
    </div>
  </div>
</footer>


<style>
  footer{
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    /* background-color: #f8f9fa; */
    /* padding: 20px 0; */
    text-align: center;
  }
  .map {
    padding: 0;
    margin-bottom: -12px;
  }
  .map iframe {
    width: 100%;
    height: 300px;
  }

  .copyright {
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px;
  }

  /* CSS for the back-to-top button */
  .back-to-top {
    position: fixed;
    right: 15px;
  bottom: 15px;
    z-index: 99999;
    display: none;
    background: #68A4C4;
  width: 40px;
  height: 40px;
    color: #fff;
    padding: 10px;
    border-radius: 4px;
    text-align: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  }

  .back-to-top i {
    font-size: 20px;
  color: #fff;
  line-height: 0px;
  }
</style>

<script>
  // JavaScript to show/hide the back-to-top button
  window.addEventListener('scroll', function() {
    var backToTopButton = document.querySelector('.back-to-top');
    if (window.scrollY > 100) {
      backToTopButton.style.display = 'block';
    } else {
      backToTopButton.style.display = 'none';
    }
  });

  // Smooth scroll to top when the button is clicked
  document.querySelector('.back-to-top').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
</script>
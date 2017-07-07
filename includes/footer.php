<section id="contact" class="contact">
  <div class="container">
  <div class="footer">
  <div class="footer__column col-sm-12 col-md-4">
    <h2>Contact us</h2>
    <p> <?php echo $content; ?></p>
    <ul class="links">
      <li class="footer__links"><?php echo $name; ?></li>
      <li class="footer__links"><a href="mailto:"<?php echo $email; ?>"><?php echo $email; ?></a></li>
      <li class="footer__links"><?php echo $address; ?></li>
      <li class="footer__links"><?php echo $web; ?></li>
    </ul>
  </div>
  <div class="footer__column col-sm-12 col-md-4">
    <h2>Subscribe to our newsletter</h2>
      <p>Write down you email address below and get by-monthly newsletter and brands:</p>
      <input class="footer__input" type="text" name="name" placeholder="subscribe email">
      <a class="btn slider__cta-btn"href="#">Subscibe<i class="slider__cta-btn-ar fa fa-caret-right"></i></a>
  </div>
  <div class="footer__column col-sm-12 col-md-4">
    <h2>write donwn you message</h2>
    <input class="footer__input" type="text" name="name" placeholder="Your Name">
    <input class="footer__input" type="text" name="name" placeholder="your Email">
    <textarea class="footer__input" type="text" name="name" placeholder="Your message"></textarea>
    <a class="btn slider__cta-btn"href="#">Send<i class="fa fa-caret-right"></i></a>
  </div>
  </div>
  <div class="footer__copy">
    <div class="col-md-4 col-md-offset-4">
      <hr class="footer__hr" />
      <a class="footer__copy-btn "href="#header">back to top<i class="fa fa-caret-up"></i></a>
      <p><?php echo $copy . " " . $name . " " . Date('d.m.Y') ?></p>
    </div>
  </div>
  </div>
</section>
<script src="assets/scripts/main.js"></script>
</script>
</body>
</html>

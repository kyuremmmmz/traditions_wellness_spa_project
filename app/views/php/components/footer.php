<?php
class Footer
{
    public static function handle()
    {
    ?>
        <footer class="footer">
            <div class="footer__container">
                <div class="footer__logo">
                    <img src="" alt="Logo" class="footer__logo-img">
                </div>
                <div class="footer__links">
                    <a href="#" class="footer__link">About Us</a>
                    <a href="#" class="footer__link">Contact Us</a>
                    <a href="#" class="footer__link">Privacy Policy</a>
                    <a href="#" class="footer__link">Terms of Service</a>
                </div>
                <div class="footer__socials">
                    <a href="#" class="footer__social-link">
                        <img src="images/facebook.png" alt="Facebook" class="footer__social-img">
                    </a>
                    <a href="#" class="footer__social-link">
                        <img src="images/twitter.png" alt="Twitter" class="footer__social-img">
                    </a>
                    <a href="#" class="footer__social-link">
                        <img src="images/instagram.png" alt="Instagram" class="footer__social-img">
                    </a>
                </div>
            </div>
    <?php
    }
}
?>
<?php
/*
    Template Name: Contact Me Page
*/
    get_header();
?>
            <div class="row page">
                <div class="col-12" data-post-image="<?php bloginfo('template_url'); ?>/img/contact-me.jpg">
                    <h2 class="contact-me--title">
                        Find me on
                    </h2>

                    <div class="social-icons-wrap">
                        <a href="https://www.facebook.com/profile.php?id=100001624546227" class="social-icons-wrap--icon-link facebook" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://github.com/spacedefender48/" class="social-icons-wrap--icon-link github" target="_blank">
                            <i class="fab fa-github-alt"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/plamen-kolarov-62bbb7141/" class="social-icons-wrap--icon-link linkedin" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://plus.google.com/113944910930564683462" class="social-icons-wrap--icon-link google" target="_blank">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </div>

                    <div class="contact-me--desc">
                        <p>
                            or
                        </p>
                        
                        <p>
                            <i class="fas fa-arrow-down"></i>
                        </p>
                    </div>
                </div>
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>

    <section id="contact-me-content">
        <p class="contact-me--message">
            Interested in collaborating with me? Write me a short message, I will contact you!
        </p>

        <form action="#" method="POST" id="contact-me-form">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" name="f_name" placeholder="Your Name (Required)" class="input-text" id="name-field" required>

                        <p class="name-error-text">Name is required</p>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <input type="email" name="f_email" placeholder="Your E-mail (Required)" class="input-text" id="email-field" required>

                        <p class="email-error-text">*Email is required</p>
                    </div>

                    <div class="col-12">
                        <textarea class="input-area" name="f_message" id="message-field" placeholder="Message (Optional)"></textarea>
                    </div>

                    <div class="col-12 submit-wrap">
                        <input type="submit" name="f_submit" value="Send" class="submit-btn">
                    </div>
                </div>
            </div>


        </form>
    </section>

    <div id="dialog" class="my-dialog" title="Sent email">
        I'm a dialog
    </div>

<?php
    get_footer();
?>
<?php
/*
    Template Name: About Me Page
*/
    get_header();
?>
            <div class="row page">
                <div class="col-12" data-post-image="<?php bloginfo('template_url'); ?>/img/about-me.jpg">
                    <h2 class="about-me--title">Hello My name is <br><span>Plamen<br>Kolarov</span></h2>
                </div>
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>

    <section id="about-me-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="about-me--desc-wrap">
                        <div class="about-me--desc-text">
                            <p>
                                I am Plamen Kolarov, a front-end developer from Varna, Bulgaria. As a front-end developer, I create modern websites that are of high quality and at the same time responsive for many types of devices. I can create a website from scratch or with WordPress as content management system.
                            </p>
                            
                            <p>
                                My passion for programming started during my time in university. In 2015 I graduated from the University of Sofia 'St. Kliment Ohridski' with a Bachelor's degree in Software Engineering. Since then, I am always keen to learn the latest technologies in web development that will make both the development of the site and the final user experience easier.
                            </p>

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
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>


    
<?php
    get_footer();

?>
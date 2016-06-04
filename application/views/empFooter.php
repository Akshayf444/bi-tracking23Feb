<div class="footer-wrapper">
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="footer-top-block">
                            <h2><i class="profession profession-logo"></i> Pharma Talent</h2>
                            <p>
                                Fusce congue, risus et pulvinar cursus, orci arcu tristique lectus, sit amet placerat justo ipsum eu diam. Pellentesque tortor urna, pellentesque nec molestie eget, volutpat in arcu. Maecenas a lectus mollis.
                            </p>
                            <ul class="social-links">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div><!-- /.footer-top-block -->
                    </div><!-- /.col-* -->

                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="footer-top-block">
                            <h2>Helpful Links</h2>

                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">License</a></li>
                                <li><a href="#">Affiliate</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div><!-- /.footer-top-block -->
                    </div><!-- /.col-* -->

                    <div class="col-sm-3">
                        <div class="footer-top-block">
<!--                            <h2>Trending Jobs</h2>-->

                            <ul>
                                <?php
                                $sql = "SELECT DISTINCT(sm.skill_name)  as skill,count(j.job_id) as jobcount FROM skill_master sm INNER JOIN jobs j ON  j.keyword LIKE CONCAT('%', sm.skill_name, '%')   where sm.skill_name != '' GROUP BY sm.skill_name ORDER BY jobcount DESC LIMIT 10";
                                $query = $this->db->query($sql);
                                $trendingJob = $query->result();
                                if (!empty($trendingJob)) {
                                    foreach ($trendingJob as $value) {
                                        //echo '<li><a href="' . site_url('Job/search') . '?location=&skill=' . $value->skill . '">' . $value->skill . ' Jobs</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div><!-- /.footer-top-left -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-top -->

        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-left">
                    &copy; <a href="#">Pharma Talent</a>, 2016 All rights reserved.
                </div><!-- /.footer-bottom-left -->

                <div class="footer-bottom-right">
                    Powered by <a href="#">KBC</a>.
                </div><!-- /.footer-bottom-right -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
    </div><!-- /.footer -->
    <!-- Start of SimpleHitCounter Code -->
    <div align="center"><a href="http://www.finediapercakes.com/#!boy-diaper-cakes/c2424" target="_blank"><img src="http://simplehitcounter.com/hit.php?uid=2095651&f=16777215&b=0" border="0" height="18" width="83" alt=""></a><br><a href="http://www.finediapercakes.com/#!boy-diaper-cakes/c2424" target="_blank" style="text-decoration:none;"></a></div>
    <!-- End of SimpleHitCounter Code -->

</div>
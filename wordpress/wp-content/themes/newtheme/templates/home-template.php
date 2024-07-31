<?php
/**
 * Template Name: Home Page Template
 */
get_header(); ?>
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <!-- Page content would go here -->
            <div class="row">
                <div class="col-12">
                    <div class="contentArea">
                        <h1><span class="position-relative">BLOCKCHAIN USE CASES</span></h1>
                        <h4>Click on the below use-cases for blockchain to see more details.</h4>
                        <div class="usecasesOuter">
                            <div class="usecaseList orange">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/tokenization_icon.svg">
                                <span>Tokenization of<br/> Assets</span>
                            </div>
                            <div class="usecaseList blue">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/producttrace_icon.svg">
                                <span>Product<br/> Traceability</span>
                            </div>
                            <div class="usecaseList orange">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/cryptoexch_icon.svg">
                                <span>Crypto<br/> Exchange</span>
                            </div>
                            <div class="usecaseList blue">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/ico_icon.svg">
                                <span>ICO, IEO &<br/> STO</span>
                            </div>
                            <div class="usecaseList orange">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/smartcontract_icon.svg">
                                <span>Smart Contract<br/> Development</span>
                            </div>
                        </div>
                    </div>
                    <div class="contentArea industryVerticals">
                        <h1><span class="position-relative">INDUSTRY VERTICALS</span></h1>
                        <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                        <div class="industryVerOuter display table-responsive">
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/finance_icon.svg"></label>
                                <span>Finance</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/healthcare_icon.svg"></label>
                                <span>Healthcare</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/education_icon.svg"></label>
                                <span>Education</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/govt_icon.svg"></label>
                                <span>Government</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/media_icon.svg"></label>
                                <span>Media</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/realestate_icon.svg"></label>
                                <span>RealEstate</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/supply_icon.svg"></label>
                                <span>Supply Chain</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/finance_icon.svg"></label>
                                <span>Finance</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/healthcare_icon.svg"></label>
                                <span>Healthcare</span>
                            </div>
                            <div class="industryVerList">
                                <label><img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/education_icon.svg"></label>
                                <span>Education</span>
                            </div>
                        </div>
                    </div>
                    <div class="contentArea whoweare">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                            <div class="col col-lg-3">
                                <img src="<?php echo get_template_directory_uri() . '/html/'; ?>images/whoweare.png"
                                     class="w-100">
                            </div>
                            <div class="col col-lg-9">
                                <h6>WHO WE ARE</h6>
                                <label>BLOCKCHAIN TECHNOLOGY AND CONSULTATION</label>
                                <p>
                                    Since 2019, V2Hash has planned, designed, built and implemented products and
                                    services based
                                    on blockchain. Our portfolio includes a range of blockchain-based products and
                                    successfully
                                    released projects.<br/><br/> Our team members have been developing and utilizing
                                    blockchain
                                    technology for over 10 years.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #content -->
    </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
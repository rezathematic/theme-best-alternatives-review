<footer>
    <div class="container">
        <div class="grid-footer">
            <div>
                <h4>General</h4>
                <p><a href="<?php echo home_url(); ?>">Home</a></p>
            </div>
            <div>
                <h4>Categories</h4>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    echo '<p><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></p>';
                }
                ?>
            </div>
            <div>
                <h4>Legal</h4>
                <p><a href="/legal/affiliate-disclosure/">Affiliate Disclosure</a></p>
                <p><a href="/legal/legal-disclaimer/">Legal Disclaimer</a></p>
                <p><a href="/legal/privacy-policy/">Privacy Policy</a></p>
                <p><a href="/legal/terms-conditions/">Terms and conditions</a></p>
            </div>
        </div>
        <div class="logo-footer">
            <p><a href="<?php echo home_url(); ?>">Best Alternatives Review</a></p>
            <p>Copyright © <?php echo date('Y'); ?> Best Alternatives Review. All rights reserved.</p>
            <hr>
            <p>Best Alternatives Review is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for sites to earn advertising fees by advertising and linking to Amazon.com</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
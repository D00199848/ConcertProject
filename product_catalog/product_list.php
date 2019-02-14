<?php include '../view/header.php'; ?>
<main>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <?php include '../view/category_nav.php'; ?>        
    </aside>
    <section>
        <h1><?php echo $band_name; ?></h1>
        <ul class="nav">
            <!-- display links for products in selected category -->
            <?php foreach ($gigs as $gig) : ?>
            <li>
                <a href="?action=view_product&amp;gig_id=<?php 
                          echo $gig['gigID']; ?>">
                    <?php echo $gig['gigName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
<?php include '../view/footer.php'; ?>
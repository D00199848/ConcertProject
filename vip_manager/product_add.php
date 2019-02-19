<?php include '../view/header.php'; ?>
<main>
    <h1>Add Gig</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_product">

        <label>Band:</label>
        <select name="band_id">
        <?php foreach ( $bands as $band ) : ?>
            <option value="<?php echo $band['bandID']; ?>">
                <?php echo $band['bandName']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        <label>VIP ID:</label>
        <input type="input" name="vipID">
        <br>

        <label>Name:</label>
        <input type="input" name="name">
        <br>

        <label>VIP Code:</label>
        <input type="input" name="vipCode">
        <br>

        <label>Price:</label>
        <input type="input" name="price">
        <br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add VIP">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_vip">View VIP Tickets</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>
<?php include '../view/header.php'; ?>
<main>
    <h1>Edit VIP Gig</h1>
    <form action="index.php" method="post" id="add_product_form">

        <input type="hidden" name="action" value="update_gig">

        <input type="hidden" name="product_id"
               value="<?php echo $vip['gigID']; ?>">

        <label>VIP ID:</label>
        <input type="vip_id" name="vip_id"
               value="<?php echo $vip['vipID']; ?>">
        <br>

        <label>VIP Code:</label>
        <input type="input" name="vip_code"
               value="<?php echo $vip['vipCode']; ?>">
        <br>

        <label>Name:</label>
        <input type="input" name="name"
               value="<?php echo $vip['gigName']; ?>">
        <br>

        <label>Price:</label>
        <input type="input" name="price"
               value="<?php echo $vip['listPrice']; ?>">
        <br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Save Changes">
        <br>
    </form>
    <p><a href="product_manager/index.php?action=list_bands">View Band List</a></p>

</main>
<?php include '../view/footer.php'; ?>
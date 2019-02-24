<?php include '../view/header.php'; ?>
<main>

    <h1>VIP List</h1>

    <section>
        <!-- display a table of products -->
        <table>
            <tr>
                <th>VIP ID</th>
                <th>VIP Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($vips as $vip) : ?>
            <tr>
                <td><?php echo $vip['vipCode']; ?></td>
                <td><?php echo $vip['vipName']; ?></td>
                <td class="right"><?php echo $vip['listPrice']; ?></td>
                
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="show_edit_form">
                    <input type="hidden" name="vip_id"
                           value="<?php echo $vip['vipID']; ?>">
                    <input type="hidden" name="band_id"
                           value="<?php echo $vip['bandID']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_gig">
                    <input type="hidden" name="gig_id"
                           value="<?php echo $vip['vipID']; ?>">
                    <input type="hidden" name="band_id"
                           value="<?php echo $vip['bandID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
<p><a href="../product_manager/index.php">Back to Gigs</a></p>
</main>
<?php include '../view/footer.php'; ?>
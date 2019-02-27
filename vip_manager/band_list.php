<?php include '../view/header.php'; ?>
<main>

    <h1>Band List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($bands as $band) : ?>
        <tr>
            <td><?php echo $band['bandName']; ?></td>
            <td>
                <form id="delete_vip_form"
                      action="index.php" method="post">
                    <input type="hidden" name="action" value="delete_band">
                    <input type="hidden" name="band_id"
                           value="<?php echo $band['bandID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br />

    <h2>Add Band</h2>
    <form id="add_band_form"
          action="index2.php" method="post">
        <input type="hidden" name="action" value="add_band">

        <label>Name:</label>
        <input type="input" name="name">
        <input type="submit" value="Add">
    </form>

    <p><a href="index2.php?action=list_vips">List VIPS</a></p>

</main>
<?php include '../view/footer.php'; ?>
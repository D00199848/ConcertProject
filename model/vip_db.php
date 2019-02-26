<?php
function get_vips() {
    global $db;
    $query = 'SELECT * FROM vip
              ORDER BY vipID';
    $statement = $db->prepare($query);
    $statement->execute();
    $vips = $statement->fetchAll();
    $statement->closeCursor();
    return $vips;
}

function get_vips_by_vip($band_id) {
    global $db;
    //SELECT * FROM vip WHERE vips.vipID = :vip_id
             // ORDER BY vipID
    $query = 'SELECT * FROM vip';
    $statement = $db->prepare($query);
    //$statement->bindValue(":band_id", $band_id, PDO::PARAM_INT);
    $statement->execute();
    $vips = $statement->fetchAll();
    $statement->closeCursor();
    return $vips;
}

function get_vip($vip_id) {
    global $db;
    $query = 'SELECT * FROM vip
              WHERE vipID = :vip_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":vip_id", $vip_id);
    $statement->execute();
    $vip = $statement->fetch();
    $statement->closeCursor();
    return $vip;
}

function delete_vip($vip_id) {
    global $db;
    $query = 'DELETE FROM vip
              WHERE vipID = :vip_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vip_id', $vip_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_vip($vip_id, $band_ID, $vip_code, $band_name, $price) {
    global $db;
    $query = 'INSERT INTO vip
                 (vipID, bandID, vipCode, bandName, Price)
              VALUES
                 (:vip_id, :band_id, :vip_code, :band_name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':vip_id', $vip_id);
    $statement->bindValue(':band_id', $band_ID);
    $statement->bindValue(':vip_code', $vip_code);
    $statement->bindValue(':band_name', $band_name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}

function update_vip($vip_id, $band_ID, $vip_code, $band_name, $price) {
    global $db;
    $query = 'UPDATE vip
              SET vipID = :vip_id
                  bandID = :band_id,
                  vipCode = :vip_code,
                  bandName = :band_name,
                  listPrice = :price,
               WHERE vipID = :vip_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vip_id', $vip_id);
    $statement->bindValue(':band_id', $band_ID);
    $statement->bindValue(':vip_code', $vip_code);
    $statement->bindValue(':band_name', $band_name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}
?>
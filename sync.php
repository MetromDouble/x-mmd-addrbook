<?php

require( dirname( __FILE__ ) . '/db-config.php' );

$table_fields = array("id_user", "name", "lastname", "position", "company", "phone", "email", "img_url");
$table_name = "contacts";

function create_table($table_name, $table_fields, $db)
{
  return mysqli_query($db, "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . $table_name . " (" .
                            $table_fields[0] . " int(5) AUTO_INCREMENT," .
                            $table_fields[1] . " varchar(30) NOT NULL," .
                            $table_fields[2] . " varchar(30) NOT NULL," .
                            $table_fields[3] . " varchar(30) NULL," .
                            $table_fields[4] . " varchar(30) NULL," .
                            $table_fields[5] . " varchar(15) NOT NULL," .
                            $table_fields[6] . " varchar(70) NOT NULL," .
                            $table_fields[7] . " varchar(100) NULL, PRIMARY KEY (" . $table_fields[0] . "));"
  );
};

function create_contact_db($table_name, $table_fields, $table_entries, $db)
{
  return mysqli_query($db, "INSERT INTO " . DB_PREFIX . $table_name . " (" .
                            $table_fields[1] . "," .
                            $table_fields[2] . "," .
                            $table_fields[3] . "," .
                            $table_fields[4] . "," .
                            $table_fields[5] . "," .
                            $table_fields[6] . "," .
                            $table_fields[7] . ") VALUES ('" .

                            $table_entries[$table_fields[1]] . "','" .
                            $table_entries[$table_fields[2]] . "','" .
                            $table_entries[$table_fields[3]] . "','" .
                            $table_entries[$table_fields[4]] . "','" .
                            $table_entries[$table_fields[5]] . "','" .
                            $table_entries[$table_fields[6]] . "','" .
                            $table_entries[$table_fields[7]] . "');"

  );
};

function get_contacts_db($table_name, $db) {
  return mysqli_query($db, "SELECT * FROM " . DB_PREFIX . $table_name);
};

function delete_contact_db($table_name, $entry, $id, $db) {
  return mysqli_query($db, "DELETE FROM `" . DB_PREFIX . $table_name . "` WHERE " . $entry . " = '" . $id . "'");
};


$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
  die("Не удалось соединиться с базой данных");

$input = json_decode(trim(file_get_contents('php://input')), true);
$randomContacts = json_decode(trim(file_get_contents('people.json')), true);

create_table($table_name, $table_fields, $db);

if ($input) {
  if ($input["delete"]) {
    delete_contact_db($table_name, $table_fields[0], $input["id_user"], $db);
  } else {
    create_contact_db($table_name, $table_fields, $input, $db);
  };
};

$q = get_contacts_db($table_name, $db);

while($row = mysqli_fetch_assoc($q)) {
  $arr[] = $row;
};

echo json_encode($arr);

mysqli_close($db);

/*
foreach ($randomContacts as $value) {
  create_contact_db($table_name, $table_fields, $value, $db);
};*/
/*echo '<meta charset="UTF-8">';
foreach ($input as $key => $value) {
  foreach ($value as $k => $v) {
   echo "$k = $v <br>";
  }
  echo "$key = $value <br>";
}*/
//echo create_table($table_name, $table_fields, $db);
/*
$qing = get_contacts_db($table_name, $db);
while ($row = mysqli_fetch_assoc($qing)) {
        echo $row["id_user"];
        echo $row["fname"];
        echo $row["lname"] . "<br>";
}*/

/*for ($i=0; $i < 10; $i++) {
  echo create_contact_db($table_name, $table_fields, $table_entries, $db);
}*/

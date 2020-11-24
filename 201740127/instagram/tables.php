<?php
include "theme.conf.php";
include "../dbinfo.php";

include "desc.php";

echo "테이블 관리 화면 입니다.";
echo "<a href='/'>목록이동</a>";

$db0 = new mysqli(
    $dbinfo['master']['dbhost'],
    $dbinfo['master']['dbuser'],
    $dbinfo['master']['dbpass'],
    $dbinfo['master']['dbschema'],
);

if(isset($_GET['colum'])) {
    $query = "ALTER TABLE `phpdaelim4`.`insta2` 
    DROP COLUMN `".$_GET['colum']."`;";
    echo $query;
    $result = mysqli_query($db0, $query);
} else
if (isset($_GET['mode']) && $_GET['mode'] == "new")   {
    echo "컬럼을 삽입합니다.";              
    echo "삽입=".$_POST['fieldname'];
    
    $query = "CREATE TABLE `phpdaelim4`.`".$_POST['tablename']."` (
        `id` INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (`id`));";

    $result = mysqli_query($db0, $query);
}


if ($db0) {
    $tablename = "insta2";

    $query = "show tables";
    
    $result = mysqli_query($db0, $query);


    if ($result) {

        $rows = []; // 배열초기화
        echo "<table>";
        while($row = mysqli_fetch_object($result)) {

            echo "<tr>";
            foreach($row as $key => $value) {
                // echo "<td>"."<a href='setting.php?tablename=$value."</td>";
            }

            $fieldname = "Tables_in_phpdaelim4";
            echo "<td>"."<a href='?mode=delete&tablename=".$row->fieldname."' >삭제</a>"."</td";
 
            echo "</tr>";
        }
        echo "</table>";

        echo "<br>";
        echo "<form action=\"?mode=new\" method='post'>";
        echo "<input type=text name='tablename'>";
        echo "<input type='submit' value='테이블추가'>";
        echo "</form>";
   
    } else {
        //echo __LINE__.": SQL 실행 오류<br>";
    }
}

<?php
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mentor";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn , "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   
    // 在這邊關掉自動 commit
    $conn->autocommit(false);
    // 開始 transaction  ACID 原則
    $conn->begin_transaction();
    //product1
    $stmt= $conn->prepare("SELECT amount FROM product WHERE id=1 for update");
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        if ($row['amount']>0) {
            $stmt = $conn->prepare("UPDATE product SET amount = amount -1 WHERE id=1");
            if ($stmt->execute()) {
                echo "product1購買成功, 剩餘數量".$row['amount']-1."<br>";
            } 
        } else {
            echo "product1購買失敗<br>";
        }
    }
    //product2
    $stmt= $conn->prepare("SELECT amount FROM product WHERE id=2 for update");
    $stmt->execute();
    $result1=$stmt->get_result();
    if($result1->num_rows > 0 ) {
        $row1 = $result1->fetch_assoc();
        if ($row1['amount']>0) {
            $stmt = $conn->prepare("UPDATE product SET amount = amount -1 WHERE id=2");
            if ($stmt->execute()) {
                echo "product2購買成功<br>";
            } 
        } else {
            echo "product2購買失敗<br>";
        }
    }
    //product3
    $stmt= $conn->prepare("SELECT amount FROM product WHERE id=3 for update");
    $stmt->execute();
    $result2=$stmt->get_result();
    if($result2->num_rows > 0 ) {
        $row2 = $result2->fetch_assoc();
        if ($row2['amount']>0) {
            $stmt = $conn->prepare("UPDATE product SET amount = amount -1 WHERE id=3");
            if ($stmt->execute()) {
                echo "product3購買成功<br>";
            } 
        } else {
            echo "product3購買失敗<br>";
        }
    }
    //product4
    $stmt= $conn->prepare("SELECT amount FROM product WHERE id=4 for update");
    $stmt->execute();
    $result3=$stmt->get_result();
    if($result3->num_rows > 0 ) {
        $row3 = $result3->fetch_assoc();
        if ($row3['amount']>0) {
            $stmt = $conn->prepare("UPDATE product SET amount = amount -1 WHERE id=4");
            if ($stmt->execute()) {
                echo "product4購買成功<br>";
            } 
        } else {
            echo "product4購買失敗<br>";
        }
    }
    //product5
    $stmt= $conn->prepare("SELECT amount FROM product WHERE id=5 for update");
    $stmt->execute();
    $result4=$stmt->get_result();
    if($result4->num_rows > 0 ) {
        $row4 = $result4->fetch_assoc();
        if ($row4['amount']>0) {
            $stmt = $conn->prepare("UPDATE product SET amount = amount -1 WHERE id=5");
            if ($stmt->execute()) {
                echo "product5購買成功<br>";
            } 
        } else {
            echo "product5購買失敗<br>";
        }
    }
    // 手動commit
    $conn->commit();
    $conn->close();
?>
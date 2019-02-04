<?php
//function to check if item exist
    function checkItem($select,$table,$value){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $table WHERE $select=?");
        $stmt->execute(array($value));
        $count=$stmt->rowCount();
        return $count;
    }

//function to count items on tal
    function countItem($column,$table){
        global $con;
        $stmt=$con->prepare("SELECT COUNT($column)FROM($table)");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
//    function to count exceptions
    function itemException($select,$table,$exception){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $table WHERE $select=?");
        $stmt->execute(array($exception));
        $count=$stmt->rowCount();
        return $count;
    }
// function to delete item
    function deleteItem($select,$table,$delete){
        global $con;
        $stmt=$con->prepare("DELETE FROM $table WHERE $select=?");
        $stmt->execute(array($delete));
        $count=$stmt->rowCount();
        return $count;
    }
//search for item in table using keyword
    function searchItem($select,$table,$search){
        global $con;
        $stmt=$con->prepare("SELECT * FROM $table WHERE $select LIKE '%$search%'");
        $stmt->execute();
        return $stmt;
    }
//return all items on table
    function returnAll($table){
        global $con;
        $stmt=$con->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt;
    }
//function return all file contains in string
    function return_file_contains($file_path){
        return file_get_contents($file_path, FILE_USE_INCLUDE_PATH);
    }
    
?>
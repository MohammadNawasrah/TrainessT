<?php
include "databaseConnection.php";
class Crud
{
    private $db;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=trainesst";
        $username = "root";
        $password = "";
        $db = new Database($dsn, $username, $password);
        $this->db = $db;
    }

    public function createRecord($table, $data)
    {

        $connection = $this->db->getConnection();
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $connection->prepare($sql);
        $stmt->execute($data);

        return $connection->lastInsertId();
    }


    public function read($table, $id)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data by ID
        $sql = "SELECT * FROM $table WHERE id = :id";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the selected data as an associative array
    }
    public function update($table, $columnName, $columnValue, $data)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to update data by a specified column
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = :$key";
        }
        $sql = "UPDATE $table SET " . implode(', ', $updates) . " WHERE $columnName = :columnValue";

        // Add the parameters to the data array
        $data['columnValue'] = $columnValue;

        // Prepare the query
        $stmt = $connection->prepare($sql);

        // Bind parameters
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        // Execute the query
        $stmt->execute();

        return $stmt->rowCount(); // Return the number of affected rows
    }



    public function userNameExists($table, $username)
    {
        $connection = $this->db->getConnection();

        $sql = "SELECT COUNT(*) FROM $table WHERE userName = :userName";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':userName', $username, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->fetchColumn(); // Get the count of matching records

        return $count > 0; // Return true if the username already exists, false otherwise
    }
    public function delete($table, $columnName, $columnValue)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to delete data by a specified column
        $sql = "DELETE FROM $table WHERE $columnName = :columnValue";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':columnValue', $columnValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount(); // Return the number of affected rows
    }

    public function getAllDataByCondition($table, $conditionColumn, $conditionValue)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data based on a condition
        $sql = "SELECT * FROM $table WHERE $conditionColumn = :conditionValue";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':conditionValue', $conditionValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all selected data as an array of associative arrays
    }
    public function getAllData($table)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data based on a condition
        $sql = "SELECT * FROM $table";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all selected data as an array of associative arrays
    }
    public function getDataByColumn($table, $columnName, $columnValue)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data by a specified column
        $sql = "SELECT * FROM $table WHERE $columnName = :columnValue";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':columnValue', $columnValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the selected data as an associative array
    }
    public function getDatabyJoin($fromTable, $joinTables)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data based on a condition
        $sql = "SELECT * FROM $fromTable";

        // Add JOIN clauses for each table in the $joinTables array
        foreach ($joinTables as $joinTable) {
            // Assuming the structure of $joinTable is ['table' => 'table_name', 'on' => 'join_condition']
            $sql .= " JOIN {$joinTable['table']} ON {$joinTable['on']}";
        }

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all selected data as an array of associative arrays
    }
    public function recordExists($table, $columnName, $columnValue)
    {
        $connection = $this->db->getConnection();

        $sql = "SELECT COUNT(*) FROM $table WHERE $columnName = :columnValue";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':columnValue', $columnValue, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->fetchColumn(); // Get the count of matching records

        return $count > 0; // Return true if the record already exists, false otherwise
    }
    public function getDatabyJoinWithCondition($fromTable, $joinTables, $condition)
    {
        $connection = $this->db->getConnection();

        // Build the SQL query to select data based on a condition
        $sql = "SELECT subjects.subjectName FROM $fromTable";

        // Add JOIN clauses for each table in the $joinTables array
        foreach ($joinTables as $joinTable) {
            // Assuming the structure of $joinTable is ['table' => 'table_name', 'on' => 'join_condition']
            $sql .= " JOIN {$joinTable['table']} ON {$joinTable['on']}";
        }

        // Add WHERE clause for the condition
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all selected data as an array of associative arrays
    }



}
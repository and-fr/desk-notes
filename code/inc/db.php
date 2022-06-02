<?php

class Db
{
    const APP_DB = 'sqlite:'.__DIR__.'/../db/notes.db3';
    

    public function __construct()
    {
        try
        {
            $this->pdo = new PDO(self::APP_DB);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    // SPECIFIC METHODS


    public function getTermFullInfo($id)
    {
        $query = "
            SELECT
            Glossary.Term, Glossary.Definition, Glossary.Color, Glossary.NoteId,
            Notes.Name AS NoteName,
            Notebooks.Id AS NotebookId
            FROM Glossary
            LEFT JOIN Notes ON Notes.Id = Glossary.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Glossary.Id = {$id}
            ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getImageFullInfo($id)
    {
        $query = "
            SELECT
            Images.Caption, Images.Image, Images.MIME, Images.NoteId,
            Notes.Name AS NoteName,
            Notebooks.Id AS NotebookId
            FROM Images
            LEFT JOIN Notes ON Notes.Id = Images.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Images.Id = {$id}
            ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getLinkFullInfo($id)
    {
        $query = "
            SELECT
            Links.Name, Links.Url, Links.Color, Links.NoteId,
            Notes.Name AS NoteName,
            Notebooks.Id AS NotebookId
            FROM Links
            LEFT JOIN Notes ON Notes.Id = Links.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Links.Id = {$id}
            ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllNotebooksList()
    {
        $query = "
            SELECT
                Notebooks.Id, Notebooks.Name,
                Collections.Name AS CollectionName
            FROM Notebooks
            LEFT JOIN Collections ON Collections.Id = Notebooks.CollectionId
            ORDER BY CollectionName, Notebooks.Name
            ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getFullNotebookName($id)
    {
        $query = "
            SELECT
            Notebooks.Id, Notebooks.Name,
            Collections.Name AS CollectionName, Collections.Color AS CollectionColor, Collections.Icon AS CollectionIcon
            FROM Notebooks
            JOIN Collections ON Collections.Id = Notebooks.CollectionId
            WHERE Notebooks.Id = {$id}
            ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllTermsForNotebook($id)
    {
        $query = "
            SELECT
                Glossary.Id, Glossary.Term, Glossary.Definition, Glossary.Color,
                Notes.Id AS NoteId,
                Notebooks.Id AS NotebookId
            FROM Glossary
            LEFT JOIN Notes ON Notes.Id = Glossary.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Notebooks.Id = {$id}
            ORDER BY Glossary.Color DESC, Glossary.Term COLLATE NOCASE;
        ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllImagesForNotebook($id)
    {
        $query = "
            SELECT
                Images.Id, Images.Image, Images.MIME, Images.Caption,
                Notes.Id AS NoteId,
                Notebooks.Id AS NotebookId
            FROM Images
            LEFT JOIN Notes ON Notes.Id = Images.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Notebooks.Id = {$id}
            ORDER BY Images.Caption COLLATE NOCASE ASC, Images.Id;
        ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllLinksForNotebook($id)
    {
        $query = "
            SELECT
                Links.Id, Links.Name, Links.Url, Links.Color,
                Notes.Id AS NoteId,
                Notebooks.Id AS NotebookId
            FROM Links
            LEFT JOIN Notes ON Notes.Id = Links.NoteId
            LEFT JOIN Notebooks ON Notebooks.Id = Notes.NotebookId
            WHERE Notebooks.Id = {$id}
            ORDER BY Links.Color DESC, Links.Name COLLATE NOCASE;
        ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    // GENERIC METHODS


    public function countRowsInTable($table)
    {
        $query = "SELECT count(Id) FROM {$table};";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchColumn();
    }


    public function getTableInfo($table)
    {
        $query = "PRAGMA table_info({$table});";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllFromTableSortBy($table,$sort)
    {
        $query = "SELECT * FROM {$table} ORDER BY {$sort}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getAllFromTableWhereSortBy($table,$where,$sort)
    {
        $query = "SELECT * FROM {$table} WHERE {$where} ORDER BY {$sort}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function getIdFromTable($id,$table) 
    {
        $query = "SELECT * FROM {$table} WHERE Id = {$id}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }


    public function addRowToTable($data,$table)
    {
        $sql_values = array();
        $values = array();
    
        foreach ($data as $col => $val) {
            $sql_values[] = '?';
            $values[] = $val;
        }
    
        $str_columns = implode(",",array_keys($data));
        $str_values = implode(",",$sql_values);
    
        $sql = "INSERT INTO {$table} ({$str_columns}) VALUES ({$str_values})";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
    }

    
    public function setRowInTable($data,$table)
    {
        $sql_columns = '';
        $sql_values = '';
        $values = array();
        
        foreach ($data as $col => $val) {
            if ($col == "Id") {
                $id = intval($val);
            } else {
                $sql_columns .= $col.'=?, ';
                $sql_values .= '?, ';
                $values[] = $val;
            }
        }
        $sql_columns = rtrim($sql_columns,', ');
        $sql_values = rtrim($sql_values,', ');
        $sql = "UPDATE {$table} SET {$sql_columns} WHERE Id = {$id}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
    }    


    public function delRowFromTable($data,$table)
    {
        $id = intval($data['Id']);
        $sql = "PRAGMA foreign_keys=ON";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        try
        {
            $sql = "DELETE FROM {$table} WHERE Id = {$id}";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            // die($e);
        }
    }

}

$db = new Db();
?>
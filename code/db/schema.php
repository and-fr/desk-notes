<?php
const DB_FILE = 'sqlite:notes.db3';

$queries = ["
    
    CREATE TABLE IF NOT EXISTS Collections (
        Id INTEGER PRIMARY KEY,
        Name VARCHAR(100) NOT NULL UNIQUE,
        Icon VARCHAR(50),
        Color VARCHAR(7)
    );
    
    ","

    CREATE TABLE IF NOT EXISTS Notebooks (
        Id INTEGER PRIMARY KEY,
        Name VARCHAR(100) NOT NULL UNIQUE,
        Color VARCHAR(7),
        CollectionId INTEGER REFERENCES Collections(Id) ON DELETE NO ACTION
    );
    
    ","

    CREATE TABLE IF NOT EXISTS Notes (
        Id INTEGER PRIMARY KEY,
        Name VARCHAR(100) NOT NULL,
        Color VARCHAR(7),
        NotebookId INTEGER REFERENCES Notebooks(Id) ON DELETE NO ACTION
    );

    ","

    CREATE TABLE IF NOT EXISTS Links (
        Id INTEGER PRIMARY KEY,
        Name VARCHAR(250) NOT NULL,
        Url VARCHAR(250),
        Color VARCHAR(7),
        NoteId INTEGER REFERENCES Notes(Id) ON DELETE NO ACTION
    );

    ","

    CREATE TABLE IF NOT EXISTS Glossary (
        Id INTEGER PRIMARY KEY,
        Term VARCHAR(250) NOT NULL,
        Definition TEXT,
        Color VARCHAR(7),
        NoteId INTEGER REFERENCES Notes(Id) ON DELETE NO ACTION
    );

    ","

    CREATE TABLE IF NOT EXISTS Images (
        Id INTEGER PRIMARY KEY,
        Image BLOB,
        MIME VARCHAR(250) NOT NULL,
        Caption TEXT,
        NoteId INTEGER REFERENCES Notes(Id) ON DELETE NO ACTION
    );

    "
];


?>
<!DOCTYPE html>
<html>
<head><title>db schema</title></head>
<body>
    <form method="post">
        <input type="submit" name="action" value="Create DB & Schema">
    </form>
    <?php
    if (!empty($_POST))
    {
        $info = "";
        $pdo = new PDO(DB_FILE);

        foreach($queries as $query)
        {
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        }

        $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $info = 'Tables present in '.DB_FILE.' : '.PHP_EOL;
        foreach($result as $tables)
        {
            $info .= $tables['name'].' ';
        }

        echo '<pre>'.$info.'</pre>';
    }
    ?>
</body>
</html>
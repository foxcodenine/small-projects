<?php

namespace app\Model;



class DBTables {

    const User = 'CREATE TABLE IF NOT EXISTS User (
        id INT PRIMARY KEY AUTO_INCREMENT,
        firstUserName VARCHAR(100),
        lastUserName VARCHAR(100),
        email VARCHAR(100) NOT NULL,
        passHash VARCHAR(255) NOT NULL,
        accountState VARCHAR(100) NOT NULL,
        roleGroup VARCHAR(100),
        signUpDate DATETIME,
        lastLogin DATETIME,
        token VARCHAR(255),
        dashboard VARCHAR(20)
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------


    const Locality = 'CREATE TABLE IF NOT EXISTS Locality (
        id INT PRIMARY KEY AUTO_INCREMENT,
        lName VARCHAR(100) NOT NULL,

        userID INT NOT NULL ,
        CONSTRAINT User_Locality
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE,
        
        UNIQUE KEY unique_cName_userID (lName, userID) 
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const Country = 'CREATE TABLE IF NOT EXISTS Country (
        id INT PRIMARY KEY AUTO_INCREMENT,
        cName VARCHAR(100) NOT NULL,

        userID INT NOT NULL ,
        CONSTRAINT User_County
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE,
        
        UNIQUE KEY unique_cName_userID (cName, userID)        
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const Stage = 'CREATE TABLE IF NOT EXISTS Stage (
        id INT PRIMARY KEY AUTO_INCREMENT,
        sName VARCHAR(100) NOT NULL,

        userID INT NOT NULL ,
        CONSTRAINT User_Stage
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE,
        
        UNIQUE KEY unique_sName_userID (sName, userID)        
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const Category = 'CREATE TABLE IF NOT EXISTS Category (
        id INT PRIMARY KEY AUTO_INCREMENT,
        yName VARCHAR(100) NOT NULL,

        userID INT NOT NULL ,
        CONSTRAINT User_Category
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE,
        
        UNIQUE KEY unique_yName_userID (yName, userID)        
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const Client = ' CREATE TABLE IF NOT EXISTS Client (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(6),
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        idCard VARCHAR(50),
        company VARCHAR(255),
        email VARCHAR(100),
        phone VARCHAR(25),
        mobile VARCHAR(25),
        strAddr VARCHAR(255),
        postcode VARCHAR(50),

        localityName VARCHAR(100) ,
        CONSTRAINT Locality_Client
            FOREIGN KEY (localityName) REFERENCES Locality (lName)
            ON DELETE SET NULL,

        countryName VARCHAR(100) ,
        CONSTRAINT Country_Client
            FOREIGN KEY (countryName) REFERENCES Country (cName)
            ON DELETE SET NULL,

        userID INT NOT NULL ,
        CONSTRAINT User_Client
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------
    
    const Project = 'CREATE TABLE IF NOT EXISTS Project (
        id INT PRIMARY KEY AUTO_INCREMENT,
        projectname VARCHAR(100) NOT NULL,
        strAddr VARCHAR(255),
        projectNo VARCHAR(50),
        paNo VARCHAR(50),
        projectDate DATE,
        cover VARCHAR(255),
        hosted BOOLEAN,

        localityName VARCHAR(100) ,
        CONSTRAINT Locality_Poject
            FOREIGN KEY (localityName) REFERENCES Locality (lName)
            ON DELETE SET NULL,

        stageName VARCHAR(100) ,
        CONSTRAINT Stage_Poject
            FOREIGN KEY (stageName) REFERENCES Stage (sName)
            ON DELETE SET NULL,

        categoryName VARCHAR(100) ,
        CONSTRAINT Category_Poject
            FOREIGN KEY (categoryName) REFERENCES Category (yName)
            ON DELETE SET NULL,

        clientId INT,
        CONSTRAINT Client_Poject
            FOREIGN KEY (clientId) REFERENCES Client (id)
            ON DELETE SET NULL,


        userID INT NOT NULL ,
        CONSTRAINT User_Poject
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE
    )';

    // -----------------------------------------------------------------


    const InfoClient = 'CREATE TABLE IF NOT EXISTS InfoClient (
        id INT PRIMARY KEY AUTO_INCREMENT,
        info TEXT,
    
        userID INT NOT NULL ,
        CONSTRAINT User_InfoClient
                FOREIGN KEY (userID) REFERENCES User (id)
                ON DELETE CASCADE,
    
        clientID INT NOT NULL ,
        CONSTRAINT Client_InfoClient
                FOREIGN KEY (clientID) REFERENCES Client (id)
                ON DELETE CASCADE
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const DescriptProject = 'CREATE TABLE IF NOT EXISTS DescriptProject(
        id INT PRIMARY KEY AUTO_INCREMENT,
        descript TEXT,
    
        userID INT NOT NULL ,
        CONSTRAINT User_DescriptProject
                FOREIGN KEY (userID) REFERENCES User (id)
                ON DELETE CASCADE,
    
        projectID INT NOT NULL ,
        CONSTRAINT Project_DescriptProject
                FOREIGN KEY (projectID) REFERENCES Project (id)
                ON DELETE CASCADE
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const ImageProject = 'CREATE TABLE IF NOT EXISTS ImageProject(
        id INT PRIMARY KEY AUTO_INCREMENT,
        cover BOOLEAN,
        urlPath VARCHAR(255) NOT NULL,
        position INT,
        code varchar(12),
    
        userID INT NOT NULL ,
        CONSTRAINT User_ImageProject
                FOREIGN KEY (userID) REFERENCES User (id)
                ON DELETE CASCADE,
    
        projectID INT NOT NULL ,
        CONSTRAINT Project_ImageProject
                FOREIGN KEY (projectID) REFERENCES Project (id)
                ON DELETE CASCADE
    )ENGINE=InnoDB;';


    // -----------------------------------------------------------------

    static function createTables () {
        $oClass = new \ReflectionClass(__CLASS__);
        $arrTables = $oClass->getConstants();

        foreach ($arrTables as $table) {
            DBConnect::execSql($table);
        }
    }

    static function dropTables () {
        $oClass = new \ReflectionClass(__CLASS__);
        $tablesArr = array_reverse(array_keys($oClass->getConstants()));
        array_pop($tablesArr);

        $tablesStr = implode(', ', $tablesArr);
        $sql = 'DROP TABLE IF EXISTS ' . $tablesStr;
        DBConnect::execSql($sql);           
    }

    static function populateTables ($email) {

        $email = base64_encode(htmlspecialchars($email));

        $sql = <<< END_SQL

        SET @userID = (SELECT id FROM User WHERE email = '$email');

        INSERT INTO Locality (lName, userID) VALUES ('Attard', @userID), ('Zurrieq', @userID), ('Valletta', @userID), ('Victoia', @userID), ("St Paul's Bay", @userID);
        INSERT INTO Country  (cName, userID) VALUES ('Malta', @userID), ('Gozo', @userID), ('UK', @userID);
        INSERT INTO Stage    (sName, userID) VALUES ('Complete', @userID), ('Inprogress', @userID), ('Final stage', @userID);
        INSERT INTO Category (yName, userID) VALUES ('Residential', @userID), ('Commercial', @userID), ('Public', @userID);

        INSERT INTO Client (title, firstname, lastname, idCard, company, email, phone, mobile, strAddr, postcode, localityName, countryName, userID)
        VALUES 
        ('Mr', 'James',     'Zuggo', '0544714M', 'Developer', 'jamesmiddi@ldtto.com',   NULL,       '0356 78451241', '71 Cherry Court',        'ATD0002', 'Attard',  'Malta', @userID),
        ('Mrs','Sarah',     'Mizzi', '0024571M',  Null,       'sm1784@gmail.com',       21454514,   '0356 99665552', '83 Howard Street',       'ZQR0051', 'Zurrieq', 'Malta', @userID),
        ('Mr', 'Luke',      'Vella', '7825412G', 'Manager',   'luke@vellagroup.com',    21568956,   NULL,            'San Lawrenz Triq ir-Rokon',  NULL,  'Victoia', 'Gozo',  @userID),
        ('Mrs','Dorothy',   'Cassar', '124451M',  Null,         'bluehorse@gmail.com',  Null,       '78457812',      '6 St.Francis Square',     'VAL0225','Valletta','Malta', @userID);
        
        INSERT INTO Project (projectname, strAddr, projectNo, paNo,  projectDate, cover,  hosted, localityName, stageName, categoryName, clientId, userID) 
        VALUES 
        ('T12 Office Building',  'Tigne Point, Victoria, Gozo',     '1245', 'PA 1245/14',  '2014-4-4', NULL, NULL, 'Victoia',       'Complete',  'Commercial', NULL, @userID),
        ('Sirens Complex', "Aquatic centre in St. Paul's Bay",      '7811', 'PA 5155/17',  '2020-2-2', NULL, NULL, "St Paul's Bay", 'Inprogress','Commercial', NULL, @userID);  
        
        END_SQL;

        DBConnect::execSql($sql);  


    }
}


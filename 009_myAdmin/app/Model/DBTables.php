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
        token VARCHAR(255)
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

    const Poject = 'CREATE TABLE IF NOT EXISTS Project (
        id INT PRIMARY KEY AUTO_INCREMENT,
        projectname VARCHAR(100) NOT NULL,
        strAddr VARCHAR(255),
        projectNo VARCHAR(50),
        paNo VARCHAR(50),
        projectDate DATE,
        cover VARCHAR(255),

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

}


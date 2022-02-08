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


    const Client = ' CREATE TABLE IF NOT EXISTS Client (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(6),
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        idCard VARCHAR(50),
        company VARCHAR(255),
        email VARCHAR(100),
        phone INT,
        mobile INT,
        streetAddress VARCHAR(255),
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

    static function createTables () {
        $oClass = new \ReflectionClass(__CLASS__);
        $arrTables = $oClass->getConstants();

        foreach ($arrTables as $table) {
            DBConnect::execSql($table);
        }
    }

}


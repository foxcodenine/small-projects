<?php

namespace app\Model;



class DBTables {

    const User = 'CREATE TABLE IF NOT EXISTS User (
        id INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(20) NOT NULL,
        pass VARCHAR(255) NOT NULL,
        active VARCHAR(20) NOT NULL,
        roleGroup VARCHAR(20),
        signUpDate DATETIME,
        lastLogin DATETIME,
        token VARCHAR(255)
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------


    const Locality = 'CREATE TABLE IF NOT EXISTS Locality (
        id INT PRIMARY KEY AUTO_INCREMENT,
        lName VARCHAR(20) NOT NULL UNIQUE,

        userID INT NOT NULL ,
        CONSTRAINT User_Locality
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------

    const Country = 'CREATE TABLE IF NOT EXISTS Country (
        id INT PRIMARY KEY AUTO_INCREMENT,
        cName VARCHAR(20) NOT NULL UNIQUE,

        userID INT NOT NULL ,
        CONSTRAINT User_County
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE
    )ENGINE=InnoDB;';

    // -----------------------------------------------------------------


    const Client = ' CREATE TABLE IF NOT EXISTS Client (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(6) NOT NULL,
        firstname VARCHAR(20) NOT NULL,
        lastname VARCHAR(20) NOT NULL,
        idCard VARCHAR(10),
        company VARCHAR(255),
        clientNo INT,
        phone INT,
        mobile INT,
        streetAddress VARCHAR(255),
        postcode VARCHAR(10),

        localityName VARCHAR(20) ,
        CONSTRAINT Locality_Client
            FOREIGN KEY (localityName) REFERENCES Locality (lName)
            ON DELETE SET NULL,

        countryName VARCHAR(20) ,
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


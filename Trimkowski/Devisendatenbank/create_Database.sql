Show create database project;
'project', 'CREATE DATABASE `project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION=\'N\' */'

Show create Table project.devisen;
'devisen', 'CREATE TABLE `devisen` (\n  `Devise` varchar(3) DEFAULT NULL,\n  `Wert` double DEFAULT NULL\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci'

Show create Table project.getHistory;
'getHistory', 'CREATE TABLE `getHistory` (\n  `Datum` date NOT NULL,\n  `devise` varchar(4) NOT NULL,\n  `Wert` double DEFAULT NULL,\n  PRIMARY KEY (`Datum`,`devise`)\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci'
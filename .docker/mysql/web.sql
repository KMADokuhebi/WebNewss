-- Create a new database called 'DatabaseName'
-- Connect to the 'master' database to run this snippet
DROP DATABASE IF EXISTS Webtintuc;

CREATE DATABASE Webtintuc;

USE Webtintuc;

CREATE TABLE Users
(
    IdUser INT NOT NULL PRIMARY KEY,
    UserNames VARCHAR(30) NOT NULL,
    PassWords VARCHAR(30) NOT NULL,
    Hoten VARCHAR(30) NOT NULL,
    Addresss VARCHAR(30) NOT NULL,
    NumberPhone VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    RegDate DATETIME NOT NULL,
    Sex BOOLEAN NOT NULL,
    Active boolean

);
CREATE TABLE Theloai
(
    IdTL INT not NULL PRIMARY KEY,
    TenTL VARCHAR(30) NOT NULL,
    FullTenTL VARCHAR(30) NOT NULL,
    ThuTu INT NOT NULL,
    AnHien BOOLEAN
);


CREATE TABLE LoaiTin
(
    IdLT INT NOT NULL PRIMARY KEY,
    TenLT VARCHAR(30) NOT NULL,
    FullTenLT VARCHAR(30) NOT NULL,
    ThuTu INT NOT NULL,
    AnHien BOOLEAN,
    IdTL INT NOT NULL
);

CREATE TABLE Tin
(
    IdTin INT NOT NULL PRIMARY KEY,
    Tieude VARCHAR(30) NOT NULL,
    FullTieude VARCHAR(30) NOT NULL,
    TomTat VARCHAR(30) NOT NULL,
    IdTL INT not NULL,
    IdLT INT not NULL,
    Content VARCHAR(30) NOT NULL,
    UrlAnh VARCHAR(30) NOT NULL,
    IdUser INT not NULL,
    NgayDang DATETIME NOT NULL,
    Solanxem INT ,
    AnHien BOOLEAN
);
    



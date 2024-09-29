/* Par Melvyn Bariou R3.01 - Developpement web */

-- CREATE DATABASE IF NOT EXISTS SportTrack;

-- USE  SportTrack;

-- Create Users table
CREATE TABLE IF NOT EXISTS Users (
    email TEXT PRIMARY KEY,
    password TEXT NOT NULL,
    firstName TEXT NOT NULL,
    lastName TEXT NOT NULL,
    birthdate DATE NOT NULL,
    gender TEXT NOT NULL,
    height REAL NOT NULL,
    weight REAL NOT NULL,
    CONSTRAINT ck_email CHECK (email LIKE '%@%.%'),
    CONSTRAINT ck_firstName CHECK (LENGTH(firstName) > 0),
    CONSTRAINT ck_lastName CHECK (LENGTH(lastName) > 0),
    CONSTRAINT ck_gender CHECK (gender IN ('M', 'F')),
    CONSTRAINT ck_height CHECK (height > 0),
    CONSTRAINT ck_weight CHECK (weight > 0)
);

-- Create Activities table
CREATE TABLE IF NOT EXISTS Activities (
    activityId INTEGER PRIMARY KEY AUTOINCREMENT,
    userEmail TEXT NOT NULL,
    activityDate DATE NOT NULL,
    startTime TIME NOT NULL,
    endTime TIME NOT NULL,
    duration REAL NOT NULL,
    description TEXT NOT NULL,
    distance REAL NOT NULL,
    cardioFrequencyMin INTEGER NOT NULL,
    cardioFrequencyMax INTEGER NOT NULL,
    cardioFrequencyAverage REAL NOT NULL,
    CONSTRAINT ck_description CHECK (LENGTH(description) > 0),
    CONSTRAINT ck_distance CHECK (distance > 0),
    CONSTRAINT ck_start_end_time CHECK (startTime < endTime),
    CONSTRAINT ck_cardioFrequency CHECK (cardioFrequencyMin <= cardioFrequencyMax),
    CONSTRAINT ck_cardioFrequencyAvg CHECK (cardioFrequencyAverage >= cardioFrequencyMin AND cardioFrequencyAverage <= cardioFrequencyMax),
    CONSTRAINT ck_duration CHECK (duration >= 0),
    CONSTRAINT fk_userId FOREIGN KEY(userEmail) REFERENCES Users(email) ON DELETE CASCADE
);


-- Create ActivityEntry table
CREATE TABLE IF NOT EXISTS Data (
    dataId INTEGER PRIMARY KEY AUTOINCREMENT,
    activityId INTEGER NOT NULL,
    dataTime TIME NOT NULL,
    cardioFrequency INTEGER NOT NULL,
    latitude REAL NOT NULL,
    longitude REAL NOT NULL,
    altitude REAL NOT NULL,
    CONSTRAINT ck_cardioFrequency CHECK (cardioFrequency > 0),
    CONSTRAINT ck_latitude CHECK (latitude BETWEEN -90 AND 90),
    CONSTRAINT ck_longitude CHECK (longitude BETWEEN -180 AND 180),
    CONSTRAINT ck_altitude CHECK (altitude BETWEEN -1000 AND 10000),
    CONSTRAINT fk_activityId FOREIGN KEY(activityId) REFERENCES Activities(activityId) ON DELETE CASCADE
);


/*
sqlite3 sport_track.db

.read sport_track.db

.dump

.quit

.write sport_track.db
*/
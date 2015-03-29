-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
    id SERIAL PRIMARY KEY,
    nimi VARCHAR(50) not null,
    salasana VARCHAR(50) not null,
    sposti VARCHAR(100) not null,
    yllapitaja BOOLEAN DEFAULT false
);

CREATE TABLE Drinkit(
    id SERIAL PRIMARY KEY,
    ehdottaja_id INTEGER REFERENCES Kayttaja(id),
    nimi VARCHAR(100) not null,
    hyvaksytty_ehdotus BOOLEAN DEFAULT false,
    kuvaus VARCHAR(1000),
    ohje VARCHAR(1000) not null,
    ajankohta VARCHAR(50) not null,
    makeus VARCHAR(50) not null,
    lasi VARCHAR(50) not null,
    lampotila VARCHAR(50) not null,
    menetelma VARCHAR(50) not null    
);

CREATE TABLE Ainesosat(
    id SERIAL PRIMARY KEY,
    nimi VARCHAR(100) not null,
    tyyppi VARCHAR(50) not null,
    tietoa VARCHAR(1000)
);

CREATE TABLE Drinkki_Aineet(
    drinkki_id INTEGER REFERENCES Drinkit(id),
    aine_id INTEGER REFERENCES Ainesosat(id),
    maara VARCHAR(20) not null
);
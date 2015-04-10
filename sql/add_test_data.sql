-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO kayttaja (nimi, salasana, sposti, yllapitaja) VALUES('markus','markus123','diipadaapa@asa.as', true);
INSERT INTO kayttaja (nimi, salasana, sposti) VALUES('kk','kk1234','ljaefa.etoih@asd.ty');

INSERT INTO drinkit (nimi, kuvaus, ohje, ajankohta, makeus, lasi, lampotila, menetelma, ehdottaja_id, hyvaksytty_ehdotus) 
    VALUES('Long island ice tea', 'DIIPA DAAPAA LONG ISLAND BLAA', 
'Laita ravistimeen jäitä, lisää muut ainesosat. ja sekoita pikaisesti. Kaada juoma lasiin, jossa on jääpaloja pohjalla. Valmiin juoman tulisi poreilla kevyesti. Koristele juoma sitruunaviipaleella.',
'All day', 'Makeahko', 'Collins-lasi', 'Jäinen', 'Ravistetaan', 1, true);

INSERT INTO ainesosat (nimi, tyyppi) VALUES('Gin', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Rommi (vaalea)', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Cola limsa', 'Mikseri');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Siirappi (sitruuna)', 'Siirapit ja aromit');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Triple sec', 'Likööri');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Tequila', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Vodka', 'Väkevä viina');

INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Vodka'), '1 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Gin'), '1 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Rommi (vaalea)'), '1 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Cola limsa'), '1 dl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Siirappi (sitruuna)'), '1,5 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Triple sec'), '1 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Long island ice tea'), 
    (select id from ainesosat where nimi = 'Tequila'), '1 cl');

INSERT INTO drinkit (nimi, kuvaus, ohje, ajankohta, makeus, lasi, lampotila, menetelma, ehdottaja_id, hyvaksytty_ehdotus) 
    VALUES('Valkovenäläinen', 'kahvinen maku ei mikään ryyppäämis juoma', 
    'kaadetaan pohjalle ural mocca likööriä 2cl ja maitoa 4cl seotetaan voi lisätä kerma vaahtoa',
    'All day', 'Makea', 'Cocktail-lasi', 'Viileä', 'Rakennetaan', 1, true);

INSERT INTO ainesosat (nimi, tyyppi) VALUES('Kerma', 'Mikseri');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Kahlua', 'Likööri');

INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Valkovenäläinen'), 
    (select id from ainesosat where nimi = 'Kerma'), '2 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Valkovenäläinen'), 
    (select id from ainesosat where nimi = 'Kahlua'), '2 cl');
INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) 
    VALUES((select id from drinkit where nimi = 'Valkovenäläinen'), 
    (select id from ainesosat where nimi = 'Vodka'), '2 cl');


-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO kayttaja (nimi, salasana, sposti) VALUES('markus','markus123','diipadaapa@asa.as');
INSERT INTO kayttaja (nimi, salasana, sposti) VALUES('kk','kk1234','ljaefa.etoih@asd.ty');

INSERT INTO ainesosat (nimi, tyyppi) VALUES('Gin', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Rommi (vaalea)', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Cola limsa', 'Mikseri');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Siirappi (sitruuna)', 'Siirapit ja aromit');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Triple sec', 'Likööri');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Tequila', 'Väkevä viina');
INSERT INTO ainesosat (nimi, tyyppi) VALUES('Vodka', 'Väkevä viina');

INSERT INTO drinkit (nimi, kuvaus, ohje, ajankohta, makeus, lasi, lampotila, menetelma, ehdottaja_id, hyvaksytty_ehdotus) 
VALUES('Long island ice tea', 'DIIPA DAAPAA LONG ISLAND BLAA', 
'Laita ravistimeen jäitä, lisää muut ainesosat. ja sekoita pikaisesti. Kaada juoma lasiin, jossa on jääpaloja pohjalla. Valmiin juoman tulisi poreilla kevyesti. Koristele juoma sitruunaviipaleella.',
'All day', 'Makeahko', 'Collins-lasi', 'Jäinen', 'Ravistetaan', 1, true);

INSERT INTO drinkit (nimi, kuvaus, ohje, ajankohta, makeus, lasi, lampotila, menetelma, ehdottaja_id, hyvaksytty_ehdotus) 
VALUES('Valkovenäläinen', 'kahvinen maku ei mikään ryyppäämis juoma', 
'kaadetaan pohjalle ural mocca likööriä 2cl ja maitoa 4cl seotetaan voi lisätä kerma vaahtoa',
'All day', 'Makea', 'Cocktail-lasi', 'Viileä', 'Rakennetaan', 1, true);
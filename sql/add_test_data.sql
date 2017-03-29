-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Person-taulun testidata
INSERT INTO Person (name, password) VALUES ('Noora', 'noora'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Person(name, password) VALUES ('piipaa', 'piipaa');
-- Task taulun testidata
INSERT INTO Task (name, description, deadline, added, status_id, priority_id) VALUES ('Do the dishes', 'Use the ECO washprogram to save water!', '2017-03-24', NOW(), '2', '2');

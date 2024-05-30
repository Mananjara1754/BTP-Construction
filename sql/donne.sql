insert into role (id_role,nom) values
('ROLE1','admin');

insert into service (nom, utilisateur ,mdp) values
('Admin','admin','admin');

insert into service_role(id_service, id_role) values
('S1', 'ROLE1');

insert into client (numero_client) values
('0');

insert into unite (nom_unite) values
('m3'),
('m2'),
('fft');

insert into maison (nom_maison,description,duree_fabrication,surface) values
('Maison moderne','La maison  de vos reve',90,800);

insert into finition (nom_finition,augmentation) values
('Standard',0),
('Gold',20),
('Premium',30),
('VIP',40);

insert into lieu (nom_lieu) values
('Antanimena'),
('Andoharanofotsy'),
('Besarety'),
('Anosy');


insert into travaux (code_travaux,id_unite,prix_unitaire,nom_travaux) values
('101','UNT2',3072.87,'Decapage des terrains meubles'),
('102','UNT2',3736.26,'Dressage du plateforme'),
('103','UNT1',9390.93,'Fouille d ouvrage '),
('104','UNT1',37563.26,'Remblai ouvrage '),
('105','UNT3',152656,'Travaux implantation');

insert into maison_travaux (id_maison,id_travaux,qte) values
('MSN1','TRV1',101.36),
('MSN1','TRV2',101.36),
('MSN1','TRV3',24.44),
('MSN1','TRV4',15.59),
('MSN1','TRV5',1);


-- insert into maison_travaux (id_maison,id_travaux,qte,montant_travaux) values
-- ('MSN1','TRV1',101.36,101.36*3072.87),
-- ('MSN1','TRV2',101.36,101.36*3736.26),
-- ('MSN1','TRV3',24.44,24.44*9390.93),
-- ('MSN1','TRV4',15.59,15.59*37563.26),
-- ('MSN1','TRV5',1,1*152656);








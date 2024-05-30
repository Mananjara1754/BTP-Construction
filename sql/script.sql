

    create sequence seq_service increment by 1 minvalue 1 START 1; 
    create table service (
        id_service varchar default 'S'||nextval('seq_service'),
        utilisateur varchar,
        nom varchar,
        mdp varchar,
        primary key (id_service)
    );
    -- create sequence seq_role increment by 1 minvalue 1 START 1; 
    create table role (
        id_role varchar,
        nom varchar,
        primary key (id_role)
    );
    CREATE table service_role(
        id_service VARCHAR NOT NULL, 
        id_role VARCHAR NOT NULL,
        foreign key (id_service) references service(id_service),
        foreign key (id_role) references role(id_role)
    );

    create sequence seq_client increment by 1 minvalue 1 START 1; 
    create table client (
        id_client varchar default 'CLN'||nextval('seq_client'),
        numero_client varchar,
        primary key (id_client)
    );
    create sequence seq_unite increment by 1 minvalue 1 START 1; 
    create table unite (
        id_unite varchar default 'UNT'||nextval('seq_unite'),
        nom_unite varchar,
        primary key (id_unite)
    );
    create sequence seq_maison increment by 1 minvalue 1 START 1; 
    create table maison (
        id_maison varchar default 'MSN'||nextval('seq_maison'),
        nom_maison varchar,
        surface float,
        description varchar,
        duree_fabrication float,
        primary key (id_maison)
    );
    create sequence seq_finition increment by 1 minvalue 1 START 1; 
    create table finition (
        id_finition varchar default 'FNT'||nextval('seq_finition'),
        nom_finition varchar,
        augmentation float,
        primary key (id_finition)
    );
    create sequence seq_lieu increment by 1 minvalue 1 START 1; 
    create table lieu (
        id_lieu varchar default 'LIE'||nextval('seq_lieu'),
        nom_lieu varchar,
        primary key (id_lieu)
    );
    -- create sequence seq_categorie_travaux increment by 1 minvalue 1 START 1; 
    -- create table categorie_travaux (
    --     id_categorie_travaux varchar default 'CTG_TRV'||nextval('seq_categorie_travaux'),
    --     code_categorie_travaux varchar,
    --     nom_categorie_travaux varchar,
    --     primary key (id_categorie_travaux),
    --     unique(code_categorie_travaux)
    -- );
    create sequence seq_travaux increment by 1 minvalue 1 START 1; 
    create table travaux (
        id_travaux varchar default 'TRV'||nextval('seq_travaux'),
        code_travaux varchar,
        id_unite varchar,
        prix_unitaire float,
        nom_travaux varchar,
        primary key (id_travaux),
        unique(code_travaux),
        foreign key (id_unite) references unite(id_unite)
    );
    -- create sequence seq_sous_travaux increment by 1 minvalue 1 START 1; 
    -- create table sous_travaux (
    --     id_sous_travaux varchar default 'SOUS_TRV'||nextval('seq_sous_travaux'), 
    --     id_travaux varchar,
    --     nom_sous_travaux varchar,
    --     primary key (id_sous_travaux)
    -- );
    create sequence seq_maison_travaux increment by 1 minvalue 1 START 1; 
    create table maison_travaux (
        id_maison_travaux varchar default 'MSN_TRV'||nextval('seq_maison_travaux'),
        id_maison varchar, 
        id_travaux varchar,
        qte float NOT NULL,
        primary key (id_maison_travaux),
        foreign key (id_maison) references maison(id_maison),
        foreign key (id_travaux) references travaux(id_travaux)
    );
    create sequence seq_devis increment by 1 minvalue 1 START 1; 
    create table devis (
        id_devis varchar default 'DVS'||nextval('seq_devis'), 
        id_maison varchar,
        id_finition varchar,
        id_client varchar,
        id_lieu varchar,
        nom_lieu varchar,
        nom_finition varchar,
        nom_maison varchar,
        surface float,
        date_debut date NOT NULL,
        date_fin date,
        duree_fabrication float,
        augmentation float,
        montant_devis float,
        montant_devis_sans float,
        date_devis date default now()::date,
        montant_payee float default 0,
        etat_devis int default 0,
        ref_devis varchar default 'ref_DVS'||nextval('seq_devis'),
        numero_client varchar,
        primary key (id_devis),
        unique(ref_devis),
        foreign key (id_maison) references maison(id_maison),
        foreign key (id_lieu) references lieu(id_lieu),
        foreign key (id_finition) references finition(id_finition),
        foreign key (id_client) references client(id_client)
    );


    create sequence seq_devis_travaux increment by 1 minvalue 1 START 1; 
    create table devis_travaux (
        id_devis_travaux varchar default 'DVS_TRV'||nextval('seq_devis_travaux'),
        id_devis varchar,
        id_unite varchar,
        id_travaux varchar,
        nom_unite varchar,
        nom_travaux varchar,
        code_travaux varchar,
        qte float NOT NULL,
        prix_unitaire float,
        montant_travaux float,
        primary key (id_devis_travaux),
        foreign key (id_devis) references devis(id_devis),
        foreign key (id_unite) references unite(id_unite),
        foreign key (id_travaux) references travaux(id_travaux)
    );

    create sequence seq_paiement increment by 1 minvalue 1 START 1; 
    create table paiement (
        id_paiement varchar default 'PMT'||nextval('seq_paiement'),
        id_devis varchar,
        montant_payee float,
        date_paiement varchar,
        ref_paiement varchar default 'ref_PMT'||nextval('seq_paiement'),
        primary key (id_paiement),
        unique(ref_paiement),
        foreign key (id_devis) references devis(id_devis)
    );
 create sequence seq_import_trav_maison increment by 1 minvalue 1 START 1; 
  create sequence seq_import_devis increment by 1 minvalue 1 START 1; 
  create sequence seq_import_paiement increment by 1 minvalue 1 START 1; 

    create table import_trav_maison (
        id_ligne int,
        type_maison varchar,
        description varchar,
        surface varchar,
        code_travaux varchar,
        type_travaux varchar,
        unite varchar,
        prix_unitaire varchar,
        quantite varchar,
        duree_travaux varchar,
        primary key (id_ligne)
    );
    create table import_devis (
        id_ligne int,
        client varchar,
        ref_devis varchar,
        type_maison varchar,
        finition varchar,
        taux_finition varchar,
        date_devis varchar,
        date_debut varchar,
        lieu varchar,
        primary key (id_ligne)
    );
    create table import_paiement (
        id_ligne int,
        ref_devis varchar,
        ref_paiement varchar,
        date_paiement varchar,
        montant varchar,
        primary key (id_ligne)
    );


    -- create sequence seq_demande increment by 1 minvalue 1 START 1; 
    -- create table demande (
    --     id_demande varchar default 'demande'||nextval('seq_demande'),
    --     id_client varchar,
    --     etat_demande int,
    --     date_demande date default now()::date,
    --     primary key (id_demande),
    --     foreign key (id_client) references client(id_client)
    -- );



    -- create sequence seq_emp increment by 1 minvalue 1 START 1; 
    -- create table emp (
    --     id_emp varchar default 'EMP'||nextval('seq_emp'),
    --     nom_emp varchar,
    --     primary key (id_emp)
    -- );
--     -- Supprimer la contrainte existante
-- ALTER TABLE test DROP CONSTRAINT prix;
-- -- Ajouter la nouvelle contrainte sans la condition prix != 0
-- ALTER TABLE test ADD CONSTRAINT prix_check CHECK (prix IS NOT NULL AND prix >= 0);

-- -- ALTER TABLE service ADD CONSTRAINT code_vendeur unique(code_vendeur);


        

















    
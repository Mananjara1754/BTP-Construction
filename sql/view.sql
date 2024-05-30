

-- create or replace view v_devis as
-- select devis.*,
-- case 
-- when etat_devis=0 then 'Paiement non effectue'
-- when etat_devis=20 then 'Paiement effectue'
-- end as verifPaiement,
-- (montant_payee/montant_devis)*100 as pourcentage
-- from devis;

create or replace view v_devis as
select devis.*,
case 
when etat_devis=0 then 'Paiement non effectue'
when etat_devis=20 then 'Paiement effectue'
end as verifPaiement,
(montant_payee/montant_devis)*100 as pourcentage,
case 
when (montant_payee/montant_devis)*100 <50 then 'red'
when (montant_payee/montant_devis)*100 ==50 then ''
when (montant_payee/montant_devis)*100 >50 then 'green'
end as color_pourcentage
from devis;

-- create or replace view v_devis as
-- select devis.*,
-- case 
-- when etat_devis=0 then 'Paiement non effectue'
-- when etat_devis=20 then 'Paiement effectue'
-- end as verifPaiement,
-- (montant_payee/montant_devis)*100 as pourcentage,
-- case 
-- when (montant_payee/montant_devis)*100 <=25 then 'red'
-- when (montant_payee/montant_devis)*100 <=75 and (montant_payee/montant_devis)*100 >25 then 'yellow'
-- when (montant_payee/montant_devis)*100 <=100 and (montant_payee/montant_devis)*100 >75 then 'green'
-- end as color_pourcentage
-- from devis;


create or replace view v_travaux as
select travaux.*,
unite.nom_unite
from travaux 
join unite ON unite.id_unite = travaux.id_unite
;

create or replace view v_travaux as
select travaux.*,unite.nom_unite from travaux
join unite ON unite.id_unite = travaux.id_unite;

 create or replace view v_maison_travaux as
 select maison_travaux.*,
 v_travaux.prix_unitaire,v_travaux.id_unite,v_travaux.code_travaux,v_travaux.nom_unite,v_travaux.nom_travaux,
 maison.nom_maison,
 (v_travaux.prix_unitaire*maison_travaux.qte) as montant_travaux
 from maison_travaux 
 join v_travaux on maison_travaux.id_travaux = v_travaux.id_travaux
 join maison ON maison.id_maison = maison_travaux.id_maison
 ;
 create or replace view v_details_devis as
select devis.*,
devis_travaux.id_devis_travaux ,
devis_travaux.id_unite ,
devis_travaux.id_travaux ,
devis_travaux.nom_unite ,
devis_travaux.nom_travaux ,
devis_travaux.code_travaux ,
devis_travaux.qte,
devis_travaux.prix_unitaire ,
devis_travaux.montant_travaux 
from devis_travaux
join devis ON devis.id_devis = devis_travaux.id_devis
;

-- create or replace view v_details_devis as
-- select devis_travaux.*,
-- unite.nom_unite,
-- travaux.code_travaux,travaux.nom_travaux,
-- maison.nom_maison,maison.description,
-- devis.montant_devis,devis.montant_devis_sans
-- from devis_travaux
-- join unite ON unite.id_unite = devis_travaux.id_unite
-- join travaux ON travaux.id_travaux = devis_travaux.id_travaux
-- join devis ON devis.id_devis = devis_travaux.id_devis
-- join maison ON maison.id_maison = devis.id_maison
-- ;



///--------------------
    
    

    
    create or replace view v_rang_place as
    select rang_place.*,range.nom_range,place.numero_place from rang_place 
    join range 
    on rang_place.id_range = range.id_range
    join place 
    on place.id_place = rang_place.id_place;

    create or replace view v_diffusion as
    select diffusion.*,
    film.nom_film,
    salle.nom_salle
    from diffusion
    join film on film.id_film = diffusion.id_film
    join salle on salle.id_salle = diffusion.id_salle
    ;

create or replace view v_billet as
select billet.id_billet,billet.type_billet,billet.etat_billet,
prix_billet.prix_apres,prix_billet.prix_avant,prix_billet.prix_enfant,prix_billet.heure,
v_diffusion.*,
v_rang_place.id_place,v_rang_place.id_rang_place,v_rang_place.id_range,v_rang_place.nom_range,v_rang_place.numero_place
from billet
join v_diffusion on v_diffusion.id_diffusion = billet.id_diffusion
join v_rang_place on v_rang_place.id_rang_place = billet.id_rang_place
join prix_billet ON prix_billet.id_prix_billet = billet.id_prix_billet
;

create or replace view v_achat_produit as
select achat_produit.*,produit.nom_produit,produit.prix_produit
from achat_produit
join produit ON produit.id_produit = achat_produit.id_produit;

-- select *,
-- case
-- when sexe = 1 then 'homme'
-- when sexe = 0 then 'femme'
-- end as design
-- from client;

-- select *,
-- DATE_PART('year',CURRENT_DATE) - DATE_PART('year',dtn_client) AS age
-- from client;


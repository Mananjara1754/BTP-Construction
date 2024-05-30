CREATE OR REPLACE FUNCTION details_beta( date_f Date)
RETURNS TABLE (
    id_article varchar,
    article varchar,
    categorie varchar,
    unite varchar,
    type varchar,
    qte_f double precision,
    montant double precision
) AS $$
BEGIN
    RETURN QUERY
    select 
    v_article_destine_vente.id_article, 
    v_article_destine_vente.article, 
    v_article_destine_vente.categorie, 
    v_article_destine_vente.unite, 
    v_article_destine_vente.type,
    
    (select  
        sum(reste) 
        from  v_entre 
        where date_entre_stock <= date_f 
            and v_entre.id_article = v_article_destine_vente.id_article) as qte_f,
    (select  
        sum(v_entre.montant)  
        from v_entre 
            where date_entre_stock <= date_f 
            and v_entre.id_article = v_article_destine_vente.id_article ) as montant
    from v_article_destine_vente;
END;
$$ LANGUAGE plpgsql;

select * from details_beta ( now()::date  );

CREATE OR REPLACE FUNCTION get_cump(id_a varchar) 
RETURNS double precision
AS $$
DECLARE
    avg_price double precision;
BEGIN
    SELECT AVG(pu_h_taxe) + AVG(pu_h_taxe) * (AVG(tva)/100)
    INTO avg_price
    FROM entre_stock 
    WHERE id_article = id_a;
    RETURN avg_price;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION details(date_f Date)
RETURNS TABLE (
    id_article varchar,
    article varchar,
    categorie varchar,
    unite varchar,
    type varchar,
    qte_f double precision,
    montant double precision
) AS $$
BEGIN
    RETURN QUERY
    select 
    d.id_article,
    d.article,
    d.categorie,
    d.unite,
    d.type,
    case when d.qte_f is null then 0 else d.qte_f end as qte_f,
    case 
        when d.type = 'CUMP'
        then 
            case 
                when get_cump(d.id_article) is null then 0
                else get_cump(d.id_article)*d.qte_f 
            end
        else
            case 
                when d.montant is null then 0 
                else d.montant
            end
    end as montant
    from details_beta ( date_f ) as d;
END;
$$ LANGUAGE plpgsql;
select * from details ( now()::date  );


CREATE OR REPLACE FUNCTION stat_beta(mois int, anne int) 
RETURNS TABLE (
    id_article varchar,
    article varchar,
    categorie varchar,
    unite varchar,
    type varchar,
    nb_vente double precision,
    cout double precision
) AS $$
BEGIN
    RETURN QUERY
    select 
    v_article_destine_vente.id_article,
    v_article_destine_vente.article,
    v_article_destine_vente.categorie,
    v_article_destine_vente.unite,
    v_article_destine_vente.type,
    (select sum(qte) from v_demande_client_livre 
        where v_demande_client_livre.id_article = v_article_destine_vente.id_article
        and extract( Year from date_livraison ) = anne 
        and extract (Month from date_livraison) = mois)::double precision as nb_vente,
    (select sum(total_ttc) from v_demande_client_livre 
        where 
            v_demande_client_livre.id_article = v_article_destine_vente.id_article
            and extract( Year from date_livraison ) = anne 
            and extract (Month from date_livraison) = mois)::double precision as cout  
    from v_article_destine_vente;
END;
$$ LANGUAGE plpgsql;

-- select * from stat_beta(12, 2023); 



CREATE OR REPLACE FUNCTION stat(mois int, anne int) 
RETURNS TABLE (
    id_article varchar,
    article varchar,
    categorie varchar,
    unite varchar,
    type varchar,
    nb_vente double precision,
    cout double precision
) AS $$
BEGIN
    RETURN QUERY
    select 
    d.id_article,
    d.article,
    d.categorie,
    d.unite,
    d.type,
    case when d.nb_vente is null then 0 else d.nb_vente end as nb_vente,
    case when d.cout is null then 0 else round(d.cout::numeric, 2)::double precision end as cout
    from stat_beta(mois, anne) as d;
END;
$$ LANGUAGE plpgsql;

-- select * from stat(12, 2023); 



-- select * from v_demande_client where
--     extract( Year from date_livraison ) = 2023 
--     and extract (Month from date_livraison) = 12;
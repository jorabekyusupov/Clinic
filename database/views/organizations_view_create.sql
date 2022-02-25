CREATE
OR REPLACE VIEW public.view_organizations
AS
SELECT o.*,
       ot.id as organization_translation_id,
       ot.language_code,
       ot.name,
       ot.address
FROM organizations o
         LEFT JOIN organization_translations ot ON o.id = ot.organization_id;

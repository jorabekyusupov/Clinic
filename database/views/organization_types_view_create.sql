CREATE OR REPLACE VIEW public.view_organization_types
AS SELECT ot.id,
    ot.created_at,
    ot.created_by,
    ot.updated_at,
    ot.updated_by,
    ot.deleted_at,
    ot.deleted_by,
    ott.id as organization_type_translation_id,
    ott.language_code,
    ott.name,
    ott.description
   FROM organization_types ot
     LEFT JOIN organization_type_translations ott ON ot.id = ott.organization_type_id;

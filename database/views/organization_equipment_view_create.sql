CREATE OR REPLACE VIEW public.view_organization_equipment
 AS
SELECT oe.id,
       oe.organization_id,
       oe.created_by,
       oe.updated_by,
       oe.deleted_by,
       oe.updated_at,
       oe.created_at,
       oe.deleted_at,
       oet.id AS organization_equipment_translation_id,
       oet.language_code,
       oet.name
FROM organization_equipment oe
         LEFT JOIN organization_equipment_translations oet ON oe.id = oet.organization_equipment_id;

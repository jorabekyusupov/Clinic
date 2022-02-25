CREATE
OR REPLACE VIEW public.view_service_sections
AS
SELECT ss.id,
       ss.code,
       ss.created_by,
       ss.created_at,
       ss.updated_by,
       ss.updated_at,
       ss.deleted_by,
       ss.deleted_at,
       sst.id as service_section_translation_id,
       sst.language_code,
       sst.name
FROM service_sections ss
         LEFT JOIN service_section_translations sst ON ss.id = sst.service_section_id;

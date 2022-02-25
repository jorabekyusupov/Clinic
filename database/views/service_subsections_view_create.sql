CREATE
OR REPLACE VIEW public.view_service_subsections
AS
SELECT ss.id,
       ss.code,
       ss.created_by,
       ss.created_at,
       ss.updated_by,
       ss.updated_at,
       ss.deleted_by,
       ss.deleted_at,
       sst.id as service_subsection_translation_id,
       sst.language_code,
       sst.name
FROM service_subsections ss
         LEFT JOIN service_subsection_translations sst ON ss.id = sst.service_subsection_id;

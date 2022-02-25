CREATE
OR REPLACE VIEW public.view_service_classes
AS
SELECT sc.id,
       sc.code,
       sc.created_by,
       sc.created_at,
       sc.updated_by,
       sc.updated_at,
       sc.deleted_by,
       sc.deleted_at,
       sct.id as service_class_translation_id,
       sct.language_code,
       sct.name
FROM service_classes sc
         LEFT JOIN service_class_translations sct ON sc.id = sct.service_class_id;

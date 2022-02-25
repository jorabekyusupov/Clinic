CREATE
OR REPLACE VIEW public.view_services
AS
SELECT s.id,
       s.code,
       s.category_id,
       s.created_by,
       s.created_at,
       s.updated_by,
       s.updated_at,
       s.deleted_by,
       s.deleted_at,
       st.id as service_translation_id,
       st.language_code,
       st.name
FROM services s
         LEFT JOIN service_translations st ON s.id = st.service_id;

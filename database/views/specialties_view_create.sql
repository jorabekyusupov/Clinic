CREATE
OR REPLACE VIEW public.view_specialties
AS
SELECT s.id,
       s.specialty_type_id,
       s.created_by,
       s.created_at,
       s.updated_by,
       s.updated_at,
       s.deleted_by,
       s.deleted_at,
       st.id as specialty_translation_id,
       st.language_code,
       st.name
FROM specialties s
         LEFT JOIN specialty_translations st ON s.id = st.specialty_id;

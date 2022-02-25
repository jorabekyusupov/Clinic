CREATE
OR REPLACE VIEW public.view_specialty_types
AS
SELECT st.id,
       st.type,
       st.created_by,
       st.created_at,
       st.updated_by,
       st.updated_at,
       st.deleted_by,
       st.deleted_at,
       stt.id as specialty_type_translation_id,
       stt.language_code,
       stt.name
FROM specialty_types st
         LEFT JOIN specialty_type_translations stt ON st.id = stt.specialty_type_id;

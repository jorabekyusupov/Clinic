CREATE OR REPLACE VIEW public.view_study_types
 AS
SELECT st.id,
       st.created_by,
       st.updated_by,
       st.deleted_by,
       st.updated_at,
       st.created_at,
       st.deleted_at,
       stt.id AS study_type_translation_id,
       stt.language_code,
       stt.name
FROM public.study_types st
         LEFT JOIN public.study_type_translations stt ON st.id = stt.study_type_id;

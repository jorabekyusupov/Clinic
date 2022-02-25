CREATE OR REPLACE VIEW public.view_study_degrees
 AS
SELECT sd.id,
       sd.created_by,
       sd.updated_by,
       sd.deleted_by,
       sd.updated_at,
       sd.created_at,
       sd.deleted_at,
       sdt.id AS study_degree_translation_id,
       sdt.language_code,
       sdt.name
FROM public.study_degrees sd
         LEFT JOIN public.study_degree_translations sdt ON sd.id = sdt.study_degree_id;

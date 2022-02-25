CREATE OR REPLACE VIEW public.view_universities
 AS
SELECT u.id,
       u.created_by,
       u.updated_by,
       u.deleted_by,
       u.updated_at,
       u.created_at,
       u.deleted_at,
       ut.id AS university_translation_id,
       ut.language_code,
       ut.name
FROM universities u
         LEFT JOIN university_translations ut ON u.id = ut.university_id;

CREATE VIEW public.view_roles
AS
SELECT r.id,
       r.type,
       r.name,
       r.created_by,
       r.created_at,
       r.updated_by,
       r.updated_at,
       r.deleted_by,
       r.deleted_at,
       rt.id as role_translation_id,
       rt.language_code,
       rt.display_name,
       rt.description
FROM roles r
         LEFT JOIN role_translations rt ON r.id = rt.role_id;

CREATE VIEW public.view_permissions
AS
SELECT p.id,
       p.type,
       p.name,
       p.created_by,
       p.created_at,
       p.updated_by,
       p.updated_at,
       p.deleted_by,
       p.deleted_at,
       pt.id as permission_translation_id,
       pt.language_code,
       pt.display_name,
       pt.description
FROM permissions p
         LEFT JOIN permission_translations pt ON p.id = pt.permission_id;

CREATE VIEW public.view_categories
AS
SELECT c.id,
       c.code,
       c.created_by,
       c.created_at,
       c.updated_by,
       c.updated_at,
       c.deleted_by,
       c.deleted_at,
       ct.id as category_translation_id,
       ct.language_code,
       ct.name
FROM categories c
         LEFT JOIN category_translations ct ON c.id = ct.category_id;

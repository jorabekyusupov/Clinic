CREATE OR REPLACE VIEW public.view_doctors
 AS
SELECT d.id,
       d.person_id,
       p.first_name,
       p.last_name,
       p.middle_name,
       p.born_date,
       p.jshshir,
       p.gender,
       d.created_by,
       d.updated_by,
       d.deleted_by,
       d.updated_at,
       d.created_at,
       d.deleted_at,
       d.status
FROM public.doctors d
         LEFT JOIN people p ON p.id = d.person_id;

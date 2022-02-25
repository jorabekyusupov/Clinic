INSERT INTO public.people (id, first_name, gender,created_at,updated_at,created_by,updated_by) VALUES
	 (1, 'Superadmin', 'M' NOW(), NOW(), 1, 1),
	 (2, 'doctoradmin', 'M' NOW(), NOW(), 1, 1);

SELECT setval('people_id_seq', max(id)) FROM public.people;

INSERT INTO public.roles (id,"type","name",created_at,updated_at,created_by,updated_by) VALUES
	 (1,0,'superadmin',NOW(),NOW(),1,1),
	 (2,0,'doctoradmin',NOW(),NOW(),1,1);

SELECT setval('roles_id_seq', max(id)) FROM public.roles;
